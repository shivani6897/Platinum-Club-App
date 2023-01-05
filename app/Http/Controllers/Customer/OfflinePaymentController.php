<?php

namespace App\Http\Controllers\Customer;

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

    public function create(Request $request)
    {
        $input = $request->all();
//        dd(request('created_at'));
        if(!empty($input['created_at'])){
            $created_at = explode('to', request('created_at'));
//            dd($created_at);
        }
        else
            $created_at = '';

//        $created_at1 = ($created_at[0]);
//        $created_at2 = isset($created_at[1]);
//        dd($created_at2, $created_at1);

        $products = Product::where('user_id',auth()->id())->pluck('name', 'id')->all();
        $customers = Customer::where('user_id',auth()->id())->get(['id','name']);
        $customerids = $customers->pluck('id')->toArray();

        $invoices = Invoice::with('customer')
            ->sortable()
            ->where('customer_id',$customerids)
            ->where(function ($query) use ($input,$created_at) {
                if(isset($input['search'])){
                    $query->where(function ($q) use ($input) {
                        $q->orWhere('invoice_number', 'Like', '%' . $input['search'] . '%')
                            ->orWhere('total_amount', 'Like', '%' . $input['search'] . '%');
                    });
                }
                if(!empty($created_at[0]) && isset($created_at[1]) && !empty($created_at[1])) {
//                    dd($created_at1 || $created_at2);
                    $query->WhereBetween('created_at', [$created_at[0] ,$created_at[1]]);
//                    $query->where('created_at', '>=', $created_at1)
//                            ->where('created_at', '<=', $created_at2);

                }
                elseif(!empty($created_at[0])){
                    $query->WhereDate('created_at', $created_at[0]);
                }

           })
            ->latest();
//            ->toSql();
                if(!empty(request('transactions'))){
                    $invoices = $invoices->limit(request('transactions'))->get();
                }
                else{
                    $invoices = $invoices->paginate(10);
                }
//                $invoices = $invoices->paginate(10);
//            ->toSql();
//            ->take($transactions)
//            ->paginate(10);
//        dd($invoices);

        return view('customer.offlinepayments.create',compact('customers', 'products','invoices'));
    }

    public function store(StoreRequest $request, InvoiceService $invoiceService)
    {
        // Create Invoice
        $invoiceData = $request->only([
            'customer_id',
            'description',
        ]);
        $user_deatils = UserDetail::where('user_id',auth()->id())->first('business_name');

        $invoicecount = Invoice::whereYear('created_at', date('Y'))->count();
        $invoicecount = strlen($invoicecount) == 1 ?  '0'.$invoicecount+1 : $invoicecount+1;
        $invoiceData['invoice_number'] = $invoiceService->generateInvoiceNumber();
        $invoiceData['total_amount'] = 0;
        $invoiceData['status'] = 1;
        $invoiceData['is_offline_collection'] = 1;
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

        return redirect()->route('offlinepayments.create')->with('success','Offline invoice created');
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

        $products = Product::get()->keyBy('id');
//        dd($products);
        $productLog = ProductLog::where('product_id', $request->product_id)->where('invoice_id',$invoices->id)->first();
//        dd($productLog);

//        foreach($productLog as $product_id)
//        {
//            @dd($productLog->qty);
        $productLog = [
                'product_id' => $productLog->id,
                'invoice_id' => $invoices->id,
                'name' => $productLog->name,
                'price' => $productLog->price,
                'qty' => $request->product_qty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        dd($productLog);

//            $total += ($productLog->price*$productLog->qty);
            $productLog->update([$productLog]);
            dd($productLog);
//        }

        $invoices->update([
            'total_amount'=>$total
        ]);
//        $productLog = ProductLog::insert($productData);
        $incomeData = $request->only([
            'date', 'income'
        ]);
//        $incomeData['invoice_id'] = $customer->id;
        $incomeData['user_id'] = auth()->id();
        $incomeData['invoice_id'] = $invoices->id;
        $incomeData['date'] = Carbon::now()->format('Y-m-d');
        $incomeData['income'] = $invoices->total_amount;
        $incomeData['description'] = 'Payment from Invoice';
        $incomeData['income_category_id'] = 1;
        $income = Income::create($incomeData);

        return redirect()->route('admin.offlinepayments.index')->with('success','Offline invoice updated');
    }

    public function destroy(Invoice $invoices){
//        dd($invoices);
        $invoices->delete();
        return redirect()->route('admin.offlinepayments.index')->with('success','Invoice Deleted Successfully');
    }




}
