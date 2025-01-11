<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RejectOfferRequest extends FormRequest
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
            'offerId' => [
                'required',
                'exists:offers,id',
            ],
            'rejectReasonEn' => [
                'required',
                'string',
            ],
            'rejectReasonAr' => [
                'required',
                'string',
            ],
        ];
    }
}
