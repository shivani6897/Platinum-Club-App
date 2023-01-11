<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Club;
use App\Models\State;
use App\Models\Otp;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            // 'city' => ['required', 'string', 'max:255'],
            'phone_no' => ['required', 'string', 'unique:users,phone_no'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'club_id' => ['required', 'numeric', 'exists:clubs,id'],
            'state_id' => ['required','numeric','exists:states,id'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone_no' => $data['phone_no'],
            'city' => $data['city'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }



    // User registration with otp verification
    public function verifyAndRegister(Request $request)
    {
        $phone_no = $request->phone_no;
        $otp = Otp::updateOrCreate(['phone_no'=>$phone_no],['otp'=>rand(100000,999999)]);

        session()->put(['regData'=>$request->all()]);
        return view('auth.otp_verify',compact('otp'));
    }

    public function verifyAndStore(Request $request)
    {
        return redirect()->back()->with('error','Data error');
    }

    public function userRegister()
    {
        $clubs = Club::all(['id','name']);
        $states = State::all(['id','name']);
        return view("auth.register", compact('clubs','states'));
    }

}
