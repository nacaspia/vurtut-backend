<?php

namespace App\Http\Requests\Site\Company;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

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
            'parent_id' => 'required|gt:0',
            'category_id' => 'required|exists:categories,id',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'full_name' => 'required',
            'one_email' => 'required|email',
            'one_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'two_phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'tiktok' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'hours.*'   => 'required',
            'services'  => 'required|array|min:1',
            'services.*'=> 'required|distinct',
//            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }


    public function messages()
    {
        return [
            '*.required' =>  Lang::get('validation.required', ['attribute' => ':attribute']),
//            'image.required' => 'Şəkil yükləmək məcburidir.',
            'image.image' => 'Yüklənən fayl şəkil olmalıdır.',
            'image.mimes' => 'Şəkil yalnız JPEG, PNG və ya JPG formatında olmalıdır.',
            'image.max' => 'Şəkil ölçüsü maksimum 127 KB olmalıdır.',
            'image.dimensions' => 'Şəkil ölçüsü 2953 × 1455 px olmalıdır.',
        ];
    }
}
