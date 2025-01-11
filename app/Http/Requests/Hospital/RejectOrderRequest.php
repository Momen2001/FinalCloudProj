<?php

namespace App\Http\Requests\Hospital;

use Illuminate\Foundation\Http\FormRequest;

class RejectOrderRequest extends FormRequest
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
            'orderId' => [
                'required',
                'exists:orders,id',
            ],
            'rejectReasonEn' => [
                $this->rejectReasonCondition(),
                'string',
            ],
            'rejectReasonAr' => [
                $this->rejectReasonCondition(),
                'string',
            ],
            'rejectReasonId' => [
                'required',
                'exists:reject_reasons,id',
                'string',
            ],
        ];
    }

    protected function rejectReasonCondition()
    {
        return $this->input('rejectReasonId') == 1 ? 'required' : 'nullable';
    }

}
