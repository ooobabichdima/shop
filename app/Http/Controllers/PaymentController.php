<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Services\MonobankService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(private MonobankService $monobank)
    {
    }

    /**
     * Webhook от Monobank
     */
    public function monobankWebhook(Request $request)
    {
        $data = $request->all();

        $success = $this->monobank->handleWebhook($data);

        return response()->json(['success' => $success]);
    }

    /**
     * Demo страница для sandbox платежей
     */
    public function monobankDemo(Payment $payment)
    {
        if ($payment->status !== 'pending') {
            return redirect()->route('checkout.success', ['order' => $payment->order_id])
                ->with('info', 'Платіж вже оброблено');
        }

        return view('pages.payment-demo', compact('payment'));
    }

    /**
     * Подтверждение demo платежа
     */
    public function monobankDemoConfirm(Payment $payment)
    {
        // Обновляем статус
        $payment->update(['status' => 'success']);
        $payment->order->update(['status' => 'paid']);

        return redirect()->route('checkout.success', ['order' => $payment->order_id])
            ->with('success', 'Платіж успішний (demo режим)');
    }
}
