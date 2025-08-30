<?php

namespace App\Http\Requests\Jasa;

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
            'judul' => ['required', 'min:5', 'max:100'],
            'deskripsi' => ['required', 'min:20', 'max:1000'],
            'harga' => ['required', 'numeric', 'min:1000'],
            'kategoris' => ['required', 'array', 'min:1'],
            'kategoris.*' => ['exists:kategoris,id'],
            'banner' => ['required', 'array', 'min:1', 'max:5'],
            'banner.*' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:2048']
        ];
    }

    public function messages()
    {
        return [
            'judul.required' => 'Judul jasa wajib diisi',
            'judul.min' => 'Judul jasa minimal 5 karakter',
            'judul.max' => 'Judul jasa maksimal 100 karakter',
            'deskripsi.required' => 'Deskripsi jasa wajib diisi',
            'deskripsi.min' => 'Deskripsi minimal 20 karakter',
            'deskripsi.max' => 'Deskripsi maksimal 1000 karakter',
            'harga.required' => 'Harga jasa wajib diisi',
            'harga.numeric' => 'Harga harus berupa angka',
            'harga.min' => 'Harga minimal Rp 1.000',
            'kategoris.required' => 'Kategori jasa wajib dipilih',
            'kategoris.array' => 'Format kategori tidak valid',
            'kategoris.min' => 'Minimal pilih 1 kategori',
            'kategoris.*.exists' => 'Kategori yang dipilih tidak valid',
            'banner.required' => 'Banner jasa wajib diupload',
            'banner.array' => 'Banner harus berupa file',
            'banner.min' => 'Minimal upload 1 banner',
            'banner.max' => 'Maksimal upload 5 banner',
            'banner.*.required' => 'File banner wajib diisi',
            'banner.*.file' => 'Banner harus berupa file',
            'banner.*.mimes' => 'Banner harus berformat JPG, JPEG, atau PNG',
            'banner.*.max' => 'Ukuran file banner maksimal 2MB'
        ];
    }
}
