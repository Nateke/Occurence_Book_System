<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignatureUpdateRequest extends FormRequest
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
            'booking_id' => ['required', 'max:255'],
            'witness_signature' => ['required', 'max:255', 'string'],
            'offended_signature' => ['required', 'max:255', 'string'],
            'offender_signature' => ['required', 'max:255', 'string'],
            'signature_date' => ['required', 'date'],
        ];
    }
}
