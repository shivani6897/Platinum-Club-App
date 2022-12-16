<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\ProductLog;
use App\Models\Invoice;
use App\Http\Requests\Customer\Invoice\StoreRequest;
use App\Http\Requests\Customer\Invoice\UpdateRequest;

class InvoiceController extends Controller
{
    public function index()
    {
        dd('index');
    }

    public function create()
    {
        $customers = Customer::all(['id','customer_name']);
        return view('customer.invoice.create',compact('customers'));
    }

    public function store(StoreRequest $request)
    {
        dd($request->all());
    }

    public function makePayment(Invoice $invoice)
    {
        dd($invoice);
    }
}
