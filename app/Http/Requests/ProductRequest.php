<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->route('category')) {
            $this->merge([
                'category_id' => $this->route('category')->id,
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:60'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'min:0.5', 'max:50'],
            'description' => ['nullable', 'string', 'max:500'],
            'allergens' => ['nullable', 'array'],
            'allergens.*' => ['integer', 'exists:allergens,id'],
        ];
    }

    public function attributes(): array
    {
        return [
            'allergens.*' => 'allergène',
        ];
    }
}
