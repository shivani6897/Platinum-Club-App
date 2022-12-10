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
        return view('customer.tasks.edit',compact('task'));
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
        //
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
}
