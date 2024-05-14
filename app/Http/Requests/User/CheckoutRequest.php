<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('web')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'address' => ['required', 'min:3', 'max:255'],
            'city' => ['required', 'min:3', 'max:50'],
            'country' => ['required', 'min:3', 'max:50'],
            'postal_code' => ['required', 'min:3', 'max:10'],
        ];
    }
}
