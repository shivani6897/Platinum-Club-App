<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Invoice\StoreRequest;
use App\Mail\InvoiceMail;
use App\Models\Customer;
use App\Models\Income;
use App\Models\Invoice;
use App\Models\PaymentGateway;
use App\Models\Product;
use App\Models\ProductLog;
use App\Models\User;
use App\Models\UserDetail;
use App\Services\Payment\InvoiceService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OfflinePayment extends Controller
{
    public function create()
    {
//        $gateway = PaymentGateway::where('user_id',auth()->id())->firstOrNew();
        $products = Product::where('user_id',auth()->id())->pluck('name', 'id')->all();
        $customers = Customer::where('user_id',auth()->id())->get(['id','name']);
        return view('customer.invoice.create',compact('customers', 'products'));
    }

    public function store(StoreRequest $request, InvoiceService $invoiceService)
    {
        // Create Invoice
        $invoiceData = $request->only([
            'customer_id',
            'description',
//            'payment_method'
        ]);
        $user_deatils = UserDetail::where('user_id',auth()->id())->first('business_name');

        $invoicecount = Invoice::whereYear('created_at', date('Y'))->count();
        $invoicecount = strlen($invoicecount) == 1 ?  '0'.$invoicecount+1 : $invoicecount+1;
        $invoiceData['invoice_number'] = $invoiceService->generateInvoiceNumber();
        $invoiceData['total_amount'] = 0;
        $invoiceData['status'] = 1;
        $invoice = Invoice::create($invoiceData);


        //Create Product Log and calculate total amount
        $productData = [];
        $total = 0;

        $products = Product::get()->keyBy('id');

        foreach($request->product_id as $key => $product_id)
        {
            $productData[] = [
                'product_id' => $product_id,
                'invoice_id' => $invoice->id,
                'name' => $products[$product_id]->name,
                'price' => $products[$product_id]->price,
                'qty' => $request->product_qty[$key],
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $total += ($request->product_price[$key]*$request->product_qty[$key]);
        }

        $invoice->update([
            'total_amount'=>$total
        ]);
        $productLog = ProductLog::insert($productData);
        $incomeData = $request->only([
            'date', 'income'
        ]);
//        $incomeData['invoice_id'] = $customer->id;
        $incomeData['user_id'] = auth()->id();
        $incomeData['invoice_id'] = $invoice->id;
        $incomeData['date'] = Carbon::now()->format('Y-m-d');
        $incomeData['income'] = $invoice->total_amount;
        $incomeData['description'] = 'Payment from Invoice';
        $incomeData['income_category_id'] = 1;
        $income = Income::create($incomeData);


//        $userdetails = UserDetail::where('user_id',auth()->id())->first();
//        $user = User::where('id',auth()->id())->first();
//        $customer = Customer::where('user_id',auth()->id())->first();
//
//        Mail::to($user->email)->send(new InvoiceMail($invoiceData,$userdetails, $user,$customer,$products,$productData));

        return redirect()->route('invoices.index')->with('success','Invoice created');
    }
}
