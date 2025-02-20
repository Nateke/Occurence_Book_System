<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlatsBailStoreRequest extends FormRequest
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
            'amount' => ['required', 'numeric'],
            'conditions' => ['nullable', 'max:255', 'string'],
            'release_date' => ['required', 'date'],
            'surety_details' => ['required', 'max:255', 'string'],
        ];
    }
}
