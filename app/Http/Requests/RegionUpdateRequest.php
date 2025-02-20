<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegionUpdateRequest extends FormRequest
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
            'iso' => ['required', 'max:255'],
            'name' => ['required', 'max:255', 'string'],
            'nicename' => ['required', 'max:255', 'string'],
            'iso3' => ['required', 'max:255'],
            'numcode' => ['required', 'max:255'],
            'phonecode' => ['required', 'max:255'],
        ];
    }
}
