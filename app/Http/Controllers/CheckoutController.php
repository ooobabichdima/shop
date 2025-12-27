<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\MonobankService;
use App\Services\NovaPoshtaService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct(
        private NovaPoshtaService $novaPoshta,
        private MonobankService $monobank
    ) {}

    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Кошик порожній');
        }

        $productIds = array_column($cart, 'id');
        $products = Product::with(['primaryImage'])
            ->whereIn('id', $productIds)
            ->get()
            ->keyBy('id');

        // Обогащаем данные корзины
        $cartItems = [];
        $subtotal = 0;

        foreach ($cart as $item) {
            if (isset($products[$item['id']])) {
                $product = $products[$item['id']];
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'subtotal' => $product->price * $item['quantity'],
                ];
                $subtotal += $product->price * $item['quantity'];
            }
        }

        return view('pages.checkout', compact('cartItems', 'subtotal'));
    }

    public function submit(CheckoutRequest $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Кошик порожній');
        }

        // Получаем товары
        $productIds = array_column($cart, 'id');
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        // Расчет сумм
        $subtotal = 0;
        foreach ($cart as $item) {
            if (isset($products[$item['id']])) {
                $subtotal += $products[$item['id']]->price * $item['quantity'];
            }
        }

        // Промокод
        $discount = 0;
        if ($request->promo_code) {
            $discount = $this->applyPromoCode($request->promo_code, $subtotal);
        }

        // Доставка
        $shippingCost = $this->calculateShipping($request->shipping_provider);

        $total = $subtotal - $discount + $shippingCost;

        // Создаем заказ
        $order = Order::create([
            'number' => Order::generateOrderNumber(),
            'user_id' => auth()->id(),
            'customer_name' => $request->customer_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'shipping_cost' => $shippingCost,
            'total' => $total,
            'shipping_provider' => $request->shipping_provider,
            'shipping_city' => $request->shipping_city,
            'shipping_ref' => $request->shipping_ref,
            'shipping_address' => $request->shipping_address,
            'promo_code' => $request->promo_code,
            'comment' => $request->comment,
            'status' => 'new',
        ]);

        // Создаем позиции заказа
        foreach ($cart as $item) {
            if (isset($products[$item['id']])) {
                $product = $products[$item['id']];

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'name_snapshot' => $product->name,
                    'sku_snapshot' => $product->sku,
                    'price_snapshot' => $product->price,
                    'quantity' => $item['quantity'],
                ]);

                // Уменьшаем остаток
                $product->decrement('stock', $item['quantity']);
            }
        }

        // Очищаем корзину
        session()->forget('cart');

        // Если выбрана оплата онлайн
        if ($request->payment_method === 'monobank') {
            $result = $this->monobank->createInvoice($order);

            if ($result['success']) {
                return redirect($result['payment_url']);
            }

            return redirect()->route('checkout.success', ['order' => $order->id])
                ->with('error', 'Помилка створення платежу. Оплатіть пізніше.');
        }

        return redirect()->route('checkout.success', ['order' => $order->id]);
    }

    public function success(Order $order)
    {
        return view('pages.checkout-success', compact('order'));
    }

    private function applyPromoCode(string $code, float $subtotal): float
    {
        // Простая реализация промокодов
        $promoCodes = [
            'START10' => 10, // 10% скидка
            'BBS50' => 50, // 50 грн скидка
        ];

        if (isset($promoCodes[$code])) {
            $value = $promoCodes[$code];

            // Если процент
            if ($value < 100) {
                return $subtotal * ($value / 100);
            }

            // Если фиксированная сумма
            return min($value, $subtotal);
        }

        return 0;
    }

    private function calculateShipping(string $provider): float
    {
        return match ($provider) {
            'courier' => 150,
            'pickup' => 0,
            default => 100, // Nova Poshta
        };
    }
}
