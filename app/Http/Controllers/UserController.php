<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function profile(User $user)
    {
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::find($request->user_id);
        $user->update($request->except('user_id'));
        return redirect()->back();
    }
}
