<?php

namespace App\Http\Requests\Hospital;

use Illuminate\Foundation\Http\FormRequest;

class DoctorExperienceRequest extends FormRequest
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
            'doctor_id' => [
                'required_without:id',
                'exists:users,id'
            ],
            'start_at' => [
                'required',
                'date',
            ],
            'end_at' => [
                'required',
                'date',
            ],
            'country_id' => [
                'required',
                'exists:countries,id',
            ],
            'company_ar' => [
                'required',
                'string',
            ],
            'company_en' => [
                'required',
                'string',
            ],
            'details_ar' => [
                'required',
                'string',
            ],
            'details_en' => [
                'required',
                'string',
            ],

            'position_ar' => [
                'required',
                'string',
            ],
            'position_en' => [
                'required',
                'string',
            ]
        ];
    }
}
