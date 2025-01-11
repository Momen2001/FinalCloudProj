<?php

namespace App\Http\Traits;


trait MedicalRecordsValidationTrait
{


    public function storeValidation($request)
    {

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'type' => "required|numeric|exists:report_types,id",
            'title' => 'required|string',
            'description' => 'required|string',
            'medical_media' => 'required|max:5000|mimes:jpeg,png,jpg,pdf',
        ]);

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }


    }

    public function showValidation($request)
    {
        return ['status' => true, 'message' => []];

    }


}
