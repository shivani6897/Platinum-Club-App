<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\ProductLog;
use App\Models\Invoice;
use App\Http\Requests\Customer\Invoice\StoreRequest;
use App\Http\Requests\Customer\Invoice\UpdateRequest;
use Stripe;

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
        // Init stripe to use later
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // Create Invoice
        $invoiceData = $request->only([
            'customer_id',
            'description',
            'payment_method'
        ]);
        $invoiceData['invoice_number'] = date('Ymd').rand(10000,99999);
        $invoiceData['total_amount'] = 0;
        $invoice = Invoice::create($invoiceData);

        //Create Product Log and calculate total amount
        $productData = [];
        $total = 0;
        for($i=0;$i<count($request->product_name),$i++)
        {
            $productData[] = [
                'invoice_id'=>$invoice->id,
                'name'=>$request->product_name[$i],
                'price'=>$request->product_price[$i],
                'qty'=>$request->product_qty[$i],
                'created_at'=>now(),
                'updated_at'=>now(),
            ];
            $total += ($request->product_price[$i]*$request->product_qty[$i]);
        }
        $productLog = ProductLog::insert($productData);

        if($request->payment_method==1 || $request->payment_method==2)
        {

        }

        dd($request->all());
    }

    public function makePayment(Invoice $invoice)
    {
        dd($invoice);
    }
}
