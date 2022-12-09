<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if ($request->role == 1) {
            if (Auth::attempt($cred)) {
                if (\auth()->user()->role == 1) {
                    return redirect()->route('admin.dashboard');
                }
                else {
                    \auth()->logout();
                }
            }
        }
        else {
            return redirect()->route('adminLogin.index')
                ->withErrors("Combination Of Email And Password Do Not Match");
        }
        return redirect()->route('adminLogin.index')
            ->with(\auth()->user()->role == 1)
            ->withErrors("Combination Of Email And Password Do Not Match");
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
                if (\auth()->user()->role == 2) {
                    return redirect()->route('home');
                }
                else {
                    \auth()->logout();
                }
            }
        }
        else {
            return redirect()->route('customerLogin.index')
                ->withErrors("Combination Of Email And Password Do Not Match");
        }
        return redirect()->route('customerLogin.index')
            ->with(\auth()->user()->role == 2)
            ->withErrors("Combination Of Email And Password Do Not Match");
    }

}
