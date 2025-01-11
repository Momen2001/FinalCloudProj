<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'main_service_id' => [
                'required',
                'exists:main_services,id',
            ],
            'status' => [
                'required',
            ],
            'photo' => [
                'nullable',
                'mimes:jpeg,png,jpg'
            ],
            'title_ar' => [
                'required',
                'string',
                'max:100',
            ],
            'description_ar' => [
                'nullable',
                'string',
             ],
            'instructions_ar' => [
                'nullable',
                'string',
            ],
            'include_ar' => [
                'nullable',
                'string',
            ],
            'title_en' => [
                'required',
                'string',
                'max:100',
            ],
            'description_en' => [
                'nullable',
                'string',
             ],
            'instructions_en' => [
                'nullable',
                'string',
            ],
            'include_en' => [
                'nullable',
                'string',
            ],

        ];
    }
}
