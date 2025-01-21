<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreUmkmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /** @var \User $user */
        $user = Auth::user();
        return $user->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'owner' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:15',
            'description' => 'required|string|max:1000',
            'address' => 'nullable|string|max:500',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama UMKM wajib diisi.',
            'name.max' => 'Nama UMKM tidak boleh lebih dari 255 karakter.',
            'owner.required' => 'Nama pemilik wajib diisi.',
            'owner.max' => 'Nama pemilik tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'phone.max' => 'Nomor telepon tidak boleh lebih dari 15 karakter.',
            'description.required' => 'Deskripsi UMKM wajib diisi.',
            'description.max' => 'Deskripsi tidak boleh lebih dari 1000 karakter.',
            'address.max' => 'Alamat tidak boleh lebih dari 500 karakter.',
            'thumbnail.required' => 'Thumbnail wajib diunggah.',
            'thumbnail.image' => 'Thumbnail harus berupa file gambar.',
            'thumbnail.mimes' => 'Thumbnail harus berformat JPG, JPEG, atau PNG.',
            'thumbnail.max' => 'Ukuran thumbnail tidak boleh lebih dari 2MB.',
        ];
    }
}
