<?php

namespace App\Http\Requests\Register;

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
            'nama' => ['required'],
            'email' => ['required', 'unique:users,email', 'email'],
            'password' => ['required', 'min:8'],
            'confirmpassword' => ['required', 'min:8', 'same:password'],
            'telp' => ['required', 'numeric', 'unique:users,telepon']
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => "Nama wajib diisi",
            'email.required' => "Email wajib diisi",
            'email.unique' => "Email telah digunakan",
            'email.email' => "Format email tak sesuai",
            'password.required' => "Password wajib diisi",
            'password.min' => "Password harus setidaknya memiliki 8 karakter",
            'confirmpassword.required' => "Konfirmasi wajib diisi",
            'confirmpassword.same' => "Konfirmasi tidak sama dengan password",
            'confirmpassword.min' => "Password harus setidaknya memiliki 8 karakter",
            'telp.required' => "Nomor telepon wajib diisi",
            'telp.numeric' => "Format telepon tidak sesuai",
            'telp.unique' => "Nomor telepon telah digunakan"
        ];
    }
}
