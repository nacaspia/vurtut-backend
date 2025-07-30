<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class SettingsController extends Controller
{
    public function settings()
    {
        $settings = Setting::first();
        return view('admin.settings',compact('settings'));
    }

    public function settingsSave(Request $request) {
        $validated = $request->validate([
            'full_name' => 'required',
            'text' => 'required',
        ],[
            'full_name.required' => 'Ad vacibdir',
            'text.required' => 'Qısa məlumat vacibdir'
        ]);

        if($request->hasFile('header_logo')){
            $header_logo = time().'.'.$request->header_logo->extension();
            $request->header_logo->move(public_path('uploads/header_logo'), $header_logo);
        }else{
            $header_logo = NULL;
        }

        if($request->hasFile('footer_logo')){
            $footer_logo = time().'.'.$request->footer_logo->extension();
            $request->footer_logo->move(public_path('uploads/footer_logo'), $footer_logo);
        }else{
            $footer_logo = NULL;
        }

        if($request->hasFile('favicon')){
            $favicon = time().'.'.$request->favicon->extension();
            $request->favicon->move(public_path('uploads/favicon'), $favicon);
        }else{
            $favicon = NULL;
        }
        $logo = [
            'header_logo' => $header_logo,
            'footer_logo' => $footer_logo,
            'favicon' => $favicon
        ];
        $social = [
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'tiktok' => $request->tiktok,
            'linkedin' => $request->linkedin,
            'youtube' => $request->youtube,
            'email' => $request->email,
            'phone' => $request->phone,
            'phone_two' => $request->phone_two
        ];
        $data = [
            'address' => $request->address
        ];
        Setting::create([
            'full_name' => $request->full_name,
            'text' => $request->text,
            'logo' => $logo,
            'social' => $social,
            'data' => []
        ]);
        return redirect()->back()->with('success', Lang::get('admin.add_success'));
    }
    public function settingsUpdate(Request $request,$id) {
        $validated = $request->validate([
            'full_name' => 'required',
            'text' => 'required',
        ],[
            'full_name.required' => 'Ad vacibdir',
            'text.required' => 'Qısa məlumat vacibdir'
        ]);

        $settings = Setting::where('id',$id)->first();
        if($request->hasFile('header_logo')){
            $header_logo = time().'.'.$request->header_logo->extension();
            $request->header_logo->move(public_path('uploads/header_logo'), $header_logo);
        }else{
            $header_logo = !empty($settings['logo']['header_logo']) ? $settings['logo']['header_logo'] : '';
        }

        if($request->hasFile('footer_logo')){
            $footer_logo = time().'.'.$request->footer_logo->extension();
            $request->footer_logo->move(public_path('uploads/footer_logo'), $footer_logo);
        }else{
            $footer_logo = !empty($settings['logo']['footer_logo']) ? $settings['logo']['footer_logo'] : '';
        }

        if($request->hasFile('favicon')){
            $favicon = time().'.'.$request->favicon->extension();
            $request->favicon->move(public_path('uploads/favicon'), $favicon);
        }else{
            $favicon = !empty($settings['logo']['favicon']) ? $settings['logo']['favicon'] : '';
        }
        $logo = [
            'header_logo' => $header_logo,
            'footer_logo' => $footer_logo,
            'favicon' => $favicon
        ];
        $social = [
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'tiktok' => $request->tiktok,
            'linkedin' => $request->linkedin,
            'youtube' => $request->youtube,
            'email' => $request->email,
            'phone' => $request->phone,
            'phone_two' => $request->phone_two
        ];
        Setting::where('id',$id)->update([
            'full_name' => $request->full_name,
            'text' => $request->text,
            'logo' => $logo,
            'social' => $social,
            'data' => []
        ]);
        return redirect()->back()->with('success', Lang::get('admin.add_success'));
    }
}
