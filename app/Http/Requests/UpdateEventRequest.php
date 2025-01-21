<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateEventRequest extends FormRequest
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
            //
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'registration_url' => 'nullable|url|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_at' => 'required|date_format:H:i',
            'end_at' => 'required|date_format:H:i',
            'description' => 'required|string|min:50',
        ];
    }
}
