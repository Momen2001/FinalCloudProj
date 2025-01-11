<?php

namespace App\Http\Requests\Hospital;

use Illuminate\Foundation\Http\FormRequest;

class DoctorEducationRequest extends FormRequest
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
            'completion_date' => [
                'required',
                'date',
            ],
            'country_id' => [
                'required',
                'exists:countries,id',
            ],
            'details_ar' => [
                'required',
                'string',
            ],
            'details_en' => [
                'required',
                'string',
            ],

            'degree_ar' => [
                'required',
                'string',
            ],
            'degree_en' => [
                'required',
                'string',
            ],
            'specialization_ar' => [
                'required',
                'string',
            ],
            'specialization_en' => [
                'required',
                'string',
            ],
            'department_ar' => [
                'required',
                'string',
            ],
            'department_en' => [
                'required',
                'string',
            ],
            'university_ar' => [
                'required',
            ],
            'university_en' => [
                'required',
            ],
        ];
    }
}
