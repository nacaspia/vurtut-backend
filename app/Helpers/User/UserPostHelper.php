<?php

namespace App\Helpers\User;
class UserPostHelper
{
    public static function data($request,$image)
    {
        $user = auth('user')->user()->id;
        if($request->hasFile('image')){
            $image_name = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/user-posts'), $image_name);
        }else{
            $image_name = !empty($image)? $image: NULL;
        }

        $data = [
            'user_id' => !empty($user)? $user: NULL,
            'title' => $request->title ?? NULL,
            'image' => $image_name,
            'status' => 1,
        ];

        return $data;
    }
}
