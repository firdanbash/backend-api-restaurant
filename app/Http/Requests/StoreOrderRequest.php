<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'payment_type_id' => ['required', 'integer', 'exists:payments,id'],
            'name' => ['required', 'string', 'max:255'],
            'total_paid' => ['required', 'integer', 'min:0'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'integer', 'exists:products,id'],
            'items.*.qty' => ['required', 'integer', 'min:1'],
            'items.*.price' => ['required', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'payment_type_id.required' => 'Metode pembayaran harus dipilih',
            'payment_type_id.exists' => 'Metode pembayaran tidak valid',
            'name.required' => 'Nama customer harus diisi',
            'total_paid.required' => 'Total pembayaran harus diisi',
            'total_paid.min' => 'Total pembayaran tidak boleh negatif',
            'items.required' => 'Minimal harus ada 1 item',
            'items.*.product_id.exists' => 'Produk tidak ditemukan',
            'items.*.qty.min' => 'Jumlah minimal 1',
            'items.*.price.min' => 'Harga tidak boleh negatif',
        ];
    }
}
