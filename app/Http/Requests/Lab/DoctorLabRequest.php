<?php

namespace App\Http\Requests\Lab;

use Illuminate\Foundation\Http\FormRequest;

class DoctorLabRequest extends FormRequest
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
            'photo' => [
                'required_without:id',
                'mimes:jpeg,png,jpg'
            ],
            'first_name' => [
                'required',
                'string',
            ],
            'last_name' => [
                'required',
                'string',
            ],
            'first_name_en' => [
                'required',
                'string',
            ],
            'last_name_en' => [
                'required',
                'string',
            ],
            'birth_date' => [
                'required',
            ],
            'phone' => [
                'required',
                'digits:9',
                'unique:users,phone,' . $this->id
            ],
            'country_id' => [
                'required',
                'exists:countries,id',
            ],

            'city_id' => [
                'required',
                'exists:cities,id',
            ],

            'passport_id' => [
                'required',
            ],
            'password' => [
                'required_without:id',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email,' . $this->id
            ],

            'experience_start_work' => [
                'required',
            ],


            'home_visit_price' => [
                'required',
                'numeric',
                'min:1',

            ],
            'in_hospital_price' => [
                'required',
                'numeric',
                'min:1',

            ],
            'speciality' => [
                'required',
                'string',
            ],
            'speciality_en' => [
                'required',
                'string',
            ],
            'license' => [
                'required',
                'string',
            ],
            'bio' => [
                'required',
                'string',
            ],
            'bio_en' => [
                'required',
                'string',
            ],
            'education' => [
                'nullable',
                'string',
            ],

            'experience' => [
                'nullable',
                'string',
            ],
            'gender' => [
                'required',
                'string',
                'in:female,male',
            ],

            'can_work_in_home_visit' => [
                'required',
                'in:0,1',
            ],
            'can_work_in_hospital' => [
                'required',
                'in:0,1',
            ],


        ];
    }
}
