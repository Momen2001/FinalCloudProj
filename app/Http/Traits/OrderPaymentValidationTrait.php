<?php

namespace App\Http\Traits;


trait OrderPaymentValidationTrait
{
    public function makePaymentValidation($request): array
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'order_id' => [
                'required',
                'numeric',
                'exists:orders,id',
            ],
        ]);

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }


}















