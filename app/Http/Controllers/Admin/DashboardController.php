<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessStat;
use App\Models\User;
use App\Models\Club;
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
        $users = User::where('role',2)->get(['id','first_name','last_name']);
        $clubs = Club::all(['id','name']);
        $userIds = User::where('club_id',request('club',0))->get(['id'])->pluck('id')->toArray();


        // Numbers In Boxes
        $revenue = Income::when(request('user'),function($q) {
                $q->where('user_id',request('user'));
            })
            ->when(request('club'),function($q) use ($userIds) {
                $q->whereIn('user_id',$userIds);
            })
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
        $ad_spends = Expense::when(request('user'),function($q) {
                $q->where('user_id',request('user'));
            })
            ->when(request('club'),function($q) use ($userIds) {
                $q->whereIn('user_id',$userIds);
            })
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
        $overheads = Expense::when(request('user'),function($q) {
                $q->where('user_id',request('user'));
            })
            ->when(request('club'),function($q) use ($userIds) {
                $q->whereIn('user_id',$userIds);
            })
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
        $leads = Lead::when(request('user'),function($q) {
                $q->where('user_id',request('user'));
            })
            ->when(request('club'),function($q) use ($userIds) {
                $q->whereIn('user_id',$userIds);
            })
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
        $converted_customers = Lead::when(request('user'),function($q) {
                $q->where('user_id',request('user'));
            })
            ->when(request('club'),function($q) use ($userIds) {
                $q->whereIn('user_id',$userIds);
            })
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
        $customers = Customer::when(request('user'),function($q) {
                $q->where('user_id',request('user'));
            })
            ->when(request('club'),function($q) use ($userIds) {
                $q->whereIn('user_id',$userIds);
            })
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
            $profitability = 0;

        // Profit% and Net Profit Graph
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
        //             `incomes`.`income`
        //           FROM
        //             `incomes`
        //             LEFT JOIN `expenses` ON `incomes`.`date` = `expenses`.`date` ".(request('user')?" AND `expenses`.`user_id`=".request('user'):"").(count($userIds)>0?" AND `expenses`.`user_id` IN (".implode(',',$userIds).")":"").
        //                 (request('user')?" AND `incomes`.`user_id`=".request('user'):"").
        //                 (count($userIds)>0?" AND `incomes`.`user_id` IN (".implode(',',$userIds).")":"")."
        //             WHERE `incomes`.`deleted_at` IS NULL
        //             AND `expenses`.`deleted_at` IS NULL
        //             ".(request('filter_from')?
        //                 "AND DATE(`incomes`.`date`)>='".request('filter_from')."'":
        //                 "AND DATE(`incomes`.`date`)>='".Carbon::now()->subDays(30)->format('Y-m-d')."'").
        //                 (request('filter_to')?
        //                 "AND DATE(`incomes`.`date`)<='".request('filter_to')."'":
        //                 "AND DATE(`incomes`.`date`)<='".Carbon::now()->format('Y-m-d')."'")."
        //             GROUP BY `date`,`iid`
        //         )
        //         UNION ALL
        //         (
        //           SELECT
        //             IFNULL(incomes.date, expenses.date) AS date,
        //             SUM(`expenses`.`expense`) as 'expense',
        //             incomes.id AS iid,
        //             `incomes`.`income`
        //           FROM
        //             `incomes`
        //             RIGHT JOIN `expenses` ON `incomes`.`date` = `expenses`.`date` ".(request('user')?" AND `expenses`.`user_id`=".request('user'):"").(count($userIds)>0?" AND `expenses`.`user_id` IN (".implode(',',$userIds).")":"").
        //                 (request('user')?" AND `incomes`.`user_id`=".request('user'):"").
        //                 (count($userIds)>0?" AND `incomes`.`user_id` IN (".implode(',',$userIds).")":"")."
        //             WHERE `incomes`.`deleted_at` IS NULL
        //             AND `expenses`.`deleted_at` IS NULL
        //             ".(request('filter_from')?
        //                 "AND DATE(`expenses`.`date`)>='".request('filter_from')."'":
        //                 "AND DATE(`expenses`.`date`)>='".Carbon::now()->subDays(30)->format('Y-m-d')."'").
        //                 (request('filter_to')?
        //                 "AND DATE(`expenses`.`date`)<='".request('filter_to')."'":
        //                 "AND DATE(`expenses`.`date`)<='".Carbon::now()->format('Y-m-d')."'")."
        //             GROUP BY `date`,`iid`
        //         )
        //     ) AS dt 
        //     GROUP BY `date`
        //     ORDER BY `date`");


        //     //GROUP BY `month`
        //     //ORDER BY `month`");

        // $dateArray = [];
        // $profitArray = [];
        // $netProfitArray = [];

        // $date = '';
        // $incomeData = 0;
        // $expenseData = 0;
        // foreach($stat as $st)
        // {
        //     // $dateArray[] = $st->month;
        //     $dateArray[] = $st->date;
        //     $profitArray[] = ($st->income>0?($st->income-$st->expense)*100/$st->income:-100);
        //     $netProfitArray[] = $st->income-$st->expense;
        // }

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
                            " AND DATE(`incomes`.`date`)<='".Carbon::now()->format('Y-m-d')."'").
                        (request('user')?" AND `incomes`.`user_id`=".request('user'):"").
                        (count($userIds)>0?" AND `incomes`.`user_id` IN (".implode(',',$userIds).")":"")."
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
                        (request('filter_to') && request('filter_to')!='0000-00-00'?
                            (request('filter_from')!='0000-00-00'?
                        " AND DATE(`expenses`.`date`)<='".request('filter_to')."'":""):
                        " AND DATE(`expenses`.`date`)<='".Carbon::now()->format('Y-m-d')."'").
                        (request('user')?" AND `expenses`.`user_id`=".request('user'):"").
                        (count($userIds)>0?" AND `expenses`.`user_id` IN (".implode(',',$userIds).")":"")."
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
        $revenueArray['x'] = Income::when(request('user'),function($q) {
                $q->where('user_id',request('user'));
            })
            ->when(request('club'),function($q) use ($userIds) {
                $q->whereIn('user_id',$userIds);
            })
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
        $revenueArray['y'] = Income::when(request('user'),function($q) {
                $q->where('user_id',request('user'));
            })
            ->when(request('club'),function($q) use ($userIds) {
                $q->whereIn('user_id',$userIds);
            })
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
        $ad_spendsArray['x'] = Expense::when(request('user'),function($q) {
                $q->where('user_id',request('user'));
            })
            ->when(request('club'),function($q) use ($userIds) {
                $q->whereIn('user_id',$userIds);
            })
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
        $ad_spendsArray['y'] = Expense::when(request('user'),function($q) {
                $q->where('user_id',request('user'));
            })
            ->when(request('club'),function($q) use ($userIds) {
                $q->whereIn('user_id',$userIds);
            })
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
        $overheadsArray['x'] = Expense::when(request('user'),function($q) {
                $q->where('user_id',request('user'));
            })
            ->when(request('club'),function($q) use ($userIds) {
                $q->whereIn('user_id',$userIds);
            })
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
        $overheadsArray['y'] = Expense::when(request('user'),function($q) {
                $q->where('user_id',request('user'));
            })
            ->when(request('club'),function($q) use ($userIds) {
                $q->whereIn('user_id',$userIds);
            })
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

        return view('admin.dashboard',compact('revenue','ad_spends','overheads','net_profit','leads','cost_per_lead','converted_customers','customers','profitability','dateArray','profitArray','netProfitArray','revenueArray','ad_spendsArray','overheadsArray','users','clubs'));
        // $users = User::all(['id','first_name','last_name']);
        // $clubs = Club::all(['id','name']);
        // $userIds = User::where('club_id',request('club'))->get(['id'])->pluck('id')->toArray();

        // $stat = BusinessStat::query();
        // if(request('duration',0)==1)
        //     $stat = $stat->whereYear('month',date('Y', strtotime('-1 year')));
        // elseif(request('duration',0)==2)
        //     $stat = $stat->whereYear('month',date('Y', strtotime('-1 month')))->whereMonth('month',date('m', strtotime('-1 month')));
        // if(request('user',0)!=0)
        //     $stat = $stat->where('user_id',request('user'));
        // if(request('club',0)!=0)
        //     $stat = $stat->whereIn('user_id',$userIds);


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

        // $profitability['x'] = BusinessStat::select((DB::raw('avg(profitability) as profitability')),DB::raw("DATE_FORMAT(month, '%b-%Y') as month"),DB::raw('month as date'));
        // if(request('duration',0)==1)
        //     $profitability['x'] = $profitability['x']->whereYear('month',date('Y', strtotime('-1 year')));
        // elseif(request('duration',0)==2)
        //     $profitability['x'] = $profitability['x']->whereYear('month',date('Y', strtotime('-1 month')))->whereMonth('month',date('m', strtotime('-1 month')));
        // if(request('user',0)!=0)
        //     $profitability['x'] = $profitability['x']->where('user_id',request('user'));
        // if(request('club',0)!=0)
        //     $profitability['x'] = $profitability['x']->whereIn('user_id',$userIds);
        // $profitability['x'] = $profitability['x']->groupBy('month')
        //     ->pluck('date')
        //     ->all();

        // $profitability['y'] = BusinessStat::select((DB::raw('avg(profitability) as profitability')),DB::raw("DATE_FORMAT(month, '%b-%Y') as month"));
        // if(request('duration',0)==1)
        //     $profitability['y'] = $profitability['y']->whereYear('month',date('Y', strtotime('-1 year')));
        // elseif(request('duration',0)==2)
        //     $profitability['y'] = $profitability['y']->whereYear('month',date('Y', strtotime('-1 month')))->whereMonth('month',date('m', strtotime('-1 month')));
        // if(request('user',0)!=0)
        //     $profitability['y'] = $profitability['y']->where('user_id',request('user'));
        // if(request('club',0)!=0)
        //     $profitability['y'] = $profitability['y']->whereIn('user_id',$userIds);
        // $profitability['y'] = $profitability['y']->groupBy('month')
        //     ->pluck('profitability')
        //     ->all();

        // return view('admin.dashboard',compact('stat','profitability','users','clubs'));
    }
}
