<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\SendForgotPasswordOtp;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "first_name" =>  "required",
            "last_name" =>  "required",
            "email" =>  "required|email|unique:users,email",
            "password" =>  "required",
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => false, "message" => $validator->errors()->first(), "data" => $validator->errors()]);
        }

        try {

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        $user->assignRole('USER');
        $token =  $user->createToken('token')->plainTextToken;

        return response()->json(["status" => true, "message" => "User successfully created","token"=>$token, "data" => $user]);

        } catch (\Throwable $th) {
            return $this->sendServerError($th);
        }
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" =>  "required|email",
            "password" =>  "required",
            "device_token" =>  "nullable",
            "device_type" =>  "nullable"
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => false, "message" => $validator->errors()->first(), "data" => $validator->errors()]);
        }

        try {

            $user = User::where("email", $request->email)->first();

            if (is_null($user)) {
                return response()->json(["status" => false, "message" => "Failed! email not found", "data" => []]);
            }

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user =  User::find(Auth::id());
                $token =  $user->createToken('token')->plainTextToken;

                // $user->device_token = $request->device_token;
                // $user->device_type = $request->device_type;
                $user->save();
                return response()->json(["status" => true, "message" => "","token"=>$token, "data" => $user]);

            } else {
                return response()->json(["status" => false, "message" => "Whoops! Invalid Credential", "data" => []]);
            }
        } catch (\Throwable $th) {
            return $this->sendServerError($th);
        }
    }


    public function forgotPassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "email" =>  "required|email",
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => false, "message" => $validator->errors()->first(), "data" => $validator->errors()]);
        }

      try{
        
        $get_user = User::where('email',$request->email)->first();
        
        if(!$get_user) {
            return back()->withErrors([
                'email' => 'Please enter your registered email',
            ]);
        }
        $otp = rand(100000,999999);

        $get_otp = DB::table('password_reset_tokens')->where('email',$request->email)->delete();
        

        $create_token = DB::table('password_reset_tokens')->insert([
            'email'=>$request->email,
            'token'=>$otp,
            'created_at'=>now(),
        ]);

        $data['code'] = $otp;

        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            Mail::to($request->email)->send(new SendForgotPasswordOtp($data));
        }


        return response()->json(["status" => true, "message" => "OTP successfully send" , "data" => $data]);
      
        } catch (\Throwable $th) {
            return $this->sendServerError($th);
        }

    }



    public function otpVerify(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "email" =>  "required|email",
            "otp" =>  "required",
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => false, "message" => $validator->errors()->first(), "data" => $validator->errors()]);
        }

      try {
        
        $get_otp = DB::table('password_reset_tokens')->where('token',$request->otp)->where('email',$request->email)->first();

            if(!$get_otp) {
                return back()->withErrors([
                    'otp' => 'Invalid OTP',
                ]);
            }
            DB::table('password_reset_tokens')->where('email',$request->email)->delete();

            $user = User::where('email',$request->email)->first();

            $token =  $user->createToken('token')->plainTextToken;

        return response()->json(["status" => true, "message" => "OTP successfully validate.","token"=>$token, "data" => []]);
      
        } catch (\Throwable $th) {
            return $this->sendServerError($th);
        }

    }

    
}
