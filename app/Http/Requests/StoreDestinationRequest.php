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
        return $user->hasPermissionTo('create-destinations') || $user->hasRole('super-admin');
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
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|unique:users,email',
            'user_phone' => 'required|string|max:15',
            'password' => 'required|confirmed|min:8',
            'destination_name' => 'required|string|max:255',
            'destination_description' => 'required|string',
        ];
    }
}
