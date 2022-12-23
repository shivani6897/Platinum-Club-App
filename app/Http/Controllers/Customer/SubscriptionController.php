<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\RecurringInvoice;

class SubscriptionController extends Controller
{
    public function index()
    {
        $rinvoices = RecurringInvoice::where('user_id',auth()->id())->paginate(10);
        return view('subscriptions',compact('rinvoices'));
    }
}
