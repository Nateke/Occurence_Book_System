<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatementStoreRequest extends FormRequest
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
            'statement_text' => ['required', 'max:255', 'string'],
            'recorded_by' => ['required', 'exists:officers,id'],
            'recording_date' => ['required', 'date'],
            'files_id' => ['required', 'max:255'],
            'booking_id' => ['required', 'max:255'],
        ];
    }
}
