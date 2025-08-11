<?php

namespace App\Helpers\Company;
class CompanyPostHelper
{
    public static function data($request,$image)
    {
        $company = auth('company')->user()->id;
        if($request->hasFile('image')){
//            $image_name = time().'.'.$request->image->extension();
            $image_name = $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/company-posts'), $image_name);
        }else{
            $image_name = !empty($image)? $image: NULL;
        }

        $data = [
            'company_id' => !empty($company)? $company: NULL,
            'title' => $request->title ?? NULL,
            'image' => $image_name,
            'status' => 1,
        ];

        return $data;
    }
}
