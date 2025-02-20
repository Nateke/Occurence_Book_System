<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfficerUpdateRequest extends FormRequest
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
            'station_id' => ['required', 'max:255'],
            'user_id' => ['required', 'max:255'],
            'officer_name' => ['required', 'max:255', 'string'],
            'badge_number' => ['required', 'max:255', 'string'],
            'rank' => ['required', 'max:255', 'string'],
        ];
    }
}
