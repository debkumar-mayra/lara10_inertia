<?php

namespace App\Http\Controllers\Common;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    public function forgotPassword(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'email'=>'required|email'
            ]);

            $token = rand(100000,999999);

            $get_user = User::where('email',$request->email)->first();

            if(!$get_user) {
                return back()->withErrors([
                    'email' => 'Please enter your registered email',
                ]);
            }

            $get_otp = DB::table('password_reset_tokens')->where('email',$request->email)->delete();
            

            $create_token = DB::table('password_reset_tokens')->insert([
                'email'=>$request->email,
                'token'=>$token,
                'created_at'=>now(),
            ]);

            session()->flash('success','OTP successfully send.');
            return back()->with('email',$request->email);

            // return redirect()->route('frontend.otpValidations')->with('email',$request->email);
        }

        return inertia('common/ForgotPassword');
    }



    public function otpValidations(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'email'=>'required|email'
            ]);

            $token = rand(100000,999999);

            $get_user = User::where('email',$request->email)->first();

            if(!$get_user) {
                return back()->withErrors([
                    'email' => 'Please enter your registered email',
                ]);
            }

            $get_otp = DB::table('password_reset_tokens')->where('email',$request->email)->delete();
            

            $create_token = DB::table('password_reset_tokens')->insert([
                'email'=>$request->email,
                'token'=>$token,
                'created_at'=>now(),
            ]);

            session()->flash('success','OTP successfully send.');
        }

        return inertia('common/OtpValidation');
    }


    
}
