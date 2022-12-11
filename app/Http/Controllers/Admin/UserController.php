<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use \App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\Club;
use App\Models\User;
use App\Models\UserToken;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = User::with('club')->when(request('search'),function($q){
            $q->where('first_name','LIKE', '%'.request('search').'%')
                ->orWhere('last_name','LIKE', '%'.request('search').'%')
                ->orWhere('city','LIKE', '%'.request('search').'%');
        })
            ->paginate(10);
        return view('admin/users/index', compact('user'));
    }

    public function create()
    {
        $clubs = Club::all(['id','name']);
        return view('admin.users.create',compact('clubs'));
    }

    public function store(StoreRequest $request)
    {
        $user = User::create($request->all());
        UserToken::create([
            'user_id' => $user->id,
            'token' => uniqid(base64_encode(Str::random(60))),
        ]);
        return redirect()->route('admin.users.index')->with('success','User Created successfully');
    }

    public function edit(User $user)
    {
        $clubs = Club::all(['id','name']);
        return view('admin.users.edit',compact('clubs','user'));
    }

    public function update(UpdateRequest $request,User $user, UserToken $userToken)
    {
        $user->update($request->validated());
        $userToken->update([
            'user_id' => $user->id,
            'token' => uniqid(base64_encode(Str::random(60))),
        ]);
        return redirect()->route('admin.users.index')->with('success','User Updated Successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success','User Deleted Successfully');
    }
}
