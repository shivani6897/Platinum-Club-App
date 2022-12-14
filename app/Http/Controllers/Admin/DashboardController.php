<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessStat;
use App\Models\User;
use App\Models\Club;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all(['id','first_name','last_name']);
        $clubs = Club::all(['id','name']);
        $userIds = User::where('club_id',request('club'))->get(['id'])->pluck('id')->toArray();

        $stat = BusinessStat::query();
        if(request('duration',0)==1)
            $stat = $stat->whereYear('month',date('Y', strtotime('-1 year')));
        elseif(request('duration',0)==2)
            $stat = $stat->whereYear('month',date('Y', strtotime('-1 month')))->whereMonth('month',date('m', strtotime('-1 month')));
        if(request('user',0)!=0)
            $stat = $stat->where('user_id',request('user'));
        if(request('club',0)!=0)
            $stat = $stat->whereIn('user_id',$userIds);


        $stat = $stat->first([
                    DB::raw('SUM(revenue_earned) AS revenue_earned'),
                    DB::raw('SUM(ad_spends) AS ad_spends'),
                    DB::raw('SUM(net_profit) AS net_profit'),
                    DB::raw('SUM(overheads) AS overheads'),
                    DB::raw('AVG(profitability) AS profitability'),
                    DB::raw('AVG(avg_cost_per_lead) AS cost_per_lead'),
                    DB::raw('SUM(leads_generated) AS leads_generated'),
                    DB::raw('SUM(paid_customer) AS paid_customer'),
                    DB::raw('SUM(group_size) AS total_customer'),
                ]);

        $profitability['x'] = BusinessStat::select((DB::raw('avg(profitability) as profitability')),DB::raw("DATE_FORMAT(month, '%b-%Y') as month"),DB::raw('month as date'));
        if(request('duration',0)==1)
            $profitability['x'] = $profitability['x']->whereYear('month',date('Y', strtotime('-1 year')));
        elseif(request('duration',0)==2)
            $profitability['x'] = $profitability['x']->whereYear('month',date('Y', strtotime('-1 month')))->whereMonth('month',date('m', strtotime('-1 month')));
        if(request('user',0)!=0)
            $profitability['x'] = $profitability['x']->where('user_id',request('user'));
        if(request('club',0)!=0)
            $profitability['x'] = $profitability['x']->whereIn('user_id',$userIds);
        $profitability['x'] = $profitability['x']->groupBy('month')
            ->pluck('date')
            ->all();

        $profitability['y'] = BusinessStat::select((DB::raw('avg(profitability) as profitability')),DB::raw("DATE_FORMAT(month, '%b-%Y') as month"));
        if(request('duration',0)==1)
            $profitability['y'] = $profitability['y']->whereYear('month',date('Y', strtotime('-1 year')));
        elseif(request('duration',0)==2)
            $profitability['y'] = $profitability['y']->whereYear('month',date('Y', strtotime('-1 month')))->whereMonth('month',date('m', strtotime('-1 month')));
        if(request('user',0)!=0)
            $profitability['y'] = $profitability['y']->where('user_id',request('user'));
        if(request('club',0)!=0)
            $profitability['y'] = $profitability['y']->whereIn('user_id',$userIds);
        $profitability['y'] = $profitability['y']->groupBy('month')
            ->pluck('profitability')
            ->all();

        return view('admin.dashboard',compact('stat','profitability','users','clubs'));
    }
}