<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\BusinessStat;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use DB;
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
        $input['month'] = Carbon::createFromFormat('F Y', $input['month'])->firstOfMonth();
        $input['net_profit'] = $input['revenue_earned'] - $input['ad_spends'] - $input['overheads'];
        $input['profitability'] = $input['net_profit']*100/$input['revenue_earned'];
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
        $input['net_profit'] = $input['revenue_earned'] - $input['ad_spends'] - $input['overheads'];
        $input['profitability'] = $input['net_profit']*100/$input['revenue_earned'];
        $businessStat->update($input);
        return redirect('business')->with('success','Business Stat Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BusinessStat  $businessStat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $businessStat = BusinessStat::find($id);
        $businessStat->delete();
        return redirect('business')->with('success','Business Stat Deleted');
    }

    public function businessStats()
    {
        $revenue_earned['x'] = BusinessStat::select((DB::raw('sum(revenue_earned) as revenue_earned')),DB::raw("DATE_FORMAT(month, '%b-%Y') as month"))->groupBy('month')->pluck('month')->all();
        $revenue_earned['y'] = BusinessStat::select((DB::raw('sum(revenue_earned) as revenue_earned')),DB::raw("DATE_FORMAT(month, '%b-%Y') as month"))->groupBy('month')->pluck('revenue_earned')->all();

        $ad_spends['x'] = BusinessStat::select((DB::raw('sum(ad_spends) as ad_spends')),DB::raw("DATE_FORMAT(month, '%b-%Y') as month"))->groupBy('month')->pluck('month')->all();
        $ad_spends['y'] = BusinessStat::select((DB::raw('sum(ad_spends) as ad_spends')),DB::raw("DATE_FORMAT(month, '%b-%Y') as month"))->groupBy('month')->pluck('ad_spends')->all();

        $net_profit['x'] = BusinessStat::select((DB::raw('sum(net_profit) as net_profit')),DB::raw("DATE_FORMAT(month, '%b-%Y') as month"))->groupBy('month')->pluck('month')->all();
        $net_profit['y'] = BusinessStat::select((DB::raw('sum(net_profit) as net_profit')),DB::raw("DATE_FORMAT(month, '%b-%Y') as month"))->groupBy('month')->pluck('net_profit')->all();

        $overheads['x'] = BusinessStat::select((DB::raw('sum(overheads) as overheads')),DB::raw("DATE_FORMAT(month, '%b-%Y') as month"))->groupBy('month')->pluck('month')->all();
        $overheads['y'] = BusinessStat::select((DB::raw('sum(overheads) as overheads')),DB::raw("DATE_FORMAT(month, '%b-%Y') as month"))->groupBy('month')->pluck('overheads')->all();

        return view('customer.business.business_stats', compact('revenue_earned','ad_spends','net_profit','overheads'));
    }
}
