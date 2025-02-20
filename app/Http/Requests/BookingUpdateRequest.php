<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingUpdateRequest extends FormRequest
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
            'officer_id' => ['required', 'exists:officers,id'],
            'booking_date' => ['required', 'date'],
            'booking_time' => ['required', 'date_format:H:i:s'],
            'location' => ['required', 'max:255', 'string'],
            'remarks' => ['required', 'max:255', 'string'],
            'evidence_collected' => ['required', 'max:255', 'string'],
            'offenseCase_id' => ['required', 'exists:signatures,id'],
        ];
    }
}
