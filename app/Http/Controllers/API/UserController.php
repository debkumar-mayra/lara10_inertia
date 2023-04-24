<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    
    public function profile()
    {
        try {
            $user = auth()->user();
            return response()->json(["status" => true, "message" => "", "data" => $user]);
           
        } catch (\Throwable $th) {
            return $this->sendServerError($th);
        }
    }

    

    public function logout(Request $request)
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        
        return $this->sendResponse([], 'Logout successfully.');
    }




}
