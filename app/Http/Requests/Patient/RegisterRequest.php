<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        ];
    }

    public function messages()
    {
        return [
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
        ];
    }
}
