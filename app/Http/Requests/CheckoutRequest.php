<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'shipping_provider' => 'required|in:np,courier,pickup',
            'shipping_city' => 'nullable|string|max:255',
            'shipping_ref' => 'nullable|string|max:255',
            'shipping_address' => 'nullable|string|max:500',
            'payment_method' => 'required|in:monobank,cash',
            'promo_code' => 'nullable|string|max:50',
            'comment' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'customer_name.required' => 'Вкажіть ваше ім\'я',
            'phone.required' => 'Вкажіть номер телефону',
            'email.email' => 'Некоректний email',
            'shipping_provider.required' => 'Оберіть спосіб доставки',
            'payment_method.required' => 'Оберіть спосіб оплати',
        ];
    }
}
