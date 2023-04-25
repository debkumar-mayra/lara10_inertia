<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if(auth()->user() && auth()->user()->role_name == 'SUPER-ADMIN'){
            return to_route('admin.dashboard');
        }
        return Inertia::render('common/SuperAdminLogin');
    }

    public function authenticate(Request $request): RedirectResponse
    {
    //    sleep(10);
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
        $data['active_user'] = User::where('active',1)->count();
        $data['inactive_user'] = User::where('active',0)->count();
        return Inertia::render('Admin/Dashboard',compact('data'));
    }

    
    function adminProfile(Request $request)
    {
        $user = auth()->user();

        if(request()->isMethod('post')){

            $credentials = $request->validate([
              'first_name' => 'required',
              'last_name' => 'required',
              'email' =>  'required|email|unique:users,email,'.$user->id,
              // 'profile_photo' => 'required',
            ]);
    
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;

            if ($request->hasFile('profile_photo')) {
                   $filename = time() . '-' . rand(1000, 9999) . '.' . $request->profile_photo->extension();
                   $request->file('profile_photo')->storeAs('public/profile_photo/', $filename);
                   $user->profile_photo_path = $filename;
               }
            $user->save();
    
            session()->flash('success', 'Profile successfully updated');
            return redirect('admin/admin-profile');
          }

        return Inertia::render('Admin/AdminProfile',compact('user'));
    }


    public function adminChangePassword(Request $request)
    {
         $credentials = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'new_password_confirm' => 'required|same:new_password',
          ]);
  

          $user = auth()->user();
           if (Hash::check($request->new_password, $user->password)) {          
              $user->password = $request->new_password;
              $user->save();
              session()->flash('success', 'Password changed');
            }else{
                session()->flash('success', "The old Password doesn't match");
            }
  
          return redirect('admin/admin-profile');
    }


    public function logout()
    {
       Auth::logout();
       return redirect('/admin/login');
    }
}
