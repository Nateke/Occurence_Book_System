<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatementFilesUpdateRequest extends FormRequest
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
            'file_url' => ['required', 'max:255', 'string'],
            'statement_id' => ['required', 'exists:statements,id'],
        ];
    }
}
