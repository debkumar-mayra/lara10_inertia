<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('common/SuperAdminLogin');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials) && Auth::user()->role_name == 'SUPER-ADMIN') {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


    public function dashboard(Request $request)
    {
        return Inertia::render('Admin/Dashboard');
    }


    public function logout()
    {
       Auth::logout();
       return redirect('/admin/login');
    }
}
