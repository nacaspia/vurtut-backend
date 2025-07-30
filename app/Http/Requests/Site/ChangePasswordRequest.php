<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'conf_new_password' => 'required_with:new_password|same:new_password|min:6',
        ];
    }

    public function messages()
    {
        return [
            '*.required' =>  Lang::get('validation.required', ['attribute' => ':attribute']),
        ];
    }
}
