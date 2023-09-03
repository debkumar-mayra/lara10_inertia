<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Request;


class UserController extends Controller
{
    public function userlist()
    {
      //  $users = User::filter(Request::only('name','email','phone','active'))->role('USER')->ordering(Request::only('fieldName','shortBy'))->latest()->paginate(request()->perPage ?? $this->per_page)->withQueryString()
      //  ->through(fn ($user) => [
      //   'id' => $user->id,
      //   'full_name' => $user->full_name,
      //   'email' => $user->email,
      //   'phone' => $user->phone,
      //   'active' => $user->active,
      //   // 'owner' => $user->owner,
      //   // 'photo' => $user->photo_path ? URL::route('image', ['path' => $user->photo_path, 'w' => 40, 'h' => 40, 'fit' => 'crop']) : null,
      //   'deleted_at' => $user->deleted_at,
      // ]);

      // $filters = Request::all('name','email','phone','active');
       
      return Inertia::render('Admin/user/List', [
        'filters'=> Request::all('name','email','phone','active'),
        'users' => User::filter(Request::only('name','email','phone','active'))->role('USER')->ordering(Request::only('fieldName','shortBy'))->latest()->paginate(request()->perPage ?? $this->per_page)->withQueryString()
      ->through(fn ($user) => [
       'id' => $user->id,
       'full_name' => $user->full_name,
       'email' => $user->email,
       'phone' => $user->phone,
       'active' => $user->active,
       // 'owner' => $user->owner,
       // 'photo' => $user->photo_path ? URL::route('image', ['path' => $user->photo_path, 'w' => 40, 'h' => 40, 'fit' => 'crop']) : null,
       'deleted_at' => $user->deleted_at,
      ]),
     ]);
        
    }




    public function createUser(Request $request)
    {
      if($request->isMethod('post')){
      
        $credentials = $request->validate([
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
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->phone = $request->phone;
        $user->dob = date('Y-m-d', strtotime($request->dob));
        $user->active = $request->status ?? 1;

        if ($request->hasFile('profile_photo')) {
               $filename = time() . '-' . rand(1000, 9999) . '.' . $request->profile_photo->extension();
               $request->file('profile_photo')->storeAs('public/profile_photo/', $filename);
               $user->profile_photo_path = $filename;
           }
        $user->save();
        $user->assignRole('USER');
        session()->flash('success', 'User successfully created');
        return redirect()->route('admin.users');
      }

      return Inertia::render('Admin/user/CreateEdit');
    }



    public function editUser(Request $request, $id)
    {
      $user = User::find($id);
      if(request()->isMethod('post')){

        $credentials = $request->validate([
          'first_name' => 'required',
          'last_name' => 'required',
          'email' =>  'required|email|unique:users,email,'.$user->id,
          // 'password' => 'required|min:6',
          'phone' => 'required|unique:users,phone,'.$user->id,
          'dob' => 'required',
          // 'profile_photo' => 'required',
          'status' => 'required',
        ]);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        // $user->password = $request->password;
        $user->phone = $request->phone;
        $user->dob = date('Y-m-d', strtotime($request->dob));
        $user->active = $request->status ?? 1;

        if ($request->hasFile('profile_photo')) {
               $filename = time() . '-' . rand(1000, 9999) . '.' . $request->profile_photo->extension();
               $request->file('profile_photo')->storeAs('public/profile_photo/', $filename);
               $user->profile_photo_path = $filename;
           }
        $user->save();

        session()->flash('success', 'User successfully updated');
        return redirect()->route('admin.users');
      }
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
