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
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {

        // Numbers In Boxes
        $revenue = Income::where('user_id',auth()->id())
            ->when(request('filter_from'),function($q) {
                $q->whereDate('date','>=',request('filter_from'));
            }, function($q) {
                $q->whereDate('date','>=',Carbon::now()->subDays(30)->format('Y-m-d'));
            })
            ->when(request('filter_to'),function($q) {
                $q->whereDate('date','<=',request('filter_to'));
            }, function ($q) {
                $q->whereDate('date','>=',Carbon::now()->format('Y-m-d'));
            })->sum('income');
        $ad_spends = Expense::where('user_id',auth()->id())
            ->when(request('filter_from'),function($q) {
                $q->whereDate('date','>=',request('filter_from'));
            }, function($q) {
                $q->whereDate('date','>=',Carbon::now()->subDays(30)->format('Y-m-d'));
            })
            ->when(request('filter_to'),function($q) {
                $q->whereDate('date','<=',request('filter_to'));
            }, function ($q) {
                $q->whereDate('date','>=',Carbon::now()->format('Y-m-d'));
            })->where('expense_category_id',1)->sum('expense');
        $overheads = Expense::where('user_id',auth()->id())
            ->when(request('filter_from'),function($q) {
                $q->whereDate('date','>=',request('filter_from'));
            }, function($q) {
                $q->whereDate('date','>=',Carbon::now()->subDays(30)->format('Y-m-d'));
            })
            ->when(request('filter_to'),function($q) {
                $q->whereDate('date','<=',request('filter_to'));
            }, function ($q) {
                $q->whereDate('date','>=',Carbon::now()->format('Y-m-d'));
            })->whereNot('expense_category_id',1)->sum('expense');
        $net_profit = $revenue-$ad_spends-$overheads;
        $leads = Lead::where('user_id',auth()->id())
            ->when(request('filter_from'),function($q) {
                $q->whereDate('date','>=',request('filter_from'));
            }, function($q) {
                $q->whereDate('date','>=',Carbon::now()->subDays(30)->format('Y-m-d'));
            })
            ->when(request('filter_to'),function($q) {
                $q->whereDate('date','<=',request('filter_to'));
            }, function ($q) {
                $q->whereDate('date','>=',Carbon::now()->format('Y-m-d'));
            })->sum('lead_generated');
        $cost_per_lead = $ad_spends/($leads>0?$leads:1);
        $converted_customers = Lead::where('user_id',auth()->id())
            ->when(request('filter_from'),function($q) {
                $q->whereDate('date','>=',request('filter_from'));
            }, function($q) {
                $q->whereDate('date','>=',Carbon::now()->subDays(30)->format('Y-m-d'));
            })
            ->when(request('filter_to'),function($q) {
                $q->whereDate('date','<=',request('filter_to'));
            }, function ($q) {
                $q->whereDate('date','>=',Carbon::now()->format('Y-m-d'));
            })->sum('converted_customer');
        $customers = Customer::where('user_id',auth()->id())->count();
        $profitability = ($revenue>0?$net_profit*100/$revenue:-100);

        // Profit% and Net Profit Graph
        // $stat = DB::select("SELECT DATE_FORMAT(`date`, '%b-%Y') as month,
        //             sum(`expense`) as expense,
        //             sum(`income`) as income
        $stat = DB::select("SELECT `date`,
                    MAX(`expense`) AS 'expense',
                    SUM(`income`) AS 'income'
            FROM (  (
                  SELECT
                    IFNULL(incomes.date, expenses.date) AS date,
                    SUM(`expenses`.`expense`) as 'expense',
                    incomes.id AS iid,
                    `incomes`.`income`
                  FROM
                    `incomes`
                    LEFT JOIN `expenses` ON `incomes`.`date` = `expenses`.`date` AND `incomes`.`user_id`=".auth()->id()." AND `expenses`.`user_id`=".auth()->id()."
                    WHERE `incomes`.`deleted_at` IS NULL
                    AND `expenses`.`deleted_at` IS NULL
                    ".(request('filter_from')?
                        "AND DATE(`incomes`.`date`)>='".request('filter_from')."'":
                        "AND DATE(`incomes`.`date`)>='".Carbon::now()->subDays(30)->format('Y-m-d')."'").
                        (request('filter_to')?
                        "AND DATE(`incomes`.`date`)<='".request('filter_to')."'":
                        "AND DATE(`incomes`.`date`)<='".Carbon::now()->format('Y-m-d')."'")."
                    GROUP BY `date`,`iid`
                )
                UNION ALL
                (
                  SELECT
                    IFNULL(incomes.date, expenses.date) AS date,
                    SUM(`expenses`.`expense`) as 'expense',
                    incomes.id AS iid,
                    `incomes`.`income`
                  FROM
                    `incomes`
                    RIGHT JOIN `expenses` ON `incomes`.`date` = `expenses`.`date` AND `incomes`.`user_id`=".auth()->id()." AND `expenses`.`user_id`=".auth()->id()."
                    WHERE `incomes`.`deleted_at` IS NULL
                    AND `expenses`.`deleted_at` IS NULL
                    ".(request('filter_from')?
                        "AND DATE(`expenses`.`date`)>='".request('filter_from')."'":
                        "AND DATE(`expenses`.`date`)>='".Carbon::now()->subDays(30)->format('Y-m-d')."'").
                        (request('filter_to')?
                        "AND DATE(`expenses`.`date`)<='".request('filter_to')."'":
                        "AND DATE(`expenses`.`date`)<='".Carbon::now()->format('Y-m-d')."'")."
                    GROUP BY `date`,`iid`
                )
            ) AS dt 
            GROUP BY `date`
            ORDER BY `date`");
            //GROUP BY `month`
            //ORDER BY `month`");

        $dateArray = [];
        $profitArray = [];
        $netProfitArray = [];
        foreach($stat as $st)
        {
            // $dateArray[] = $st->month;
            $dateArray[] = $st->date;
            $profitArray[] = ($st->income>0?($st->income-$st->expense)*100/$st->income:-100);
            $netProfitArray[] = $st->income-$st->expense;
        }


        // Revenue
        $revenueArray['x'] = Income::where('user_id',auth()->id())
            ->when(request('filter_from'),function($q) {
                $q->whereDate('date','>=',request('filter_from'));
            }, function($q) {
                $q->whereDate('date','>=',Carbon::now()->subDays(30)->format('Y-m-d'));
            })
            ->when(request('filter_to'),function($q) {
                $q->whereDate('date','<=',request('filter_to'));
            }, function ($q) {
                $q->whereDate('date','>=',Carbon::now()->format('Y-m-d'));
            })->select((DB::raw('sum(income) as revenue')),DB::raw("DATE_FORMAT(date, '%b-%Y') as month"),'date')->groupBy('date')->orderBy('date')->pluck('date')->all();
        $revenueArray['y'] = Income::where('user_id',auth()->id())
            ->when(request('filter_from'),function($q) {
                $q->whereDate('date','>=',request('filter_from'));
            }, function($q) {
                $q->whereDate('date','>=',Carbon::now()->subDays(30)->format('Y-m-d'));
            })
            ->when(request('filter_to'),function($q) {
                $q->whereDate('date','<=',request('filter_to'));
            }, function ($q) {
                $q->whereDate('date','>=',Carbon::now()->format('Y-m-d'));
            })->select((DB::raw('sum(income) as revenue')),DB::raw("DATE_FORMAT(date, '%b-%Y') as month"),'date')->groupBy('date')->orderBy('date')->pluck('revenue')->all();

        // dd($revenueArray);

        // Ad Spends
        $ad_spendsArray['x'] = Expense::where('user_id',auth()->id())
            ->when(request('filter_from'),function($q) {
                $q->whereDate('date','>=',request('filter_from'));
            }, function($q) {
                $q->whereDate('date','>=',Carbon::now()->subDays(30)->format('Y-m-d'));
            })
            ->when(request('filter_to'),function($q) {
                $q->whereDate('date','<=',request('filter_to'));
            }, function ($q) {
                $q->whereDate('date','>=',Carbon::now()->format('Y-m-d'));
            })->where('expense_category_id',1)->select((DB::raw('sum(expense) as expense')),DB::raw("DATE_FORMAT(date, '%b-%Y') as month"),'date')->groupBy('date')->pluck('date')->all();
        $ad_spendsArray['y'] = Expense::where('user_id',auth()->id())
            ->when(request('filter_from'),function($q) {
                $q->whereDate('date','>=',request('filter_from'));
            }, function($q) {
                $q->whereDate('date','>=',Carbon::now()->subDays(30)->format('Y-m-d'));
            })
            ->when(request('filter_to'),function($q) {
                $q->whereDate('date','<=',request('filter_to'));
            }, function ($q) {
                $q->whereDate('date','>=',Carbon::now()->format('Y-m-d'));
            })->where('expense_category_id',1)->select((DB::raw('sum(expense) as expense')),DB::raw("DATE_FORMAT(date, '%b-%Y') as month"),'date')->groupBy('date')->pluck('expense')->all();

        // Ad Spends
        $overheadsArray['x'] = Expense::where('user_id',auth()->id())
            ->when(request('filter_from'),function($q) {
                $q->whereDate('date','>=',request('filter_from'));
            }, function($q) {
                $q->whereDate('date','>=',Carbon::now()->subDays(30)->format('Y-m-d'));
            })
            ->when(request('filter_to'),function($q) {
                $q->whereDate('date','<=',request('filter_to'));
            }, function ($q) {
                $q->whereDate('date','>=',Carbon::now()->format('Y-m-d'));
            })->whereNot('expense_category_id',1)->select((DB::raw('sum(expense) as expense')),DB::raw("DATE_FORMAT(date, '%b-%Y') as month"),'date')->groupBy('date')->pluck('date')->all();
        $overheadsArray['y'] = Expense::where('user_id',auth()->id())
            ->when(request('filter_from'),function($q) {
                $q->whereDate('date','>=',request('filter_from'));
            }, function($q) {
                $q->whereDate('date','>=',Carbon::now()->subDays(30)->format('Y-m-d'));
            })
            ->when(request('filter_to'),function($q) {
                $q->whereDate('date','<=',request('filter_to'));
            }, function ($q) {
                $q->whereDate('date','>=',Carbon::now()->format('Y-m-d'));
            })->whereNot('expense_category_id',1)->select((DB::raw('sum(expense) as expense')),DB::raw("DATE_FORMAT(date, '%b-%Y') as month"),'date')->groupBy('date')->pluck('expense')->all();

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
