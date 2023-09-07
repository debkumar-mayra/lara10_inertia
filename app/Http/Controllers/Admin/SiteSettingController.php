<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\SiteSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;

class SiteSettingController extends Controller
{
    function setting() {
        $settings = SiteSetting::get();
        
        $setting = [];
        foreach($settings as $value ){
            if($value->key == 'logo'){
                $value->value =  $value->value ? url()->route('image', ['path' => $value->value]) : null;
            }
            $setting[$value->key] = $value->value;
            
        }
        
        if(request()->isMethod('post')){
            $credentials = request()->validate([
                'logo' => 'nullable',
                'date_format' => 'required',
                'per_page' => 'required',
                'main_color' => 'required',
                'hover_color' => 'required',
                'button_color' => 'required',
              ]);

            //   dd(request()->all());
            
            SiteSetting::where('key','date_format')->update(['value'=>request()->date_format]);
            SiteSetting::where('key','per_page')->update(['value'=>request()->per_page]);
            SiteSetting::where('key','main_color')->update(['value'=>request()->main_color]);
            SiteSetting::where('key','hover_color')->update(['value'=>request()->hover_color]);
            SiteSetting::where('key','button_color')->update(['value'=>request()->button_color]);
            
            if(request()->file('logo')){
                // dd(request()->file('logo'));
                File::delete(storage_path('app/'.SiteSetting::where('key','logo')->pluck('value')->first()));
                SiteSetting::where('key','logo')->update(['value'=>request()->file('logo')->store('logo')]);
            }

            return redirect()->back();

        }

        return Inertia::render('Admin/setting/Setting',compact('setting'));
    }
}
