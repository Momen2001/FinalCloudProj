<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ManagerRequest extends FormRequest
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
            'phone' => [
                'required',
                'digits:9',
                'unique:users,phone,' . $this->id
            ],
            'photo' => [
                'nullable',
                'mimes:jpeg,png,jpg'
            ],
            'intro' => [
                'required',
                'exists:countries,phone_code',
            ],
            'country_id' => [
                'required',
                'exists:countries,id',
            ],
            'city_id' => [
                'required',
                'exists:cities,id',
            ],
        ];
    }
}
