<?php

namespace App\Http\Traits;

trait ApiAuthValidationTrait
{
    public function  register_validation($request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'birth_date' => 'required',
            'country_id' => 'required|exists:countries,id',
            'passport_id' => 'required',
            'phone' => ['required', 'numeric', 'digits:9', 'unique:users,phone'],
            'intro' => 'required|exists:countries,phone_code',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            'gender' => 'required|in:female,male',
            'confirm_condition' => 'required|in:1'
        ], [
            'name.required' => __('validation.required'),
            'phone.required' => __('validation.required'),
            'email.required' => __('validation.required'),
            'email.email' => __('validation.email'),
            'email.unique' => __('validation.unique'),
            'phone.unique' => __('validation.unique'),
            'phone.regex' => __('validation.regex'), // Add error message for phone regex validation
            'password.required' => __('validation.required'),
            'password_confirmation.required' => __('validation.required'),
            'password_confirmation.same' => __('validation.same'),
            'confirm_condition.required' => __('validation.required'),
        ]);

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }


    public function check_code_validation($request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'phone' => 'required|numeric|exists:users,phone',
            'code' => 'required',
            'intro' => 'required|exists:countries,phone_code',
        ], [
            'name.required' => __('validation.required'),
            'photo.required' => __('validation.required'),
        ]);

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }


    public function update_phone_validation($request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'phone' => 'required|numeric|digits:9',
            'intro' => 'required|exists:countries,phone_code',
            'code' => 'required',
        ], [
            'name.required' => __('validation.required'),
            'photo.required' => __('validation.required'),
        ]);

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }

    public function login_validation($request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'emailOrPhone' => 'required',
            'password' => 'required',
        ], [
            'emailOrPhone.required' => __('validation.required'),
            'photo.required' => __('validation.required'),
        ]);

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }

    public function login_validation_phone($request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'emailOrPhone' => 'required|exists:users,phone',
            'intro' => 'required|exists:countries,phone_code',
        ], [
            'emailOrPhone.required' => __('validation.required'),
            'emailOrPhone.exists' => __('validation.exists'),
        ]);

        if ($validator->fails()) {
            return ['status' => 'errorInEmailOrPhone', 'message' => $validator->errors()->first()];
        } else {
            return ['status' => 'SuccessAuth', 'message' => []];
        }
    }

    public function login_validation_email($request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'emailOrPhone' => 'required|exists:users,email',
        ], [
            'emailOrPhone.required' => __('validation.required'),
            'emailOrPhone.exists' => __('validation.exists'),
        ]);

        if ($validator->fails()) {
            return ['status' => 'errorInEmailOrPhone', 'message' => $validator->errors()->first()];
        } else {
            return ['status' => 'SuccessAuth', 'message' => []];
        }
    }

    public function resendCodeValidation($request)
    {
        if (auth('api')->check()) {
            $phone_validation='required|numeric';
        }else{
            $phone_validation='required|numeric|exists:users,phone';
        }

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'phone' =>$phone_validation ,
            'intro' => 'required|exists:countries,phone_code',
        ], [
            'phone.exists' => __('validation.exists'),
        ]);

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }


    public function resetPasswordValidation($request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ], [
            'password.required' => __('validation.required'),
            'password_confirmation.required' => __('validation.required'),
            'password_confirmation.same' => __('validation.same'),
        ]);

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }

    public function forgetPasswordValidation($request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            'phone' => 'required|numeric|exists:users,phone',
            'intro' => 'required|exists:countries,phone_code',

        ]);

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }


}
