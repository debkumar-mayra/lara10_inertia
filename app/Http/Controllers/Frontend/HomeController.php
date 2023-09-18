<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Frontend/Home');
    }

    public function about(Request $request)
    {
        return Inertia::render('Frontend/About');
    }

    public function test()
    {
        return response()->json(['success'=>true, 'message'=>'get data successfully']);
    }

    public function login()
    {
        return Inertia::render('Frontend/Login');
    }


    public function authenticate(Request $request): RedirectResponse
    {
       
        
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials) && Auth::user()->role_name == 'USER') {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }




public function socialLogin(Request $request)
{
    if($request->isMethod('post')){
        $rules = [
            "first_name"  =>  "required|max:255",
            "last_name"  =>  "nullable|max:255",
            "email"  =>  "required|email",
            "provider_id"  =>  "required",
            "provider_name"  =>  "required",
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors());
        }
        try {
            $get_user = User::where('email', $request->email)->where('provider_id', $request->provider_id)->first();

            if (!empty($get_user) && $get_user->active == 0) {
                return back()->with('error','Failed! Your account is no longer, Please contact admin');
            }

            if (!empty($get_user)) {
                $credentials = [
                    'email' => $request->email, 
                    'password' => $request->email
                ];

                if(Auth::attempt($credentials)){
                    session()->flash('success', 'login successfully');
                    return to_route('employ.profile');
                }else{
                    Log::debug("Login failed");
                    session()->flash('error', "login failed!");
                    return back();
                }
               }
            $newUser = new User;
            $newUser->first_name = $request->first_name;
            $newUser->last_name = $request->last_name;
            $newUser->email = $request->email;
            $newUser->active = 1;
            $newUser->provider_id = $request->provider_id;
            $newUser->provider = $request->provider_name;
            $newUser->password = $newUser->email;
            $newUser->save();
            $newUser->assignRole('USER');
            if (!is_null($newUser)) {
                $credentials = [
                    'email' => $newUser->email, 
                    'password' => $newUser->email
                ];

                if(Auth::attempt($credentials)){
                    Log::debug("Registration Success");

                    session()->flash('success', "login successfully");
                    return to_route('employ.expertise');
                }else{
                    Log::debug("Registration failed");

                    session()->flash('error', "login failed!");
                    return back();
                }
            } else {
                session()->flash('error','Registration failed!');
                return back();
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . $th->getFile() . ' line: ' . $th->getLine() . "\n" . $th->getTraceAsString());
            session()->flash('error', 'Server Error!');
            return back();
        }
    }

    return Inertia::render('frontend.login');
}





    public function dashboard()
    {
        return Inertia::render('Frontend/Dashboard');
    }

    public function profile()
    {
        return Inertia::render('Frontend/Profile');
    }

    

    public function logout()
    {
       Auth::logout();
       return redirect('/login');
    }

}
