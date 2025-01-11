<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ReportTypesRequest extends FormRequest
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
            'color' => [
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
            'title_en' => [
                'required',
                'string',
                'max:100',
            ],


        ];
    }
}
