<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\BusinessStat;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class BusinessStatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $business_stats = BusinessStat::where('user_id', Auth::id())->paginate(10);
        return view('customer.business.index',compact('business_stats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.business.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $input['month'] = Carbon::createFromFormat('M-Y', $input['month'])->firstOfMonth();
        BusinessStat::create($input);
        return redirect('business')->with('success','Business Stat Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BusinessStat  $businessStat
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessStat $businessStat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BusinessStat  $businessStat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $businessStat = BusinessStat::findOrFail($id);
        return view('customer.business.create', compact('businessStat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BusinessStat  $businessStat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $businessStat = BusinessStat::findOrFail($id);
        $input = $request->all();
        $input['month'] = Carbon::createFromFormat('F Y', $input['month'])->firstOfMonth();
        $businessStat->update($input);
        return redirect('business')->with('success','Business Stat Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BusinessStat  $businessStat
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessStat $businessStat)
    {
        //
    }

    public function businessStats()
    {
        return view('customer.business.business_stats');
    }
}
