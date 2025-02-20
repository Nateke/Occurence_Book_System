<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255', 'string'],
            'email' => ['required', 'unique:users,email', 'email'],
            'phone_number' => ['required', 'max:255', 'string'],
            'password' => ['required'],
            'phone_number_verified_at' => ['nullable', 'date'],
            'area_id' => ['nullable', 'max:255'],
            'region_id' => ['nullable', 'max:255'],
            'address' => ['nullable', 'max:255', 'string'],
            'officer_id' => ['required', 'exists:officers,id'],
            'roles' => 'array',
        ];
    }
}
