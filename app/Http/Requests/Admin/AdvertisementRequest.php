<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdvertisementRequest extends FormRequest
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
            'status' => [
                'required',
            ],
            'photo' => [
                'required_without:id',
                'mimes:jpeg,png,jpg'
            ],
            'link' => [
                'nullable',
            ],
            'color_degree' => [
                'required',
            ],
            'btn_show' => [
                'required',
            ],
            'title_ar' => [
                'required',
            ],
            'title_en' => [
                'required',
            ],
            'description_en' => [
                'required',
                'string',
            ],
            'description_ar' => [
                'required',
                'string',
            ],
            'btn_text_en' => [
                'required',
                'string',
            ],
            'btn_text_ar' => [
                'required',
                'string',
            ],
        ];
    }
}
