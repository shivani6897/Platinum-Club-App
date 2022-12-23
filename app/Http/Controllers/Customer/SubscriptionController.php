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
        $rinvoices = RecurringInvoice::with(['invoices','customer'])->where('user_id',auth()->id())->paginate(10);
        return view('customer.subscriptions.index',compact('rinvoices'));
    }

    public function getInvoiceLink($userId,$invoiceId,$rinvoiceId)
    {
        $rinvoice = RecurringInvoice::find($rinvoiceId);
        $invoice = Invoice::find($invoiceId);
        return view('customer.subscriptions.index');
    }
}
