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
                if(request('filter_from')!='0000-00-00')
                    $q->whereDate('date','>=',request('filter_from'));
            }, function($q) {
                $q->whereDate('date','>=',Carbon::now()->subDays(30)->format('Y-m-d'));
            })
            ->when(request('filter_to'),function($q) {
                if(request('filter_to')!='0000-00-00')
                    $q->whereDate('date','<=',request('filter_to'));
            }, function ($q) {
                $q->whereDate('date','<=',Carbon::now()->format('Y-m-d'));
            })->sum('income');
        $ad_spends = Expense::where('user_id',auth()->id())
            ->when(request('filter_from'),function($q) {
                if(request('filter_from')!='0000-00-00')
                    $q->whereDate('date','>=',request('filter_from'));
            }, function($q) {
                $q->whereDate('date','>=',Carbon::now()->subDays(30)->format('Y-m-d'));
            })
            ->when(request('filter_to'),function($q) {
                if(request('filter_to')!='0000-00-00')
                    $q->whereDate('date','<=',request('filter_to'));
            }, function ($q) {
                $q->whereDate('date','<=',Carbon::now()->format('Y-m-d'));
            })->where('expense_category_id',1)->sum('expense');
        $overheads = Expense::where('user_id',auth()->id())
            ->when(request('filter_from'),function($q) {
                if(request('filter_from')!='0000-00-00')
                    $q->whereDate('date','>=',request('filter_from'));
            }, function($q) {
                $q->whereDate('date','>=',Carbon::now()->subDays(30)->format('Y-m-d'));
            })
            ->when(request('filter_to'),function($q) {
                if(request('filter_to')!='0000-00-00')
                    $q->whereDate('date','<=',request('filter_to'));
            }, function ($q) {
                $q->whereDate('date','<=',Carbon::now()->format('Y-m-d'));
            })->whereNot('expense_category_id',1)->sum('expense');
        $net_profit = $revenue-$ad_spends-$overheads;
        $leads = Lead::where('user_id',auth()->id())
            ->when(request('filter_from'),function($q) {
                if(request('filter_from')!='0000-00-00')
                    $q->whereDate('date','>=',request('filter_from'));
            }, function($q) {
                $q->whereDate('date','>=',Carbon::now()->subDays(30)->format('Y-m-d'));
            })
            ->when(request('filter_to'),function($q) {
                if(request('filter_to')!='0000-00-00')
                    $q->whereDate('date','<=',request('filter_to'));
            }, function ($q) {
                $q->whereDate('date','<=',Carbon::now()->format('Y-m-d'));
            })->sum('lead_generated');
        $cost_per_lead = $ad_spends/($leads>0?$leads:1);
        $converted_customers = Lead::where('user_id',auth()->id())
            ->when(request('filter_from'),function($q) {
                if(request('filter_from')!='0000-00-00')
                    $q->whereDate('date','>=',request('filter_from'));
            }, function($q) {
                $q->whereDate('date','>=',Carbon::now()->subDays(30)->format('Y-m-d'));
            })
            ->when(request('filter_to'),function($q) {
                if(request('filter_to')!='0000-00-00')
                    $q->whereDate('date','<=',request('filter_to'));
            }, function ($q) {
                $q->whereDate('date','<=',Carbon::now()->format('Y-m-d'));
            })->sum('converted_customer');
        $customers = Customer::where('user_id',auth()->id())
            ->when(request('filter_from'),function($q) {
                if(request('filter_from')!='0000-00-00')
                    $q->whereDate('created_at','>=',request('filter_from'));
            }, function($q) {
                $q->whereDate('created_at','>=',Carbon::now()->subDays(30)->format('Y-m-d'));
            })
            ->when(request('filter_to'),function($q) {
                if(request('filter_to')!='0000-00-00')
                    $q->whereDate('created_at','<=',request('filter_to'));
            }, function ($q) {
                $q->whereDate('created_at','<=',Carbon::now()->format('Y-m-d'));
            })->count();
        $profitability = ($revenue>0?$net_profit*100/$revenue:-100);
        if($revenue==0 && $net_profit==0)
            $profitability=0;

        // Profit% and Net Profit Graph
        // SQL QUERY REFERENCE 
        // SELECT `date`,MAX(`expense`),MAX(`income`) FROM
                // (SELECT incomes.date,
                //        0 AS 'expense',
                //       SUM(`incomes`.`income`) AS 'income'
                //       FROM
                //       `incomes`
                //       WHERE `incomes`.`deleted_at` IS NULL
                //       AND DATE(`incomes`.`date`)>='2022-01-01' AND DATE(`incomes`.`date`)<='2022-12-31'
                //       AND `incomes`.user_id=2
                //       GROUP BY `date`
                      
                // UNION ALL
                      
                // SELECT expenses.date,
                //       SUM(`expenses`.`expense`) AS 'expense',
                //       0 AS 'income'
                //       FROM
                //       `expenses`
                //       WHERE `expenses`.`deleted_at` IS NULL
                //       AND DATE(`expenses`.`date`)>='2022-01-01' AND DATE(`expenses`.`date`)<='2022-12-31'
                //       AND `expenses`.user_id=2
                //       GROUP BY `date`
                // ) AS tbl
                // GROUP BY `date`
                // ORDER BY `date`
        // $stat = DB::select("SELECT DATE_FORMAT(`date`, '%b-%Y') as month,
        //             sum(`expense`) as expense,
        //             sum(`income`) as income
        // $stat = DB::select("SELECT `date`,
        //             MAX(`expense`) AS 'expense',
        //             SUM(`income`) AS 'income'
        //     FROM (  (
        //           SELECT
        //             IFNULL(incomes.date, expenses.date) AS date,
        //             SUM(`expenses`.`expense`) as 'expense',
        //             incomes.id AS iid,
        //             `incomes`.`user_id`,
        //             `incomes`.`income`
        //           FROM
        //             `incomes`
        //             LEFT JOIN `expenses` ON `incomes`.`date` = `expenses`.`date` AND `expenses`.`user_id`=`incomes`.`user_id`
        //             WHERE `incomes`.`deleted_at` IS NULL
        //             AND `expenses`.`deleted_at` IS NULL
        //             ".(request('filter_from')?
        //                 " AND DATE(`incomes`.`date`)>='".request('filter_from')."'":
        //                 " AND DATE(`incomes`.`date`)>='".Carbon::now()->subDays(30)->format('Y-m-d')."'").
        //                 (request('filter_to')?
        //                 " AND DATE(`incomes`.`date`)<='".request('filter_to')."'":
        //                 " AND DATE(`incomes`.`date`)<='".Carbon::now()->format('Y-m-d')."'")."
        //                 AND (`incomes`.`user_id`=".auth()->id().")
        //             GROUP BY `date`,`iid`
        //         )
        //         UNION ALL
        //         (
        //           SELECT
        //             IFNULL(incomes.date, expenses.date) AS date,
        //             SUM(`expenses`.`expense`) as 'expense',
        //             incomes.id AS iid,
        //             `incomes`.`user_id`,
        //             `incomes`.`income`
        //           FROM
        //             `incomes`
        //             RIGHT JOIN `expenses` ON `incomes`.`date` = `expenses`.`date` AND `expenses`.`user_id`=`incomes`.`user_id`
        //             WHERE `incomes`.`deleted_at` IS NULL
        //             AND `expenses`.`deleted_at` IS NULL
        //             ".(request('filter_from')?
        //                 " AND DATE(`expenses`.`date`)>='".request('filter_from')."'":
        //                 " AND DATE(`expenses`.`date`)>='".Carbon::now()->subDays(30)->format('Y-m-d')."'").
        //                 (request('filter_to')?
        //                 " AND DATE(`expenses`.`date`)<='".request('filter_to')."'":
        //                 " AND DATE(`expenses`.`date`)<='".Carbon::now()->format('Y-m-d')."'")."
        //                 AND (`incomes`.`user_id`=".auth()->id().")
        //             GROUP BY `date`,`iid`
        //         )
        //     ) AS dt 
        //     GROUP BY `date`
        //     ORDER BY `date`"
        // );
        $stat = DB::select("SELECT 
                    `date`,
                    SUM(`expense`) AS 'expense',SUM(`income`) AS 'income', 
                    SUM(`income`)-SUM(`expense`) AS 'net_profit' ,
                    IF(SUM(`income`)>0,ROUND((SUM(`income`)-SUM(`expense`))*100/SUM(`income`),2),-100) AS 'profitability' 
                FROM
                    (SELECT incomes.date,
                           0 AS 'expense',
                          SUM(`incomes`.`income`) AS 'income'
                          FROM
                          `incomes`
                          WHERE `incomes`.`deleted_at` IS NULL
                          ".(request('filter_from')?
                            (request('filter_from')!='0000-00-00'?
                        " AND DATE(`incomes`.`date`)>='".request('filter_from')."'":""):
                        " AND DATE(`incomes`.`date`)>='".Carbon::now()->subDays(30)->format('Y-m-d')."'").
                        (request('filter_to')?
                            (request('filter_to')!='0000-00-00'?
                        " AND DATE(`incomes`.`date`)<='".request('filter_to')."'":""):
                        " AND DATE(`incomes`.`date`)<='".Carbon::now()->format('Y-m-d')."'")."
                          AND `incomes`.user_id=".auth()->id()."
                          GROUP BY `date`
                          
                    UNION ALL
                          
                    SELECT expenses.date,
                          SUM(`expenses`.`expense`) AS 'expense',
                          0 AS 'income'
                          FROM
                          `expenses`
                          WHERE `expenses`.`deleted_at` IS NULL
                          ".(request('filter_from')?
                            (request('filter_from')!='0000-00-00'?
                        " AND DATE(`expenses`.`date`)>='".request('filter_from')."'":""):
                        " AND DATE(`expenses`.`date`)>='".Carbon::now()->subDays(30)->format('Y-m-d')."'").
                        (request('filter_to')?
                            (request('filter_from')!='0000-00-00'?
                        " AND DATE(`expenses`.`date`)<='".request('filter_to')."'":""):
                        " AND DATE(`expenses`.`date`)<='".Carbon::now()->format('Y-m-d')."'")."
                          AND `expenses`.user_id=".auth()->id()."
                          GROUP BY `date`
                    ) AS tbl
                    GROUP BY `date`
                    ORDER BY `date`"
                );
            //GROUP BY `month`
            //ORDER BY `month`");
        $dateArray = array_column($stat, 'date');
        $profitArray = array_column($stat, 'profitability');
        $netProfitArray = array_column($stat, 'net_profit');


        // Revenue
        $revenueArray['x'] = Income::where('user_id',auth()->id())
            ->when(request('filter_from'),function($q) {
                if(request('filter_from')!='0000-00-00')
                    $q->whereDate('date','>=',request('filter_from'));
            }, function($q) {
                $q->whereDate('date','>=',Carbon::now()->subDays(30)->format('Y-m-d'));
            })
            ->when(request('filter_to'),function($q) {
                if(request('filter_to')!='0000-00-00')
                    $q->whereDate('date','<=',request('filter_to'));
            }, function ($q) {
                $q->whereDate('date','<=',Carbon::now()->format('Y-m-d'));
            })->select((DB::raw('sum(income) as revenue')),DB::raw("DATE_FORMAT(date, '%b-%Y') as month"),'date')->groupBy('date')->orderBy('date')->pluck('date')->all();
        $revenueArray['y'] = Income::where('user_id',auth()->id())
            ->when(request('filter_from'),function($q) {
                if(request('filter_from')!='0000-00-00')
                    $q->whereDate('date','>=',request('filter_from'));
            }, function($q) {
                $q->whereDate('date','>=',Carbon::now()->subDays(30)->format('Y-m-d'));
            })
            ->when(request('filter_to'),function($q) {
                if(request('filter_to')!='0000-00-00')
                    $q->whereDate('date','<=',request('filter_to'));
            }, function ($q) {
                $q->whereDate('date','<=',Carbon::now()->format('Y-m-d'));
            })->select((DB::raw('sum(income) as revenue')),DB::raw("DATE_FORMAT(date, '%b-%Y') as month"),'date')->groupBy('date')->orderBy('date')->pluck('revenue')->all();

        // dd($revenueArray);

        // Ad Spends
        $ad_spendsArray['x'] = Expense::where('user_id',auth()->id())
            ->when(request('filter_from'),function($q) {
                if(request('filter_from')!='0000-00-00')
                    $q->whereDate('date','>=',request('filter_from'));
            }, function($q) {
                $q->whereDate('date','>=',Carbon::now()->subDays(30)->format('Y-m-d'));
            })
            ->when(request('filter_to'),function($q) {
                if(request('filter_to')!='0000-00-00')
                    $q->whereDate('date','<=',request('filter_to'));
            }, function ($q) {
                $q->whereDate('date','<=',Carbon::now()->format('Y-m-d'));
            })->where('expense_category_id',1)->select((DB::raw('sum(expense) as expense')),DB::raw("DATE_FORMAT(date, '%b-%Y') as month"),'date')->groupBy('date')->pluck('date')->all();
        $ad_spendsArray['y'] = Expense::where('user_id',auth()->id())
            ->when(request('filter_from'),function($q) {
                if(request('filter_from')!='0000-00-00')
                    $q->whereDate('date','>=',request('filter_from'));
            }, function($q) {
                $q->whereDate('date','>=',Carbon::now()->subDays(30)->format('Y-m-d'));
            })
            ->when(request('filter_to'),function($q) {
                if(request('filter_to')!='0000-00-00')
                    $q->whereDate('date','<=',request('filter_to'));
            }, function ($q) {
                $q->whereDate('date','<=',Carbon::now()->format('Y-m-d'));
            })->where('expense_category_id',1)->select((DB::raw('sum(expense) as expense')),DB::raw("DATE_FORMAT(date, '%b-%Y') as month"),'date')->groupBy('date')->pluck('expense')->all();

        // Ad Spends
        $overheadsArray['x'] = Expense::where('user_id',auth()->id())
            ->when(request('filter_from'),function($q) {
                if(request('filter_from')!='0000-00-00')
                    $q->whereDate('date','>=',request('filter_from'));
            }, function($q) {
                $q->whereDate('date','>=',Carbon::now()->subDays(30)->format('Y-m-d'));
            })
            ->when(request('filter_to'),function($q) {
                if(request('filter_to')!='0000-00-00')
                    $q->whereDate('date','<=',request('filter_to'));
            }, function ($q) {
                $q->whereDate('date','<=',Carbon::now()->format('Y-m-d'));
            })->whereNot('expense_category_id',1)->select((DB::raw('sum(expense) as expense')),DB::raw("DATE_FORMAT(date, '%b-%Y') as month"),'date')->groupBy('date')->pluck('date')->all();
        $overheadsArray['y'] = Expense::where('user_id',auth()->id())
            ->when(request('filter_from'),function($q) {
                if(request('filter_from')!='0000-00-00')
                    $q->whereDate('date','>=',request('filter_from'));
            }, function($q) {
                $q->whereDate('date','>=',Carbon::now()->subDays(30)->format('Y-m-d'));
            })
            ->when(request('filter_to'),function($q) {
                if(request('filter_to')!='0000-00-00')
                    $q->whereDate('date','<=',request('filter_to'));
            }, function ($q) {
                $q->whereDate('date','<=',Carbon::now()->format('Y-m-d'));
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
