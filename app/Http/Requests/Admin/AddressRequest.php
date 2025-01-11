<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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

            'title_ar' => [
                'required',
                'max:50',
            ],
            'title_en' => [
                'required',
                'max:50',
            ],
            'description_ar' => [
                'required',
                'max:100',
            ],
            'description_en' => [
                'required',
                'max:100',
            ],
            'status' => [
                'required',
            ],
            'latitude' => [
                'required',
            ],

            'longitude' => [
                'required',
            ],

        ];
    }
}
