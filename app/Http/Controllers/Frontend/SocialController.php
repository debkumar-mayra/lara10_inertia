<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{

    
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
        
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $findUser = User::where('google_id', $user->id)->first();
       
            if($findUser){
                Auth::login($findUser);
                return redirect()->intended('dashboard');
            }else{
                $newUser = new User();
                    $newUser->first_name = $user->name;
                    $newUser->email = $user->email;
                    $newUser->google_id = $user->id;
                    $newUser->password = encrypt('123456dummy');
                    $newUser->save(); 
                    $newUser->assignRole('USER');
                    Auth::login($newUser);
                return redirect()->intended('dashboard');
            }
      
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }





    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
        
    public function handleFacebookCallback()
    {
        try {
        
            $user = Socialite::driver('facebook')->user();
            dd($user);
         
            $findUser = User::where('facebook_id', $user->id)->first();
        
            if($findUser){
                Auth::login($findUser);
                return redirect()->intended('dashboard');
            }else{
                    $newUser = new User();
                    $newUser->name= $user->name;
                    $newUser->email= $user->email;
                    $newUser->facebook_id= $user->id;
                    $newUser->password= encrypt('123456dummy');
                    $newUser->save(); 
                    $newUser->assignRole('USER');
        
                Auth::login($newUser);
        
                return redirect()->intended('dashboard');
            }
        
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }


}
