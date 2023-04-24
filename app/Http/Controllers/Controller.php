<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sendServerError($e)
    {
        return response()->json(["status" => false, "message" => "Something went wrong. Please try again",'error'=>$e->getMessage().' File: '.$e->getFile().' Line:'.$e->getLine(), "data" => []]);
        
    }
}
