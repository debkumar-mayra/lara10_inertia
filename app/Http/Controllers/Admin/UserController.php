<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Request;
use RealRashid\SweetAlert\Facades\Alert;


class UserController extends Controller
{
    public function userlist()
    {
      $users = User::filter(Request::only('name','email','phone','active'))->role('USER')->ordering(Request::only('fieldName','shortBy'))->latest()->paginate(request()->perPage ?? $this->per_page)->withQueryString()
       ->through(fn ($user) => [
        'id' => $user->id,
        'full_name' => $user->full_name,
        'email' => $user->email,
        'phone' => $user->phone,
        'active' => $user->active,
        // 'owner' => $user->owner,
        // 'photo' => $user->profile_photo_path ? Image::make(storage_path($user->profile_photo_path))->resize(50, 50)->response('jpg') : null,

        'profile_photo' => $user->profile_photo_path ? URL::route('image', ['path' => $user->profile_photo_path, 'w' => 40, 'h' => 40, 'fit' => 'crop']) : null,

        'deleted_at' => $user->deleted_at,
      ]);

      $filters = Request::all('name','email','phone','active');
       
      return Inertia::render('Admin/user/List', compact('filters','users'));
        
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
          'dob' => 'required',
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
          'dob' => 'required',
          'status' => 'required',
        ]);

        $user->first_name = request()->first_name;
        $user->last_name = request()->last_name;
        $user->email = request()->email;
        // $user->password = request()->password;
        $user->phone = request()->phone;
        $user->dob = date('Y-m-d', strtotime(request()->dob));
        $user->active = request()->status ?? 1;
        $user->profile_photo_path = Request::file('profile_photo') ? Request::file('profile_photo')->store('profile_photo') : $user->profile_photo_path;
        $user->save();

        session()->flash('success', 'User successfully updated');
        return redirect()->route('admin.users');
      }

       $user->profile_photo = $user->profile_photo_path ? URL::route('image', [
        'path' => $user->profile_photo_path ]) : null;
    

      return Inertia::render('Admin/user/CreateEdit',compact('user'));
    }

    public function deleteUser($id)
    {
      // dd($id);
      $user = User::find($id);
      $user->delete();
      session()->flash('success', 'User successfully deleted');
      return back();
    }

    public function changeUserStatus(Request $request)
    {
      $user = User::find($request->id);
      $user->active = ($user->active == 1) ? 0 : 1 ;
      $user->save();
      session()->flash('success', 'User status successfully changed');
      return back();
    }
}
