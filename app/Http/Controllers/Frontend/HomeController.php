<?php

namespace App\Http\Controllers\Frontend;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

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

        // return Inertia::render('Frontend/Home');
    
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
