<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public $per_page = 5;

    public function __construct() {
        // if(auth()->check() && auth()->user()->role_name == "SUPER-ADMIN"){
            $get_setting = SiteSetting::where('key','per_page')->first();
            $this->per_page = $get_setting->value ?? 5; 
        // }
    }

    public function sendServerError($e)
    {
        return response()->json(["status" => false, "message" => "Something went wrong. Please try again",'error'=>$e->getMessage().' File: '.$e->getFile().' Line:'.$e->getLine(), "data" => []]);
        
    }
}
