<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\OfflinePayment\StoreRequest;
use App\Http\Requests\Customer\OfflinePayment\UpdateRequest;
use App\Models\Customer;
use App\Models\Income;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\ProductLog;
use App\Models\UserDetail;
use App\Services\Payment\InvoiceService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;


class OfflinePaymentController extends Controller
{
    public function index()
    {
        $customers = Customer::where('user_id',auth()->id())->get(['id'])->pluck('id')->toArray();
        $invoices = Invoice::with('customer')
            ->whereIn('customer_id',$customers)
            ->when(request('search'),function($q){
                $q->where('invoice_number','LIKE','%'.request('search').'%')
                    ->orWhereHas('customer',function($q2){
                        $q2->where('name','LIKE','%'.request('search').'%')
                            ->where('gst_no','LIKE','%'.request('search').'%');
                    })
                    ->orWhere('total_amount','LIKE','%'.request('search').'%');
            })
            ->where('is_offline_collection',1)
            ->where('payment_method',0)
            ->latest()->paginate(10);

        return view('admin.offlinepayment.index',compact('invoices'));
    }

    public function edit(Invoice $invoices)
    {
//        dd($invoices);
        $products = Product::where('user_id',auth()->id())->get();
        $productLogs = ProductLog::where('invoice_id',$invoices->id)->get();
        $customers = Customer::where('user_id',auth()->id())->get(['id','name']);
        return view('admin.offlinepayment.edit',compact('customers', 'products','invoices','productLogs'));
    }

    public function update(UpdateRequest $request, InvoiceService $invoiceService,Invoice $invoices)
    {
        // Create Invoice
        $invoiceData = $request->only([
            'customer_id',
            'description',
//            'payment_method'
        ]);
        $user_deatils = UserDetail::where('user_id',auth()->id())->first('business_name');

//        $invoicecount = Invoice::whereYear('created_at', date('Y'))->count();
//        $invoicecount = strlen($invoicecount) == 1 ?  '0'.$invoicecount+1 : $invoicecount+1;
//        $invoiceData['invoice_number'] = $invoiceService->generateInvoiceNumber();
        $invoiceData['total_amount'] = 0;
        $invoices->update([$invoiceData]);

        //Create Product Log and calculate total amount
        $productData = [];
        $total = 0;

        $products = Product::where('user_id',auth()->id())->whereIn('id',$request->product_id)->get()->keyBy('id');
        $productLog = ProductLog::where('product_id', $request->product_id)->where('invoice_id',$invoices->id)->first();

        for($i= 0; $i<count($request->product_id); $i++)
        {
            if(!empty($products[$request->product_id[$i]])) {
                $productLog= ProductLog::updateOrCreate([
                    'product_id' => $request->product_id[$i],
                    'invoice_id' => $invoices->id,
                    ],
                    ['name' => $products[$request->product_id[$i]]->name,
                    'price' => $products[$request->product_id[$i]]->price,
                    'qty' => $request->product_qty[$i],
                    'created_at' => now(),
                    'updated_at' => now()
                    ]);
            }

            $total += ($products[$request->product_id[$i]]->price*$request->product_qty[$i]);
        }

        ProductLog::where('invoice_id',$invoices->id)->whereNotIn('product_id',$request->product_id)->delete();
//        }

        $invoices->update([
            'total_amount'=>$total
        ]);
        $incomeData = $request->only([
            'date', 'income'
        ]);
        if(!empty($invoices->income)){
            $invoices->income->update(['income'=>$total]);
        }
        else{
            $incomeData = [];
            $incomeData['user_id'] = auth()->id();
            $incomeData['invoice_id'] = $invoices->id;
            $incomeData['date'] = Carbon::now()->format('Y-m-d');
            $incomeData['income'] = $invoices->total_amount;
            $incomeData['description'] = 'Payment from Invoice';
            $incomeData['income_category_id'] = 1;
            $invoice = Income::create([$incomeData]);
        }

        return redirect()->route('admin.offlinepayments.index')->with('success','Offline invoice updated');
    }

    public function destroy(Invoice $invoices){
//        dd($invoices);
        $invoices->delete();
        return redirect()->route('admin.offlinepayments.index')->with('success','Invoice Deleted Successfully');
    }

}
