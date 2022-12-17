<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessStat;
use App\Models\Income;
use App\Models\Expense;
use App\Models\Lead;
use App\Models\IncomeCategory;
use App\Models\ExpenseCategory;
use App\Models\Customer;
use DB;

class DashboardController extends Controller
{
    public function index()
    {

        // Numbers In Boxes
        $revenue = Income::where('user_id',auth()->id())
            ->when(request('filter_from'),function($q) {
                $q->whereDate('date','>=',request('filter_from'));
            })
            ->when(request('filter_to'),function($q) {
                $q->whereDate('date','<=',request('filter_to'));
            })->sum('income');
        $ad_spends = Expense::where('user_id',auth()->id())
            ->when(request('filter_from'),function($q) {
                $q->whereDate('date','>=',request('filter_from'));
            })
            ->when(request('filter_to'),function($q) {
                $q->whereDate('date','<=',request('filter_to'));
            })->where('expense_category_id',1)->sum('expense');
        $overheads = Expense::where('user_id',auth()->id())
            ->when(request('filter_from'),function($q) {
                $q->whereDate('date','>=',request('filter_from'));
            })
            ->when(request('filter_to'),function($q) {
                $q->whereDate('date','<=',request('filter_to'));
            })->whereNot('expense_category_id',1)->sum('expense');
        $net_profit = $revenue-$ad_spends-$overheads;
        $leads = Lead::where('user_id',auth()->id())
            ->when(request('filter_from'),function($q) {
                $q->whereDate('date','>=',request('filter_from'));
            })
            ->when(request('filter_to'),function($q) {
                $q->whereDate('date','<=',request('filter_to'));
            })->sum('lead_generated');
        $cost_per_lead = $ad_spends/($leads>0?$leads:1);
        $converted_customers = Lead::where('user_id',auth()->id())
            ->when(request('filter_from'),function($q) {
                $q->whereDate('date','>=',request('filter_from'));
            })
            ->when(request('filter_to'),function($q) {
                $q->whereDate('date','<=',request('filter_to'));
            })->sum('converted_customer');
        $customers = Customer::count();
        $profitability = $net_profit*100/($revenue>0?$revenue:1);

        // Profit% and Net Profit Graph
        $stat = DB::select("SELECT `date`,
                    `eid`,
                    `expense`,
                    `iid`,
                    `income`
            FROM (  (
                  SELECT
                    IFNULL(incomes.date, expenses.date) AS date,
                    expenses.id AS eid,
                    `expenses`.`expense`,
                    incomes.id AS iid,
                    `incomes`.`income`
                  FROM
                    `incomes`
                    LEFT JOIN `expenses` ON `incomes`.`date` = `expenses`.`date`
                    WHERE `incomes`.`deleted_at` IS NULL
                    AND `expenses`.`deleted_at` IS NULL
                    ".(request('filter_from')?
                        "AND DATE(`incomes`.`date`)>='".request('filter_from')."'
                        AND DATE(`expenses`.`date`)>='".request('filter_from')."'":'').
                        (request('filter_to')?
                        "AND DATE(`incomes`.`date`)<='".request('filter_to')."'
                        AND DATE(`expenses`.`date`)<='".request('filter_to')."'":'')."
                )
                UNION ALL
                (
                  SELECT
                    IFNULL(incomes.date, expenses.date) AS date,
                    expenses.id AS eid,
                    `expenses`.`expense`,
                    incomes.id AS iid,
                    `incomes`.`income`
                  FROM
                    `incomes`
                    RIGHT JOIN `expenses` ON `incomes`.`date` = `expenses`.`date`
                    WHERE `incomes`.`deleted_at` IS NULL
                    AND `expenses`.`deleted_at` IS NULL
                    ".(request('filter_from')?
                        "AND DATE(`incomes`.`date`)>='".request('filter_from')."'
                        AND DATE(`expenses`.`date`)>='".request('filter_from')."'":'').
                        (request('filter_to')?
                        "AND DATE(`incomes`.`date`)<='".request('filter_to')."'
                        AND DATE(`expenses`.`date`)<='".request('filter_to')."'":'')."
                )
            ) AS dt
            GROUP BY `date`,`eid`,`expense`,`iid`,`income`
            ORDER BY `date`");

        $dateArray = [];
        $profitArray = [];
        $netProfitArray = [];
        foreach($stat as $st)
        {
            $dateArray[] = $st->date;
            $profitArray[] = ($st->income-$st->expense)*100/($st->income>0?$st->income:1);
            $netProfitArray[] = $st->income-$st->expense;
        }


        // Revenue
        $revenueArray['x'] = Income::where('user_id',auth()->id())->select((DB::raw('sum(income) as revenue')),DB::raw("DATE_FORMAT(date, '%b-%Y') as date"))->groupBy('date')->pluck('date')->all();
        $revenueArray['y'] = Income::where('user_id',auth()->id())->select((DB::raw('sum(income) as revenue')),DB::raw("DATE_FORMAT(date, '%b-%Y') as date"))->groupBy('date')->pluck('revenue')->all();

        // Ad Spends
        $ad_spendsArray['x'] = Expense::where('user_id',auth()->id())->where('expense_category_id',1)->select((DB::raw('sum(expense) as expense')),DB::raw("DATE_FORMAT(date, '%b-%Y') as date"))->groupBy('date')->pluck('date')->all();
        $ad_spendsArray['y'] = Expense::where('user_id',auth()->id())->where('expense_category_id',1)->select((DB::raw('sum(expense) as expense')),DB::raw("DATE_FORMAT(date, '%b-%Y') as date"))->groupBy('date')->pluck('expense')->all();

        // Ad Spends
        $overheadsArray['x'] = Expense::where('user_id',auth()->id())->whereNot('expense_category_id',1)->select((DB::raw('sum(expense) as expense')),DB::raw("DATE_FORMAT(date, '%b-%Y') as date"))->groupBy('date')->pluck('date')->all();
        $overheadsArray['y'] = Expense::where('user_id',auth()->id())->whereNot('expense_category_id',1)->select((DB::raw('sum(expense) as expense')),DB::raw("DATE_FORMAT(date, '%b-%Y') as date"))->groupBy('date')->pluck('expense')->all();

        return view('customer.dashboard',compact('revenue','ad_spends','overheads','net_profit','leads','cost_per_lead','converted_customers','customers','profitability','dateArray','profitArray','netProfitArray','revenueArray','ad_spendsArray','overheadsArray'));
        // $stat = BusinessStat::where('user_id',auth()->id());
        // if(request('duration',0)==1)
        //     $stat = $stat->whereYear('month',date('Y', strtotime('-1 year')));
        // elseif(request('duration',0)==2)
        //     $stat = $stat->whereYear('month',date('Y', strtotime('-1 month')))->whereMonth('month',date('m', strtotime('-1 month')));

        // $stat = $stat->first([
        //             DB::raw('SUM(revenue_earned) AS revenue_earned'),
        //             DB::raw('SUM(ad_spends) AS ad_spends'),
        //             DB::raw('SUM(net_profit) AS net_profit'),
        //             DB::raw('SUM(overheads) AS overheads'),
        //             DB::raw('AVG(profitability) AS profitability'),
        //             DB::raw('AVG(avg_cost_per_lead) AS cost_per_lead'),
        //             DB::raw('SUM(leads_generated) AS leads_generated'),
        //             DB::raw('SUM(paid_customer) AS paid_customer'),
        //             DB::raw('SUM(group_size) AS total_customer'),
        //         ]);

        // $profitability['x'] = BusinessStat::select((DB::raw('avg(profitability) as profitability')),DB::raw("DATE_FORMAT(month, '%b-%Y') as month"),DB::raw('month as date'))->where('user_id',auth()->id());
        // if(request('duration',0)==1)
        //     $profitability['x'] = $profitability['x']->whereYear('month',date('Y', strtotime('-1 year')));
        // elseif(request('duration',0)==2)
        //     $profitability['x'] = $profitability['x']->whereYear('month',date('Y', strtotime('-1 month')))->whereMonth('month',date('m', strtotime('-1 month')));
        // $profitability['x'] = $profitability['x']->groupBy('month')
        //     ->pluck('date')
        //     ->all();

        // $profitability['y'] = BusinessStat::select((DB::raw('avg(profitability) as profitability')),DB::raw("DATE_FORMAT(month, '%b-%Y') as month"))->where('user_id',auth()->id());
        // if(request('duration',0)==1)
        //     $profitability['y'] = $profitability['y']->whereYear('month',date('Y', strtotime('-1 year')));
        // elseif(request('duration',0)==2)
        //     $profitability['y'] = $profitability['y']->whereYear('month',date('Y', strtotime('-1 month')))->whereMonth('month',date('m', strtotime('-1 month')));
        // $profitability['y'] = $profitability['y']->groupBy('month')
        //     ->pluck('profitability')
        //     ->all();

        // return view('customer.dashboard',compact('stat','profitability'));
    }
}
