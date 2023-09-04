<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            //'nick_name' => 'required|string|unique:users|max:30|alpha_dash',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|string|min:6',
        ];
    }
}
