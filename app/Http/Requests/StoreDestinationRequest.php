<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class StoreDestinationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /** @var User $user */
        $user = Auth::user();
        return $user && $user->hasRole('admin');
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
            'status' => 'required|in:draft,published,archived',
            'email' => 'required|email|unique:destinations,email',
            'phone' => 'nullable|string|max:20',
            'description' => 'required|string|max:1000',
            'address' => 'nullable|string|max:255',
            'open_at' => 'nullable|date_format:H:i',
            'close_at' => 'nullable|date_format:H:i|after:open_at',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Maksimum 2MB
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
            'name.required' => 'Nama destinasi wajib diisi.',
            'name.max' => 'Nama destinasi tidak boleh lebih dari 255 karakter.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status yang dipilih tidak valid.',
            'description.required' => 'Deskripsi wajib diisi.',
            'description.max' => 'Deskripsi tidak boleh lebih dari 1000 karakter.',
            'address.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
            'open_at.date_format' => 'Format waktu buka tidak valid.',
            'close_at.date_format' => 'Format waktu tutup tidak valid.',
            'close_at.after' => 'Waktu tutup harus setelah waktu buka.',
            'thumbnail.required' => 'Gambar destinasi wajib diunggah.',
            'thumbnail.image' => 'File yang diunggah harus berupa gambar.',
            'thumbnail.mimes' => 'Gambar harus berformat JPG, JPEG, atau PNG.',
            'thumbnail.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
