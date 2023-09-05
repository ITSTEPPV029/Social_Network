<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class SettingsRequest extends FormRequest
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
            'first_name' => 'string|regex:/^[^0-9]*$/',
            'last_name' => 'string|regex:/^[^0-9]*$/',
            'nick_name' => [
                'string', 'max:30', 'alpha_dash',
                Rule::unique('users')->ignore(Auth::user()->id),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore(Auth::user()->id),
            ],
            'date_of_birth' => 'nullable|date|before_or_equal:today',
            'gender' => '',
            'city' => '',
            'about_me' => '',
        ];
    }
}
