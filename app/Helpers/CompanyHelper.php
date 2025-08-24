<?php

namespace App\Helpers;

use App\Models\Translation;

class CompanyHelper
{
    public static function prepareCompanyData($request)
    {
        $nameData = [];
        $addressData = [];
        $descriptionData = [];
        $locales = Translation::where('status',1)->get();


        foreach ($locales as $locale) {
            $code = isset($locale['code']) ? $locale['code'] : '';
            $nameData[$code] = $request->input("name.$code", '');
            $addressData[$code] = $request->input("address.$code", '');
            $descriptionData[$code] = $request->input("description.$code", '');

        }
        $codeData = mb_strtolower($request->input("name.$code", ''), 'UTF-8');
        if($request->hasFile('logo')){
            $logoName = time().'.'.$request->logo->extension();
            $logo = $request->logo->move(public_path('uploads/companies/logo'), $logoName);
            $logoImage = $logo->getFilename();
        }else{
            $logoImage = 0;
        }

//        $maxFileSize = 5000000; // 5MB
        if($request->hasFile('contract')){
            $contractName = time().'.'.$request->contract->extension();
            $contract = $request->contract->move(public_path("uploads/companies/contract/"), $contractName);
            $contractFile =  $contract->getFilename();
        }else{
            $contractFile = 0;
        }

        $companyData = [
            'name' => $nameData,
            'address' => $addressData,
            'description' => $descriptionData,
            'status' => $request->status == 'on' ? 1 : 0,
            'logo' => $logoImage,
            'contract' => $contractFile,
            'code' => $codeData,
            'user_id' => !empty($request->user_id)? (int)$request->user_id: 0
        ];

//        dd($companyData);
        return $companyData;
    }
}
