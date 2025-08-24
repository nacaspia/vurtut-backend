<?php

namespace App\Http\Requests\Site\Company;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class CompanyPostRequest extends FormRequest
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }


    public function messages()
    {
        return [
            'image.required' => 'Şəkil yükləmək məcburidir.',
            'image.image' => 'Yüklənən fayl şəkil olmalıdır.',
            'image.mimes' => 'Şəkil yalnız JPEG, PNG və ya JPG formatında olmalıdır.',
            'image.max' => 'Şəkil ölçüsü maksimum 127 KB olmalıdır.',
            'image.dimensions' => 'Şəkil ölçüsü 2953 × 1455 px olmalıdır.',
        ];
    }
}
