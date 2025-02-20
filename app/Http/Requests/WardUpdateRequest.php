<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WardUpdateRequest extends FormRequest
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
            'subcounty_id' => ['required', 'exists:subcounties,id'],
            'name' => ['required', 'max:255', 'string'],
        ];
    }
}
