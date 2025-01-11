<?php

namespace App\Http\Requests\Hospital;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
//                'required_without:id',
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
                'nullable',
            ],
            'phone' => [
                'required',
                'numeric',
                'digits:9',
                'unique:users,phone,' . $this->id
            ],
//            'country_id' => [
//                'required',
//                'exists:countries,id',
//            ],
//
//            'city_id' => [
//                'required',
//                'exists:cities,id',
//            ],
            'specializations*' => [
                'required',
                'exists:specializations,id',
            ],

            'passport_id' => [
                'nullable',
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
            'emergency_online_price' => [
                'required_if:can_work_emergency_online,1',
                'min:1'
            ],
            'experience_start_work' => [
                'nullable',
            ],
            'emergency_home_visit_price' => [
                'required_if:can_work_emergency_home_visit,1',
                'min:1'
            ],
            'online_price' => [
                'required_if:can_work_online,1',
                'min:1'
            ],
            'home_visit_price' => [
                'required_if:can_work_in_home_visit,1',
                'min:1'
            ],
            'in_hospital_price' => [
                'required_if:can_work_in_hospital,1',
                'min:1'
            ],
            'speciality' => [
                'nullable',
                'string',
            ],
            'speciality_en' => [
                'nullable',
                'string',
            ],
            'license' => [
                'nullable',
                'string',
            ],
            'bio' => [
                'nullable',
                'string',
            ],
            'bio_en' => [
                'nullable',
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
            'can_work_emergency_online' => [
                'required',
                'in:0,1',
            ],
            'can_work_emergency_home_visit' => [
                'required',
                'in:0,1',
            ],
            'can_work_in_home_visit' => [
                'required',
                'in:0,1',
            ],
            'can_work_in_hospital' => [
                'required',
                'in:0,1',
            ],
            'can_work_online' => [
                'required',
                'in:0,1',
            ],

        ];
    }
}
