<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateDestinationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /** @var \User $user */
        $user = Auth::user();
        return $user->can('edit-destinations');
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
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'description' => 'required|string',
            'address' => 'required|string',
            'open_at' => 'required|date_format:H:i',
            'close_at' => 'required|date_format:H:i',
            'thumbnail' => 'nullable|image',

        ];
    }
}
