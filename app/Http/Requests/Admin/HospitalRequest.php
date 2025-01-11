<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class HospitalRequest extends FormRequest
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
            'provider_name_ar' => [
                'required',
                'string',
            ],
            'location_ar' => [
                'required',
                'string',
            ],
            'about_us_en' => [
                'required',
                'string',
            ],
            'about_us_ar' => [
                'required',
                'string',
            ],
            'location_en' => [
                'required',
                'string',
            ],
            'latitude' => [
                'required',
                'string',
            ],
            'longitude' => [
                'required',
                'string',
            ],
            'provider_name_en' => [
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
//            'intro' => [
//                'required',
//                'exists:countries,phone_code',
//            ],
            'country_id' => [
                'required',
                'exists:countries,id',
            ],
            'city_id' => [
                'required',
                'exists:cities,id',
            ],

            'main_service_active' => ['required', 'array'],
            'main_service_active.*' => ['required', 'boolean'],
            'main_service_id' => ['required', 'array'],
            'main_service_id.*' => ['required', 'exists:main_services,id'],

            'commission.*' => ['required', 'numeric', 'min:0'],
            'support_B2B.*' => ['required', 'boolean'],
            'payment_methods.*' => ['required', 'exists:payment_methods,id'],

        ];
    }
}
