<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskCategory;
use Illuminate\Http\Request;
use App\Http\Requests\Customer\Task\StoreRequest;
use App\Http\Requests\Customer\Task\UpdateRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tasks = Task::with('task_category')
            ->when(request('search'),function($q){
                $q->whereHas('task_category',function($q2){
                    $q2->where('name','LIKE', '%'.request('search').'%');
                })
                ->orWhere('name','LIKE','%'.request('search').'%')
                ->orWhere('day_of_week','LIKE','%'.request('search').'%')
                ->orWhere('day_of_week_2','LIKE','%'.request('search').'%');
            })->paginate(10);
        return view('customer.tasks.index',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = TaskCategory::all(['id','name']);
        return view('customer.tasks.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $array = $request->only([
            'task_category_id',
            'name',
            'type'
        ]);
        $array['user_id'] = auth()->id();

        if($array['type']==0)
        {
            $array['task_date'] = $request->date.' '.$request->time;
        }
        else
        {
            $array['start_date'] = $request->start_date;
            $array['end_date'] = $request->end_date;
            $array['task_time'] = $request->recurring_time;
            $array['frequency'] = $request->frequency;
            $array['day_of_week'] = ($request->frequency==1?$request->day_of_week_1:$request->day_of_week);
            $array['day_of_week_2'] = $request->day_of_week_2;
            $array['month_day'] = $request->day_of_month;
        }

        $task = Task::create($array);
        return redirect()->route('tasks.index')->with('success','Task Created');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $categories = TaskCategory::all(['id','name']);
        return view('customer.tasks.edit',compact('task','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Task $task)
    {
        $array = $request->only([
            'task_category_id',
            'name',
            'type'
        ]);
        $array['user_id'] = auth()->id();

        if($array['type']==0)
        {
            $array['task_date'] = $request->date.' '.$request->time;
        }
        else
        {
            $array['start_date'] = $request->start_date;
            $array['end_date'] = $request->end_date;
            $array['task_time'] = $request->recurring_time;
            $array['frequency'] = $request->frequency;
            $array['day_of_week'] = ($request->frequency==1?$request->day_of_week_1:$request->day_of_week);
            $array['day_of_week_2'] = $request->day_of_week_2;
            $array['month_day'] = $request->day_of_month;
        }

        $task->update($array);
        return redirect()->route('tasks.index')->with('success','Task Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->back()->with('success','Task Deleted');
    }

    public function complete(Task $task)
    {
        $task->update(['completed'=>1]);
        return redirect()->back()->with('success','Task Completed');
    }

    public function calendar()
    {
        $array = [
            'month'=>request('month',date('n')),
            'year'=>request('year',date('Y')),
            'operation'=>request('operation','')
        ];
        if($array['operation']!='')
        {
            if($array['operation']=='sub')
            {
                if($array['month']==1)
                {
                    $array['month']=12;
                    $array['year']--;
                }
                else
                    $array['month']--;
            }
            else if($array['operation']=='add')
            {
                if($array['month']==12)
                {
                    $array['month']=1;
                    $array['year']++;
                }
                else
                    $array['month']++;
            }
        }


        $date = date('Y-m-d',strtotime($array['year'].'-'.$array['month'].'-01'));//Current Month Year
        
        $data = [];
        while (strtotime($date) <= strtotime(date($array['year'].'-'.$array['month']) . '-' . date('t', strtotime($date)))) {

            // One time tasks for day 
            $oneTimeTask = Task::whereDate('task_date',date("Y-m-d", strtotime($date)))->where('frequency',0)->get();
            foreach($oneTimeTask as $once)
            {
                $data[] = [
                    'event_date'=>date("Y-m-d", strtotime($date)),
                    'event_title'=>$once->name.' at '.$once->task_date->format('h:i A'),
                    'event_theme'=>$once->completed==1?'success':'info',
                ];
            }

            // Recurring task for days
            $recurring = Task::where(function($q) use ($date){
                    $q->whereDate('start_date','<=',date("Y-m-d", strtotime($date)))
                        ->whereDate('end_date','>=',date("Y-m-d", strtotime($date)))
                        ->where('frequency',1);
                })
                ->orWhere(function($q) use ($date){
                    $q->whereDate('start_date','<=',date("Y-m-d", strtotime($date)))
                        ->whereDate('end_date','>=',date("Y-m-d", strtotime($date)))
                        ->where(function($q2) use ($date){
                            $q2->where('day_of_week',date("l", strtotime($date)))
                                ->orWhere('day_of_week_2',date("l", strtotime($date)));
                        })
                        ->where('frequency',2);
                })
                ->orWhere(function($q) use ($date){
                    $q->whereDate('start_date','<=',date("Y-m-d", strtotime($date)))
                        ->whereDate('end_date','>=',date("Y-m-d", strtotime($date)))
                        ->where('day_of_week',date("l", strtotime($date)))
                        ->where('frequency',3);
                })
                ->orWhere(function($q) use ($date){
                    $q->whereDate('start_date','<=',date("Y-m-d", strtotime($date)))
                        ->whereDate('end_date','>=',date("Y-m-d", strtotime($date)))
                        ->where('day_of_week',date("l", strtotime($date)))
                        ->where('frequency',4);
                })->get();
            foreach($recurring as $re)
            {
                $data[] = [
                    'event_date'=>date("Y-m-d", strtotime($date)),
                    'event_title'=>$re->name.' at '.$re->task_time->format('h:i A'),
                    'event_theme'=>$re->completed==1?'success':'info',
                ];
            }

            $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));//Adds 1 day onto current date
        }

        request()->merge($array);
        return view('customer.tasks.calendar',compact('data'));
    }
}
