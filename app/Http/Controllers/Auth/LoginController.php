<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests\Customer\Auth\SetPasswordRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\UserToken;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function admin()
    {
        $role = 1;
        return view('admin.login', compact('role'));
    }

    public function adminlogin(Request $request)
    {
//        dd($request);
        $cred = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if ($request->role < 2) {
            if (Auth::attempt($cred)) {
                if (auth()->user()->role < 2) {
                    return redirect()->route('admin.dashboard');
                }
                else {
                    auth()->logout();
                    return redirect()->back();
                }
            }
        }
        else {
            return redirect()->route('adminLogin.index')
                ->withErrors("Credentials did not matched");
        }
        return redirect()->route('adminLogin.index')
            ->withErrors("Credentials did not matched");
    }

    public function customer()
    {
        $role = 2;
        return view('auth.login', compact('role'));
    }

    public function customerLogin(Request $request)

    {
        $cred = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if ($request->role == 2) {
            if (Auth::attempt($cred)) {
                if (auth()->user()->role == 2) {
                    return redirect()->route('home');
                }
                else {
                    auth()->logout();
                }
            }
        }
        else {
            return redirect()->route('customerLogin.index')
                ->with('error',"Credentials did not matched");
        }
        return redirect()->route('customerLogin.index')
            ->with('error',"Credentials did not matched");
    }

    public function passwordSet($token)
    {
        $userToken = UserToken::where('token',$token)->first();
        if(empty($userToken))
            abort(400,'Password Set Token Invalid!');
        else
            return view('customer.password_set',compact('token'));
    }

    public function passwordSetAttempt($token, SetPasswordRequest $request)
    {
        $userToken = UserToken::where('token',$token)->first();
        if(empty($userToken))
            abort(400,'Password Set Token Invalid!');  

        $user = $userToken->user;
        $userToken->delete();
        $user->update(['password'=>bcrypt($request->password)]);
        auth()->login($user);

        return redirect()->route('home')->with('success','Password set!');
    }

}
