<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Request;
use RealRashid\SweetAlert\Facades\Alert;


class UserController extends Controller
{
    public function userlist()
    {
      try {
      $users = User::filter(Request::only('name','email','phone','active'))->role('USER')->ordering(Request::only('fieldName','shortBy'))->orderBy('id','desc')->paginate(request()->perPage ?? $this->per_page)->withQueryString()
       ->through(fn ($user) => [
        'id' => $user->id,
        'full_name' => $user->full_name,
        'email' => $user->email,
        'phone' => $user->phone,
        'active' => $user->active,
        'profile_photo' => $user->profile_photo_path ? URL::route('image', ['path' => $user->profile_photo_path, 'w' => 40, 'h' => 40, 'fit' => 'crop']) : null,
        'deleted_at' => $user->deleted_at,
      ]);

      $filters = Request::all('name','email','phone','active');
       
      return Inertia::render('Admin/user/List', compact('filters','users'));

    } catch (\Exception $e) {
      Log::error(" :: EXCEPTION :: " . $e->getMessage() . "\n" . $e->getTraceAsString());
      return back()->with('error','Server error');
   }
        
    }




    public function createUser()
    {
      if(request()->isMethod('post')){
      
       request()->validate([
          'first_name' => 'required',
          'last_name' => 'required',
          'email' => 'required|email|unique:users,email',
          'password' => 'required|min:6',
          'phone' => 'required',
          'dob' => 'required|before:before:5 years ago',
          'profile_photo' => 'required',
          'status' => 'required',
        ]);

       
        $user = new User;
        $user->first_name = request()->first_name;
        $user->last_name = request()->last_name;
        $user->email = request()->email;
        $user->password = request()->password;
        $user->phone = request()->phone;
        $user->dob = date('Y-m-d', strtotime(request()->dob));
        $user->active = request()->status ?? 1;
        $user->profile_photo_path = Request::file('profile_photo') ? Request::file('profile_photo')->store('profile_photo') : null;
        $user->save();
        $user->assignRole('USER');
        session()->flash('success', 'User successfully created');
        return redirect()->route('admin.users');
      }

      return Inertia::render('Admin/user/CreateEdit');

   

    }



    public function editUser(User $user)
    {
    
      if(request()->isMethod('post')){

        $credentials = request()->validate([
          'first_name' => 'required',
          'last_name' => 'required',
          'email' =>  'required|email|unique:users,email,'.$user->id,
          'phone' => 'required|unique:users,phone,'.$user->id,
          'dob' => 'required|before:before:5 years ago',
          'status' => 'required',
        ]);

        $user->first_name = request()->first_name;
        $user->last_name = request()->last_name;
        $user->email = request()->email;
        // $user->password = request()->password;
        $user->phone = request()->phone;
        $user->dob = date('Y-m-d', strtotime(request()->dob));
        $user->active = request()->status ?? 1;
        if(Request::file('profile_photo')){
          File::delete(storage_path('app/'.$user->profile_photo_path));
          $user->profile_photo_path = Request::file('profile_photo')->store('profile_photo');
        }
        $user->save();

        session()->flash('success', 'User successfully updated');
        return redirect()->route('admin.users');
      }

       $user->profile_photo = $user->profile_photo_path ? URL::route('image', [
        'path' => $user->profile_photo_path ]) : null;
    

      return Inertia::render('Admin/user/CreateEdit',compact('user'));
    }

    public function deleteUser(User $user)
    {
      try{
      File::delete(storage_path('app/'.$user->profile_photo_path));
      $user->delete();
      session()->flash('success', 'User successfully deleted');
      return back();
      } catch (\Exception $e) {
        Log::error(" :: EXCEPTION :: " . $e->getMessage() . "\n" . $e->getTraceAsString());
        return back()->with('error','Server error');
    }
    }

    public function changeUserStatus(User $user)
    {
      try{
      $user->active = ($user->active == 1) ? 0 : 1 ;
      $user->save();
      session()->flash('success', 'User status successfully changed');
      return back();
    } catch (\Exception $e) {
      Log::error(" :: EXCEPTION :: " . $e->getMessage() . "\n" . $e->getTraceAsString());
      return back()->with('error','Server error');
  }


    }
}
