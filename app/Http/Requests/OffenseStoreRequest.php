<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OffenseStoreRequest extends FormRequest
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
            'offence_name' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
            'fine_amount' => ['required', 'numeric'],
            'imprisonment_duration' => ['required', 'max:255', 'string'],
            'offenseCase_id' => ['required', 'exists:offense_cases,id'],
        ];
    }
}
