<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // Service validation
            'service_id' => 'required|exists:services,id',


            // Related IDs
            'lab_id' => 'required|numeric|exists:users,id',
            'address_id' => 'nullable|numeric|exists:addresses,id',

            // Booking details
            'booking_date' => 'required|date', // Assuming it's a date field
            'booking_hour' => 'required', // Assuming time is in HH:mm format


            // Optional fields
            'comment' => 'nullable|string|max:1000', // Optional max length for safety
            'voice' => 'nullable|file|max:5000|mimes:mp3',
            'attachment_file' => 'nullable|file|max:150|mimes:jpeg,png,jpg,pdf',
        ];
    }

    public function messages()
    {
        return [
            'comment.required' => __('validation.required'),
            'step_id.required' => __('validation.required'),
            'step_id.exists' => __('validation.exists'),
            'user_id.required' => __('validation.required'),
            'user_id.exists' => __('validation.exists'),
        ];
    }
}
