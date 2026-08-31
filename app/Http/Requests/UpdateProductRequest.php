<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        $product = $this->route('product');

        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('products', 'slug')->ignore($product)],
            'short_description' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:4096'],
            'price' => ['sometimes', 'integer', 'min:0'],
            'main_accords' => ['nullable', 'array', function (string $attribute, mixed $value, \Closure $fail) {
                if (count($value ?? []) > 4) {
                    $fail('Pilih maksimal 4 main accords.');
                }
            }],
            'main_accords.*.accord' => ['required', 'string', 'distinct', 'in:' . implode(',', Product::ACCORDS)],
            'main_accords.*.percent' => ['required', 'integer', 'min:1', 'max:100'],
            'fragrance_family' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'longevity' => ['nullable', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'fragrance_notes' => ['nullable', 'array'],
            'fragrance_notes.*' => ['exists:fragrance_notes,id'],
            'fragrance_note_positions' => ['nullable', 'array'],
            'fragrance_note_positions.*' => ['in:top,heart,base'],
        ];
    }
}
