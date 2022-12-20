<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use File;

class UserController extends Controller
{
    public function profile(User $user)
    {
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::find($request->user_id);
        $file = $user->profile;
        if(!empty($request->profile))
        {
            $file = $user->id.time().'.'.$request->profile->extension();
            File::delete(public_path('/images/users/'.$user->profile));
            $request->profile->move(public_path('/images/users'), $file);
        }
        
        $array = $request->except('user_id');
        $array['profile'] = $file;
        $user->update($array);
        return redirect()->back();
    }
}
