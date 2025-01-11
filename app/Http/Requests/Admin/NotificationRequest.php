<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
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
            'image' => [
                'nullable',
                'mimes:jpg'
            ],
            'platform' => [
                'required',
                'string',
            ],

            'body_ar' => [
                'required',
                'string',
            ],
            'body_en' => [
                'required',
                'string',
            ],
            'title_ar' => [
                'required',
                'string',
            ],
            'title_en' => [
                'required',
                'string',
            ],
        ];
    }
}
