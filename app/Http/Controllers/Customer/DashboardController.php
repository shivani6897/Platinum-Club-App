<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessStat;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stat = BusinessStat::where('user_id',auth()->id())
                ->first([
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

        $profitability['x'] = BusinessStat::select((DB::raw('avg(profitability) as profitability')),DB::raw("DATE_FORMAT(month, '%b-%Y') as month"),DB::raw('month as date'))->groupBy('month')->pluck('date')->all();
        $profitability['y'] = BusinessStat::select((DB::raw('avg(profitability) as profitability')),DB::raw("DATE_FORMAT(month, '%b-%Y') as month"))->groupBy('month')->pluck('profitability')->all();

        return view('customer.dashboard',compact('stat','profitability'));
    }
}
