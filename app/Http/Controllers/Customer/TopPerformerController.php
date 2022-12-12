<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessStat;
use DB;

class TopPerformerController extends Controller
{
    public function index()
    {
        $stats = BusinessStat::select([
                'user_id',
                DB::raw('SUM(net_profit) AS profit')
            ])->with('user');

        if(request('filter',0)==1)
            $stats = $stats->whereYear('month',date('Y'));
        elseif(request('filter',0)==2)
            $stats = $stats->whereYear('month',date('Y'))->whereMonth('month',date('m'));
            
        $stats = $stats->groupBy('user_id')
            ->orderBy('profit','desc')
            ->limit('20')
            ->get();

        return view('customer.top_performers.index',compact('stats'));
    }
}
