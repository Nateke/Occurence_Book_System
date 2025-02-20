<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class WitnessUpdateRequest extends FormRequest
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
            'first_name' => ['sometimes', 'required', 'max:255', 'string'],
            'middle_name' => ['nullable', 'max:255', 'string'],
            'last_name' => ['sometimes', 'required', 'max:255', 'string'],
            'other_name' => ['nullable', 'max:255', 'string'],
            'id_scan' => ['nullable', 'max:255',  Rule::unique('offenders', 'id_scan')->ignore($this->route('offender'))],
            'underage_flag' => ['sometimes', 'required', 'boolean'],
            'phone_number' => ['nullable', 'max:16', 'string',  Rule::unique('offenders', 'phone_number')->ignore($this->route('offender'))],
            'country_id' => ['sometimes', 'required', 'exists:countries,id'],
            'county_id' => ['sometimes', 'required', 'exists:counties,id'],
            'subcounty_id' => ['sometimes', 'required', 'exists:subcounties,id'],
            'ward_id' => ['sometimes', 'required', 'exists:wards,id'],
            'location' => ['nullable', 'max:255', 'string'],
            'occupation' => ['nullable', 'max:255', 'string'],
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
