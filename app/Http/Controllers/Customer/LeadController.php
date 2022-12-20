<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(){
        $lead = Lead::when(request('search'),function($q){
            $q->where('lead_generated','LIKE', '%'.request('search').'%')
                ->orWhere('converted_customer','LIKE','%'.request('search').'%')
                ->orWhere('date','LIKE','%'.request('search').'%');
        })
            ->paginate(10);
        return view('customer.incomes.index', compact('lead'));

    }

    public function create()
    {
        return view('customer.incomes.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'lead_generated' => 'required',
            'converted_customer' => 'required',
            'date'=> 'required',
        ]);
        $array = $request->all();
        $array['user_id'] = auth()->id();
        $lead = Lead::create($array);
        return redirect()->route('incomes.index')->with('success', 'Lead Created successfully');
    }

    public function edit(Lead $lead){
        return view('customer.incomes.lead_edit',compact('lead'));

    }

    public function Update(Request $request,Lead $lead){
        $request->validate([
            'lead_generated' => 'required',
            'converted_customer' => 'required',
            'date'=> 'required',
        ]);
        $lead->update($request->all());
        return redirect()->route('incomes.index')->with('success','Lead Updated Successfully');

    }

    public function destroy(Lead $lead){
        $lead->delete();
        return redirect()->route('incomes.index')->with('success','Lead Deleted Successfully');
    }

}
