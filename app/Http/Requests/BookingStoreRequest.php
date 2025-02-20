<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Validator;

class BookingStoreRequest extends FormRequest
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
            'officer_id' => ['sometimes', 'exists:officers,id'],
            'station_id' => ['sometimes', 'exists:stations,id'],
            'location' => ['max:255', 'string'],
            'remarks' => ['nullable', 'max:255', 'string'],
            'offenders' => ['required', 'array'],
            'offenders.*.id' => ['required', 'exists:offenders,id'],
            'offenders.*.signature' => ['required', 'image', 'max:5120'],

            'offended' => ['sometimes', 'array'],
            'offended.*.id' => ['sometimes', 'exists:offended,id'],
            'offended.*.signature' => ['sometimes', 'image', 'max:5120'],

            'witnesses' => ['sometimes', 'array'],
            'witnesses.*.id' => ['sometimes', 'exists:witness,id'],
            'witnesses.*.signature' => ['sometimes', 'image', 'max:5120'],

            'statement' => ['required', 'string'],
            'evidence_collected' => ['required', 'string'],
            'statement_files' => ['sometimes', 'array'],
            'statement_files.*' => ['sometimes', 'file', 'max:5120'],
        ];
    }
    protected function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => $validator->errors()->first(),
            'errors' => $validator->errors(),
        ], 422));
    }
}
