<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'category_id' => "sometimes|integer|exists:categories,id",
            'sku' => "sometimes|string|max:50",
            'name' => "sometimes|string|max:255",
            'stock' => "sometimes|integer|min:0",
            'price' => "sometimes|numeric|min:0",
            'image' => "nullable|url|max:255",
        ];
    }
}
