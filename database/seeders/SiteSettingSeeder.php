<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $data = [
            [ 
            'key'=>'logo',
            'value'=>'storage/logo/logo.png',
            ],
            [ 
                'key'=>'date_format',
                'value'=>'L',
            ],
            [ 
                'key'=>'per_page',
                'value'=>5,
            ],
            [ 
                'key'=>'main_color',
                'value'=>'#770be8',
            ],
            [ 
                'key'=>'hover_color',
                'value'=>'#ed521b',
            ],
            [ 
                'key'=>'button_color',
                'value'=>'#770be8',
            ],


           ];

           foreach($data as $value){
            $setting = SiteSetting::where('key',$value['key'])->first();
            if(empty( $setting )){
                $setting = new SiteSetting();
            }

             $setting->key = $value['key'];
             $setting->value = $value['value'];
             $setting->save();
           }

    }
}
