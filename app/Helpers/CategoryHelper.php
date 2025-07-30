<?php

namespace App\Helpers;

use App\Models\Translation;
use Illuminate\Support\Str;

class CategoryHelper
{
    public static function data($request,$image)
    {
        $locales = Translation::where('status',1)->get();
        $title = []; $slug = [];

        foreach ($locales as $locale) {
            $code = isset($locale['code']) ? $locale['code'] : 'az';
            $title[$code] = $request->input("title.".$code, '');
            $slug[$code] = Str::slug(trim($request->input("title.".$code, '')));
        }
        if($request->hasFile('image')){
            $image_name = time().'.'.$request->image->extension();
            $image_url = $request->image->move(public_path('uploads/categories'), $image_name);
            $image = $image_url->getFilename();
        }else{
            $image_name = !empty($image)? $image: NULL;
        }

        $data = [
            'parent_id' => !empty($request->parent_id)? $request->parent_id: NULL,
            'sub_category_id' => !empty($request->sub_category_id)? $request->sub_category_id: NULL,
            'title' => $title,
            'slug' => $slug,
            'image' => $image_name,
            'type' => 'company',
            'status' => $request->status ?? 0,
        ];

        return $data;
    }
}
