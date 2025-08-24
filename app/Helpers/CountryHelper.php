<?php

namespace App\Helpers;

use App\Models\Translation;

class CountryHelper
{
    public static function data($request)
    {
        $name = [];
        $locales = Translation::where('status',1)->get();
        foreach ($locales as $locale) {
            $code = isset($locale['code']) ? $locale['code'] : '';
            $name[$code] = $request->input("name.$code", '');
        }
        $data = ['name' => $name, 'status' => $request->status];
        return $data;
    }
}
