<?php

namespace App\Helpers;

use App\Models\Translation;

class StaticPageHelper
{
    public static function data($request,$image)
    {
        $locales = Translation::where('status',1)->get();
        $title = [];
        $text = [];
        $full_text = [];

        foreach ($locales as $locale) {
            $code = isset($locale['code']) ? $locale['code'] : 'az';
            $title[$code] = $request->input("title.".$code, '');
            $text[$code] = $request->input("text.".$code, '');
            $full_text[$code] = $request->input("full_text.".$code, '');
        }
        if($request->hasFile('image')){
            $image_name = time().'.'.$request->image->extension();
            $image_url = $request->image->move(public_path('uploads/static-pages'), $image_name);
            $image = $image_url->getFilename();
        }else{
            $image_name = !empty($image)? $image: NULL;
        }

        $data = [
            'title' => $title,
            'text' => $text,
            'full_text' => $full_text,
            'image' => $image_name,
            'type' => $request->type
        ];

        return $data;
    }
}
