<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $event = Event::when(request('search'),function($q){
                $q->where('name','LIKE', '%'.request('search').'%')
                ->orWhere('link','LIKE','%'.request('search').'%')
                ->orWhere('event_date_time','LIKE','%'.request('search').'%');
            })
            ->paginate(10);
        return view('admin/events/index', compact('event'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $event = Event::create([
            'name' => $request->name,
            'description' => $request->description,
            'link' => $request->link,
            'event_date_time' => Carbon::createFromFormat('d/m/Y H:m',urldecode($request->event_date_time))->format('Y-m-d H:m:i'),
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $event->update([
            'name' => $request->name,
            'description' => $request->description,
            'link' => $request->link,
            'event_date_time' => Carbon::createFromFormat('d/m/Y H:m',urldecode($request->event_date_time))->format('Y-m-d H:m:i'),
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event Deleted Successfully');
    }
}

