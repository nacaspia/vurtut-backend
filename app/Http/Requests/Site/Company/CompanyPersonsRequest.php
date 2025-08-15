<?php

namespace App\Http\Requests\Site\Company;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class CompanyPersonsRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];
    }


    public function messages()
    {
        return [
            '*.required' =>  Lang::get('validation.required', ['attribute' => ':attribute'])
        ];
    }
}
