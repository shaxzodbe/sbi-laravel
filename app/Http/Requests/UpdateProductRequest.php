<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2',
            'price' => 'required|numeric|min:0',
            'barcode' => [
                'required',
                'string',
                'size:13',
                Rule::unique('products', 'barcode')->ignore($this->product),
            ],
            'category_id' => 'required|exists:categories,id',
        ];
    }
}
