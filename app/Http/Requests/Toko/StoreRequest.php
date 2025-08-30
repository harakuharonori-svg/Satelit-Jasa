<?php

namespace App\Http\Requests\Toko;

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
            'nama' => ['required', 'min:3', 'max:100'],
            'deskripsi' => ['required', 'min:10', 'max:500'],
            'ktp' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048']
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama toko wajib diisi',
            'nama.min' => 'Nama toko minimal 3 karakter',
            'nama.max' => 'Nama toko maksimal 100 karakter',
            'deskripsi.required' => 'Deskripsi toko wajib diisi',
            'deskripsi.min' => 'Deskripsi minimal 10 karakter',
            'deskripsi.max' => 'Deskripsi maksimal 500 karakter',
            'ktp.required' => 'Foto KTP wajib diupload',
            'ktp.file' => 'KTP harus berupa file',
            'ktp.mimes' => 'KTP harus berformat JPG, JPEG, PNG, atau PDF',
            'ktp.max' => 'Ukuran file KTP maksimal 2MB'
        ];
    }
}
