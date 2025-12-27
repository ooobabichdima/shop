<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MonobankService
{
    private string $apiUrl = 'https://api.monobank.ua/api/merchant';
    private ?string $token;
    private bool $isSandbox;
    private ?string $webhookUrl;

    public function __construct()
    {
        $this->token = config('services.monobank.token');
        $this->isSandbox = config('services.monobank.mode') === 'sandbox';
        $this->webhookUrl = config('services.monobank.webhook_url');
    }

    /**
     * Создать инвойс для оплаты
     */
    public function createInvoice(Order $order): array
    {
        if ($this->isSandbox) {
            return $this->createSandboxInvoice($order);
        }

        try {
            $response = Http::withHeaders([
                'X-Token' => $this->token,
            ])->post($this->apiUrl . '/invoice/create', [
                'amount' => (int) ($order->total * 100), // в копійках
                'merchantPaymInfo' => [
                    'reference' => $order->number,
                    'destination' => 'Оплата замовлення ' . $order->number,
                    'comment' => $order->comment ?? '',
                ],
                'redirectUrl' => route('checkout.success', ['order' => $order->id]),
                'webHookUrl' => $this->webhookUrl,
            ]);

            if ($response->successful()) {
                $data = $response->json();

                // Создаем запись платежа
                $payment = Payment::create([
                    'order_id' => $order->id,
                    'provider' => 'monobank',
                    'status' => 'pending',
                    'amount' => $order->total,
                    'currency' => 'UAH',
                    'invoice_id' => $data['invoiceId'] ?? null,
                    'payload' => $data,
                ]);

                Log::info('Monobank invoice created', [
                    'order_id' => $order->id,
                    'invoice_id' => $data['invoiceId'] ?? null,
                ]);

                return [
                    'success' => true,
                    'payment_url' => $data['pageUrl'] ?? null,
                    'invoice_id' => $data['invoiceId'] ?? null,
                    'payment' => $payment,
                ];
            }

            Log::error('Monobank create invoice error', ['response' => $response->body()]);

            return [
                'success' => false,
                'error' => 'Failed to create invoice',
            ];

        } catch (\Exception $e) {
            Log::error('Monobank createInvoice exception', ['error' => $e->getMessage()]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Обработать webhook от Monobank
     */
    public function handleWebhook(array $data): bool
    {
        try {
            $invoiceId = $data['invoiceId'] ?? null;
            $status = $data['status'] ?? null;

            if (!$invoiceId) {
                Log::warning('Monobank webhook: missing invoiceId');
                return false;
            }

            $payment = Payment::where('invoice_id', $invoiceId)->first();

            if (!$payment) {
                Log::warning('Monobank webhook: payment not found', ['invoice_id' => $invoiceId]);
                return false;
            }

            // Обновляем статус платежа
            $newStatus = $this->mapMonobankStatus($status);
            $payment->update([
                'status' => $newStatus,
                'payload' => $data,
            ]);

            // Если оплата успешна, обновляем статус заказа
            if ($newStatus === 'success') {
                $payment->order->update(['status' => 'paid']);
            }

            Log::info('Monobank webhook processed', [
                'invoice_id' => $invoiceId,
                'status' => $newStatus,
                'order_id' => $payment->order_id,
            ]);

            return true;

        } catch (\Exception $e) {
            Log::error('Monobank handleWebhook exception', ['error' => $e->getMessage()]);
            return false;
        }
    }

    /**
     * Sandbox режим - создать тестовый инвойс
     */
    private function createSandboxInvoice(Order $order): array
    {
        $invoiceId = 'SANDBOX-' . Str::random(16);

        $payment = Payment::create([
            'order_id' => $order->id,
            'provider' => 'monobank_sandbox',
            'status' => 'pending',
            'amount' => $order->total,
            'currency' => 'UAH',
            'invoice_id' => $invoiceId,
            'payload' => ['mode' => 'sandbox'],
        ]);

        return [
            'success' => true,
            'payment_url' => route('payment.monobank.demo', ['payment' => $payment->id]),
            'invoice_id' => $invoiceId,
            'payment' => $payment,
            'sandbox' => true,
        ];
    }

    /**
     * Маппинг статусов Monobank на наши
     */
    private function mapMonobankStatus(?string $status): string
    {
        return match ($status) {
            'success', 'processing' => 'success',
            'failure', 'expired' => 'failed',
            'created' => 'pending',
            'reversed' => 'refunded',
            default => 'pending',
        };
    }
}
