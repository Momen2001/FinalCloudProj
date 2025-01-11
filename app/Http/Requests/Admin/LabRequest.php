<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LabRequest extends FormRequest
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
        $lab = mainServiceById()['Lab'];
        return [
            'first_name' => ['required', 'string',],
            'last_name' => ['required', 'string',],
            'provider_name_ar' => ['required', 'string',],
            'provider_name_en' => ['required', 'string',],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->id],
            'password' => ['required_without:id',],
            'phone' => ['required', 'min:9', 'max:9', 'unique:users,phone,' . $this->id],
            'location_ar' => ['required', 'string',],
            'location_en' => ['required', 'string',],
            'latitude' => ['required', 'string',],
            'longitude' => ['required', 'string',],
            'photo' => ['nullable', 'mimes:jpeg,png,jpg'],
            'country_id' => ['required', 'exists:countries,id',],
            'city_id' => ['required', 'exists:cities,id',],
            'main_service_id' => ['required', 'exists:main_services,id', "in:$lab"],
            'commission' => ['required', 'numeric', 'min:0'],
            'support_B2B' => ['required', 'boolean'],
            'payment_methods' => ['required', 'exists:payment_methods,id'],
        ];
    }
}
