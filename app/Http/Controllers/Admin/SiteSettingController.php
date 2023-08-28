<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteSettingController extends Controller
{
    function setting(Request $request) {
        $settings = SiteSetting::get();

        $setting = [];
        foreach($settings as $value ){
            if($value->key == 'logo'){
                $value->value = url()->to($value->value);
            }
            $setting[$value->key] = $value->value;
            
        }

        if($request->isMethod('post')){

            $credentials = $request->validate([
                'logo' => 'nullable',
                'date_format' => 'required',
                'per_page' => 'required',
                'main_color' => 'required',
                'hover_color' => 'required',
                'button_color' => 'required',
              ]);

            //   dd($request->all());
            
            SiteSetting::where('key','date_format')->update(['value'=>$request->date_format]);
            SiteSetting::where('key','per_page')->update(['value'=>$request->per_page]);
            SiteSetting::where('key','main_color')->update(['value'=>$request->main_color]);
            SiteSetting::where('key','hover_color')->update(['value'=>$request->hover_color]);
            SiteSetting::where('key','button_color')->update(['value'=>$request->button_color]);
            
            if ($request->hasFile('logo')) {
                $filename = time() . '-' . rand(1000, 9999) . '.' . $request->logo->extension();
                $request->file('logo')->storeAs('public/logo/', $filename);
                $path = 'storage/logo/'.$filename;
                SiteSetting::where('key','logo')->update(['value'=>$path]);
            }

            return redirect()->back();

        }

        return Inertia::render('Admin/setting/Setting',compact('setting'));
    }
}
