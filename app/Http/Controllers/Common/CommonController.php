<?php

namespace App\Http\Controllers\Common;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Mail\SendForgotPasswordOtp;
use Illuminate\Support\Facades\Mail;

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

             DB::table('password_reset_tokens')->where('email',$request->email)->delete();
            

             DB::table('password_reset_tokens')->insert([
                'email'=>$request->email,
                'token'=>$token,
                'created_at'=>now(),
            ]);

            $data['code'] = $token;

            if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                Mail::to($request->email)->send(new SendForgotPasswordOtp($data));
            }

            session()->flash('success','OTP successfully send.');
            session()->put('forgot_password_email',$request->email);
            return redirect()->route('frontend.otpValidations');
        }

        return inertia('common/ForgotPassword');
    }



    public function otpValidations(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'email'=>'required|email',
                'otp'=>'required'
            ]);

          
            $get_otp = DB::table('password_reset_tokens')->where('token',$request->otp)->where('email',$request->email)->first();

            if(!$get_otp) {
                return back()->withErrors([
                    'otp' => 'Invalid OTP',
                ]);
            }
            DB::table('password_reset_tokens')->where('email',$request->email)->delete();

            session()->flash('success','OTP successfully validate.');
            return to_route('frontend.resetPassword');

        }

        return inertia('Common/OtpValidation')->with('email',session()->get('forgot_password_email'));
    }


    public function resetPassword(Request $request)
    {
        
        if($request->isMethod('post')){

            $request->validate([
                'password'=>'required|min:8',
                'confirm_password'=>'required|same:password'
            ]);
            $user = User::where('email',session()->get('forgot_password_email'))->first();
            if($user){
                // dd(session()->get('forgot_password_email'),$request->password,$user);
                 $user->password = $request->password;
                 $user->save();
                 session()->flash('success','Password successfully changed.');
             }else{
                session()->flash('error','Something went wrong. Please try again.');
             }
          
             $request->session()->forget('forgot_password_email');
             return to_route('frontend.login');

        }

        return inertia('common/ResetPassword');
    }


    
}
