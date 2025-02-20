<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StationUpdateRequest extends FormRequest
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
            'station_name' => ['required', 'max:255', 'string'],
            'station_number' => ['required', 'max:255', 'string'],
            'region_id' => ['required', 'exists:regions,id'],
            'subregion_id' => ['required', 'max:255'],
            'ward' => ['required', 'max:255'],
            'station_id' => ['required', 'exists:officers,id'],
            'subcounty_id' => ['required', 'exists:subcounties,id'],
            'ward_id' => ['required', 'exists:wards,id'],
        ];
    }
}
