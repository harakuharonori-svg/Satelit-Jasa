<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'email' => ['required', 'exists:users,email', 'email'],
            'password' => ['required', 'min:8']
        ];
    }

    public function messages() {
        return [
            'email.required' => "Email wajib diisi",
            'email.exists' => "Email tersebut tidak ada",
            'email.email' => "Format email tak sesuai",
            'password.required' => "Password wajib diisi",
            'password.min' => "Password harus setidaknya memiliki 8 karakter"
        ];
    }
}
