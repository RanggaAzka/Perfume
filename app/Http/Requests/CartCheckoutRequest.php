<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartCheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^[0-9+\-\s()]{8,20}$/'],
            'message' => ['nullable', 'string', 'max:2000'],
        ];
    }
}