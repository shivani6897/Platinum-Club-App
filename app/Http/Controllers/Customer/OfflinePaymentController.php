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


class OfflinePaymentController extends Controller
{

    public function create(Request $request)
    {
        $input = $request->all();

        $products = Product::where('user_id',auth()->id())->pluck('name', 'id')->all();
        $customers = Customer::where('user_id',auth()->id())->get(['id','name']);
        $customerids = $customers->pluck('id')->toArray();

        $invoices = Invoice::with('customer')
            ->sortable()
            ->whereIn('customer_id',$customerids)
            ->where('is_offline_collection',1)
            ->where(function ($query) use ($input) {
                if(isset($input['search'])){
                    $query->where(function ($q) use ($input) {
                        $q->orWhere('invoice_number', 'Like', '%' . $input['search'] . '%')
                            ->orWhere('total_amount', 'Like', '%' . $input['search'] . '%');
                    });
                }
                if(!empty(request('start_date')) && !empty(request('end_date'))) {
                    $query->WhereBetween('created_at', [request('start_date') ,request('end_date')]);
                }
            })
            ->latest();
            if(!empty(request('transactions'))){
                $invoices = $invoices->limit(request('transactions'))->get();
            }
            else{
                $invoices = $invoices->paginate(10);
            }

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
//dd($request->product_id);
        foreach($request->product_id as $key => $product_id)
        {
//            dd($product_id);
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

        return redirect()->route('offlinepayments.create')->with('success','Offline invoice created');
    }

}
