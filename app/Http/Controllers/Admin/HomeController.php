<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if(auth()->user() && auth()->user()->role_name == 'SUPER-ADMIN'){
            return to_route('admin.dashboard');
        }

        if(request()->isMethod('post')){
            $credentials = request()->validate([
              'email' => ['required', 'email'],
              'password' => ['required'],
          ]);
  
          if (Auth::attempt($credentials) && Auth::user()->role_name == 'SUPER-ADMIN') {
              request()->session()->regenerate();
              return redirect()->intended('/admin/dashboard');
          }
  
          return back()->withErrors([
              'email' => 'The provided credentials do not match our records.',
          ])->onlyInput('email');
        }


        return Inertia::render('common/SuperAdminLogin');
    }

    

    public function dashboard()
    {
        $data['active_user'] = User::role('USER')->where('active',1)->with('roles')->count();
        $data['inactive_user'] = User::role('USER')->where('active',0)->count();
        $dataTotal = User::select(DB::raw('count(id) as count'), DB::raw("MONTH(created_at)  as month"))->role('USER')->groupBy('month')->orderBy('month')->get()->toArray();
        $models = collect($dataTotal);
        $data['months'] = collect(range(0, 11))->map(
          function ($month) use ($models) {
            $match = $models->firstWhere('month', $month);
            return $match ? $match['count'] : 0;
          }
        );
        
        return Inertia::render('Admin/Dashboard',compact('data'));
    }

    
    function adminProfile()
    {
        $user = auth()->user();
       

        if(request()->isMethod('post')){

            $credentials = request()->validate([
              'first_name' => 'required',
              'last_name' => 'required',
              'email' =>  'required|email:rfc,dns|unique:users,email,'.$user->id,
              // 'profile_photo' => 'required',
            ]);
    
            $user->first_name = request()->first_name;
            $user->last_name = request()->last_name;
            $user->email = request()->email;

            if(request()->file('profile_photo')){
                File::delete(storage_path('app/'.$user->profile_photo_path));
                $user->profile_photo_path = request()->file('profile_photo')->store('profile_photo');
              }
            $user->save();
    
            session()->flash('success', 'Profile successfully updated');
            // return redirect('admin/admin-profile');
          }

          $user->profile_photo = $user->profile_photo_path ? url()->route('image', ['path' => $user->profile_photo_path]) : null;

        return Inertia::render('Admin/AdminProfile',compact('user'));
    }


    public function adminChangePassword()
    {
      $credentials = request()->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
          ]);
          // dd(request()->all());
  

          $user = auth()->user();
           if (!Hash::check(request()->old_password, $user->password)) { 
             return to_route('admin.profile')->with('error', "The old Password doesn't match");
            }
              $user->password = request()->new_password;
              $user->save();
              Auth::logout();
              return to_route('admin.login')->with('success', "Password changed successfully");
  
    }


    public function logout()
    {
       Auth::logout();
       return to_route('admin.login');
    }
}
