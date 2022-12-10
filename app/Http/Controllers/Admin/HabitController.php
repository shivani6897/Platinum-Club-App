<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Habit;
use Illuminate\Http\Request;

class HabitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $habit = Habit::when(request('search'),function($q){
        $q->where('name','LIKE', '%'.request('search').'%');
    })
        ->paginate(10);
        return view('admin/habits/index', compact('habit'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.habits.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Habit::create($request->all());

        return redirect()->route('admin.habits.index')->with('success','Habit Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Habit  $habit
     * @return \Illuminate\Http\Response
     */
    public function show(Habit $habit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Habit  $habit
     * @return \Illuminate\Http\Response
     */
    public function edit(Habit $habit)
    {
//        dd($habits);
        return view('admin.habits.edit',compact('habit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Habit  $habits
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Habit $habit)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $habit->update($request->all());

        return redirect()->route('admin.habits.index')->with('success','Habit Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Habit  $habit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Habit $habit)
    {
        $habit->delete();
        return redirect()->route('admin.habits.index')->with('success','Habit Deleted Successfully');
    }
}
