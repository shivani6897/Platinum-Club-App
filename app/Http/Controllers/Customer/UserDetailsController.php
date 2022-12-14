<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\JobPosition;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use File;

class UserDetailsController extends Controller
{
    public function generalInfo(Request $request)
    {
        $businesses = Business::all(['id','name']);
        $userdetails = UserDetail::where('user_id', auth()->id())->first();
        return view('user.profile.general_info', compact('userdetails','businesses'));
    }
    public function postGeneralInfo(Request $request){
        $userdetails = UserDetail::where('user_id', auth()->id())->first();

        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_no' => 'required|numeric',
            'business_name' => 'nullable',
            'email' => 'nullable|unique:users,email,'.auth()->id().',id,deleted_at,NULL',
            'business_id' => 'nullable',
            'business_gst_no' => 'nullable',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'business_website' => ['nullable','regex:/\b[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
        ]);

        $array = $request->only(['first_name','last_name','email','phone_no']);
        $file = auth()->user()->profile;
            if(!empty($request->profile))
            {
                $file = $userdetails->id.time().'.'.$request->profile->extension();
                File::delete(public_path('/images/users/'.$userdetails->profile));
                $request->profile->move(public_path('/images/users'), $file);
            }
            $array['profile'] = $file;

        auth()->user()->update($array);
        $userdetails = UserDetail::updateOrCreate(['user_id'=> auth()->id()], $request->only(['business_name','business_id','business_website','business_gst_no']));

        return redirect()->route('user.businessProfile');
    }

    public function businessAdd(Request $request)
    {
        $userdetails = UserDetail::where('user_id', auth()->id())->first();
        return view('user.profile.business_physical_add', compact('userdetails'));
    }

    public function  postBusinessAdd(Request $request){
        $userdetails = UserDetail::where('user_id', auth()->id())->first();

        $validatedData = $request->validate([
            'business_address' => 'nullable',
            'business_city' => 'nullable',
            'business_pincode' => 'nullable|numeric',
            'business_state' => 'nullable',
            'business_country' => 'nullable',
            'business_timezone' => 'nullable',

        ]);

       $userdetails = UserDetail::updateOrCreate(['user_id'=> auth()->id()], $validatedData);
        return redirect()->route('user.authorizedContact');
    }

    public function authorizeContact(Request $request)
    {
        $jobpositions = JobPosition::all(['id','name']);
        $userdetails = UserDetail::where('user_id', auth()->id())->first();
        return view('user.profile.authorized_contact', compact('userdetails', 'jobpositions'));
    }

    public function  postAuthorizeContact(Request $request){
        $validatedData = $request->validate([
            'auth_name' => 'nullable',
            'auth_phone_no' => 'nullable',
            // 'auth_email' => 'nullable|unique:user_details,email,'.auth()->id().',id,deleted_at,NULL',
           'auth_email' => 'nullable',
            'job_position_id' => 'nullable',
       ]);
        $userdetails = UserDetail::updateOrCreate(['user_id'=> auth()->id()], $validatedData);

        return redirect()->route('user.profile')->with('success', 'User updated successfully');
    }
}
