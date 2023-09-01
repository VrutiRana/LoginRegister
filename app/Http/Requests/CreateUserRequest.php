<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'firstname' => 'required|alpha',
            'lastname' => 'required|alpha',
            'username' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|digits:10',
            'password' => 'required|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/',
            'cpassword' => 'required_with:password|same:password|min:6'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'firstname.required'        =>  "First Name is required",
            'lastname.required'        =>  "First Name is required",
            'username.required'        =>  "First Name is required",
            'email.required'        =>  "Email is required",
            'email.email'          => "Email is unique ",
            'password.required'     =>  "Password is required",
        ];
    }
}
