<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function create()
    {
        return view('customer.incomes.index');
    }
    public function store(Request $request)
    {
        $request->validate([
            'lead_generated' => 'required',
            'converted_customer' => 'required',
        ]);
        $lead = Lead::create($request->all());
        return redirect()->route('incomes.index')->with('success', 'Lead Created successfully');
    }
}
