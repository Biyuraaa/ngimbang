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
        return $user->hasPermissionTo('create-umkms') || $user->hasRole('super-admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            // UMKM Owner validation
            'user_name' => ['required', 'string', 'max:255'],
            'user_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'user_phone' => ['required', 'string', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10', 'max:15'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'umkm_name' => ['required', 'string', 'max:255'],
            'umkm_description' => ['required', 'string', 'min:50'],
            'umkm_address' => ['required', 'string', 'min:10'],
        ];
    }

    public function messages(): array
    {
        return [
            // UMKM Owner messages
            'user_name.required' => 'Nama pemilik wajib diisi',
            'user_name.max' => 'Nama pemilik maksimal 255 karakter',

            'user_email.required' => 'Email wajib diisi',
            'user_email.email' => 'Format email tidak valid',
            'user_email.unique' => 'Email sudah terdaftar',

            'user_phone.required' => 'Nomor telepon wajib diisi',
            'user_phone.regex' => 'Format nomor telepon tidak valid',
            'user_phone.min' => 'Nomor telepon minimal 10 digit',
            'user_phone.max' => 'Nomor telepon maksimal 15 digit',

            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',

            // UMKM data messages
            'umkm_name.required' => 'Nama UMKM wajib diisi',
            'umkm_name.max' => 'Nama UMKM maksimal 255 karakter',

            'umkm_description.required' => 'Deskripsi UMKM wajib diisi',
            'umkm_description.min' => 'Deskripsi UMKM minimal 50 karakter',

            'umkm_address.required' => 'Alamat UMKM wajib diisi',
            'umkm_address.min' => 'Alamat UMKM minimal 10 karakter',
        ];
    }
}
