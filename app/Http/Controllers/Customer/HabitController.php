<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Habit;
use App\Models\UserHabit;

class HabitController extends Controller
{
    public function index()
    {
        // Habits
        $habitIds = UserHabit::whereDate('created_at',date('Y-m-d'))
                ->where('user_id',auth()->id())
                ->get(['habit_id'])->pluck('habit_id')->toArray();
        $habits = Habit::whereNotIn('id',$habitIds)->get(['id','name']);

        // Calendar Control
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

        // Get Datewise Habits
        $date = date('Y-m-d',strtotime($array['year'].'-'.$array['month'].'-01'));//Current Month Year
        $data = [];
        while (strtotime($date) <= strtotime(date($array['year'].'-'.$array['month']) . '-' . date('t', strtotime($date)))) {

            // One time tasks for day 
            $userHabits = UserHabit::whereDate('created_at',date("Y-m-d", strtotime($date)))->where('user_id',auth()->id())->get();
            foreach($userHabits as $hbt)
            {
                $data[] = [
                    'event_id'=>$hbt->id,
                    'event_date'=>date("Y-m-d", strtotime($date)),
                    'event_title'=>$hbt->habit?->name,
                    'event_theme'=>'blue',
                ];
            }


            $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));//Adds 1 day onto current date
        }
        // dd($data);
        request()->merge($array);
        return view('customer.habits.index',compact('data','habits'));
    }

    public function complete(Habit $habit)
    {
        $exists = UserHabit::whereDate('created_at',date('Y-m-d'))
                ->where('habit_id',$habit->id)
                ->where('user_id',auth()->id())
                ->first();

        if(empty($exists))
        {
            $userHabit = UserHabit::create([
                'user_id'=>auth()->id(),
                'habit_id'=>$habit->id,
            ]);
            return redirect()->back()->with('success','Habit completed today');
        }
        return redirect()->back()->with('warning','Habit already completed for today');
    }

    public function destroy(UserHabit $habit)
    {
        $habit->delete();
        return redirect()->back()->with('success','Habit removed from completed habits');
    }
}
