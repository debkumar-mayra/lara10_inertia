<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function userlist(Request $request)
    {
        $credentials = $request->validate([
            'fieldName' => "in:first_name,email,phone",
            'shortBy' => "in:asc,desc",
        ]);

       $users = User::query();
       if($request->name){
            $users = $users->WhereRaw(
                "concat(first_name,' ', last_name) like '%" . trim($request->name) . "%' "
            );
       }

       if($request->email){
        $users = $users->where('email',$request->email);
      }

      if($request->phone){
        $users = $users->where('phone',$request->phone);
      }
      if($request->active){
        $users = $users->where('active',$request->active);
      }

       if($request->fieldName && $request->shortBy){
         $users->orderBy($request->fieldName,$request->shortBy);
       }

       $perPage = 5;
       if($request->perPage){
        $perPage = $request->perPage;
       }
        $users = $users->role('USER')->paginate($perPage)->withQueryString();
        return Inertia::render('Admin/user/List',['users'=>$users]);
    }
}
