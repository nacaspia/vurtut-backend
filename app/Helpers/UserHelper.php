<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Hash;

class UserHelper
{
    public static function userData($request,$user)
    {
        if($request->hasFile('logo')){
            $logoName = time().'.'.$request->logo->extension();
            $logo = $request->logo->move(public_path('uploads/users/image'), $logoName);
            $logoImage = $logo->getFilename();
        }else{
            $logoImage = !empty($user->image)? $user->image: NULL;
        }

        $data = [
            'gender' => $request->gender,
            'address' => $request->address,
        ];

        $password = !empty($request->password)?Hash::make($request->password) :$user->password;
        $userData = [
            'logo' => $logoImage,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'text' => $request->text,
            'data' => $data,
            'password' => $password,
            'status' => $request->status
        ];

        return $userData;
    }
}
