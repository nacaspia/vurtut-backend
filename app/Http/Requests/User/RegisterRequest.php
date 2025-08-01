<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

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
            'full_name' => 'required',
            'phone' => 'required|unique:users,phone|regex:/^([0-9\s\-\+\(\)]*)$/|min:13',
            'email' => 'required|unique:users,email|email',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            '*.required' =>  Lang::get('validation.required', ['attribute' => ':attribute']),
            '*.regex' =>  Lang::get('validation.regex', ['attribute' => ':attribute']),
            '*.unique' =>  Lang::get('validation.unique', ['attribute' => ':attribute']),
            '*.email' =>  Lang::get('validation.email', ['attribute' => ':attribute']),
        ];
    }
}
