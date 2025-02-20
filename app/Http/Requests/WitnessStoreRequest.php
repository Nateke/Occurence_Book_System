<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Validator;

class WitnessStoreRequest extends FormRequest
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
            'first_name' => ['required', 'max:255', 'string'],
            'middle_name' => ['nullable', 'max:255', 'string'],
            'last_name' => ['required', 'max:255', 'string'],
            'other_name' => ['nullable', 'max:255', 'string'],
            'gender' => ['required', 'max:20', 'string'],
            'dob' => ['nullable', 'date'],
            'underage_flag' => ['required', 'boolean'],
            'phone_number' => ['nullable', 'max:16', 'string', 'unique:offenders,phone_number'],
            'id_scan' => ['nullable', 'max:255', 'string', 'unique:offenders,id_scan'],
            'country_id' => ['required', 'exists:countries,id'],
            'county_id' => ['required', 'exists:counties,id'],
            'subcounty_id' => ['required', 'exists:subcounties,id'],
            'ward_id' => ['required', 'exists:wards,id'],
            'location' => ['nullable', 'max:255', 'string'],
            'occupation' => ['nullable', 'max:255', 'string'],
            'added_by' => ['nullable'],
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
