<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OffenseCaseStoreRequest extends FormRequest
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
            'offence_id' => ['required', 'max:255'],
            'id_no' => ['required', 'max:255'],
            'court_date' => ['nullable', 'date'],
            'legal_adviser_comments' => ['required', 'max:255', 'string'],
        ];
    }
}
