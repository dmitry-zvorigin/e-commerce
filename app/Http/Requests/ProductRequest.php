<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'category' => 'nullable|exists:categories,id', // Валидации категории
            'min_price' => 'nullable|numeric|min:0', // Валидации минимальной цены
            'max_price' => 'nullable|numeric|gte:min_price', // Валидации максимальной цены
            'color' => 'nullable|string', // Валидации цвета
            'sorting' => 'string', // Валидация сортировки
        ];
    }
}
