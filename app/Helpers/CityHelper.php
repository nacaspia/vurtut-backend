<?php

namespace App\Helpers;

use App\Models\Translation;
use Illuminate\Support\Str;

class CityHelper
{
    public static function data($request, $city = null)
    {
        $name = [];
        $locales = Translation::where('status',1)->get();

        foreach ($locales as $locale) {
            $code = isset($locale['code']) ? $locale['code'] : '';
            $name[$code] = $request->input("name.$code", '');
            $slug[$code] = Str::slug(trim($request->input("name.".$code, '')));
        }
        if($request->hasFile('image')){
            $image = time().$request->image->extension();
            $request->image->move(public_path('uploads/cities'), $image);
        }else{
            $image = !empty($city->image)? $city->image: NULL;
        }
        $data = [
            'name' => $name,
            'slug' => $slug,
            'image' => $image,
            'country_id' => $request->country_id,
            'sub_region_id' => $request->sub_region_id ?? null,
            'status' => $request->status,
        ];

        return $data;
    }
}
