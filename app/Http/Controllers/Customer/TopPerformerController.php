<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessStat;
use App\Models\Income;
use DB;

class TopPerformerController extends Controller
{
    public function index()
    {
        $stats = Income::select([
                'user_id',
                DB::raw('SUM(income) AS revenue')
            ])->with('user');

        if(request('search',0)==2)
            $stats = $stats->whereYear('date',date('Y'));
        elseif(request('search',0)==1)
            $stats = $stats->whereYear('date',date('Y'))->whereMonth('date',date('m'));
            
        $stats = $stats->groupBy('user_id')
            ->orderBy('revenue','desc')
            ->limit('20')
            ->get();

        return view('customer.top_performers.index',compact('stats'));
    }
}
