<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
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
            'first_name' => [
                'required',
                'string',
            ],
            'last_name' => [
                'required',
                'string',
            ],


            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email,' . $this->id
            ],
            'password' => [
                'required_without:id',
            ],
            'passport_id' => [
                'required',
            ],
            'phone' => [
                'required',
                'numeric',
                'digits:9',
                'unique:users,phone,' . $this->id
            ],
            'photo' => [
                'nullable',
                'mimes:jpeg,png,jpg'
            ],
            'country_id' => [
                'required',
                'exists:countries,id',
            ],
            'insurance_comp_id' => [
                'nullable',
                'exists:insurance_comps,id',
            ],
            'city_id' => [
                'required',
                'exists:cities,id',
            ],
            'gender' => [
                'required',
                'in:female,male',
            ],


        ];
    }
}



