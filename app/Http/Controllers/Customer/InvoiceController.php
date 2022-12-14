<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use App\Models\Income;
use App\Models\RecurringInvoice;
use App\Models\User;
use App\Models\UserDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\ProductLog;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Product;
use App\Http\Requests\Customer\Invoice\StoreRequest;
use App\Http\Requests\Customer\Invoice\UpdateRequest;
use LaravelDaily\Invoices\Invoice AS InvoicePDF;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use App\Models\PaymentGateway;
use App\Services\Payment\StripeService;
use App\Services\Payment\InvoiceService;
use Mail;

class InvoiceController extends Controller
{
    public function index()
    {
        $customers = Customer::where('user_id',auth()->id())->get(['id'])->pluck('id')->toArray();
        $invoices = Invoice::with('customer')
//            ->where('payment_method','>',0)
            ->whereIn('customer_id',$customers)
            ->when(request('search'),function($q){
                $q->where('invoice_number','LIKE','%'.request('search').'%')
                    ->orWhereHas('customer',function($q2){
                        $q2->where('name','LIKE','%'.request('search').'%')
                            ->orWhere('gst_no','LIKE','%'.request('search').'%');
                    })
                    ->orWhere('total_amount','LIKE','%'.request('search').'%');
            })->latest()->paginate(10);
        return view('customer.invoice.index',compact('invoices'));
    }

    public function create()
    {
        $gateway = PaymentGateway::where('user_id',auth()->id())->firstOrNew();
        $products = Product::where('user_id',auth()->id())->pluck('name', 'id')->all();
        $customers = Customer::where('user_id',auth()->id())->get(['id','name']);
        return view('customer.invoice.create',compact('customers', 'products','gateway'));
    }

    public function store(StoreRequest $request, InvoiceService $invoiceService)
    {
        // Create Invoice
        $invoiceData = $request->only([
            'customer_id',
            'description',
            'payment_method'
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


        $userdetails = UserDetail::where('user_id',auth()->id())->first();
        $user = User::where('id',auth()->id())->first();
        $customer = Customer::where('user_id',auth()->id())->first();

        Mail::to($user->email)->send(new InvoiceMail($invoiceData,$userdetails, $user,$customer,$products,$productData));

        return redirect()->route('invoices.index')->with('success','Invoice created');
    }

    public function paymentIntent($amount)
    {
        $gateway = PaymentGateway::where('user_id',auth()->id())->first();
        if(empty($gateway))
            return '';

        $stripe = new StripeService($gateway->stripe_secret,$gateway->stripe_public);
        return $stripe->paymentIntent($amount,explode('_secret_',request('paymentIntent',''))[0]);
    }

    public function stripeSuccess(Request $request, InvoiceService $invoiceService)
    {
        $gateway = PaymentGateway::where('user_id',auth()->id())->first();
        if(empty($gateway))
            return '';

        \Stripe\Stripe::setApiKey($gateway->stripe_secret);
        $stripe = new \Stripe\StripeClient($gateway->stripe_secret);

        try
        {
            $paymentIntent = $stripe->paymentIntents->retrieve(
              $request->payment_intent,
              []
            );
            // Store Details after payment success
            $invoiceData = $request->only([
                'customer_id',
                'description',
                'payment_method'
            ]);

            $invoiceData['invoice_number'] = $invoiceService->generateInvoiceNumber();
            $invoiceData['total_amount'] = $paymentIntent->amount/100;
            $invoiceData['status'] = ($paymentIntent->status=="succeeded"?1:2);
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

            $productLog = ProductLog::insert($productData);

            $payment = Payment::create([
                'invoice_id'=>$invoice->id,
                'amount'=>$paymentIntent->amount/100,
                'type'=>$request->payment_method,
                'transaction_id'=>$paymentIntent->id,
                'payment_response'=>json_encode($paymentIntent),
                'gateway'=>'stripe'
            ]);
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

            $userdetails = UserDetail::where('user_id',auth()->id())->first();
            $user = User::where('id',auth()->id())->first();
            $customer = Customer::where('user_id',auth()->id())->first();

            Mail::to($user->email)->send(new InvoiceMail($invoiceData,$userdetails, $user,$customer,$products,$productLog));


            return redirect()->route('invoices.index')->with('success','Invoice Paid');
        }
        catch(\Exception $e)
        {
            return redirect()->route('invoices.create')->withInput($request->all())->with('error',$e->getMessage());
        }
    }

    public function getPDF(Invoice $invoice)
    {
        $client = new Party([
            'name'          => auth()->user()->first_name.' '.auth()->user()->last_name,
            'phone'         => auth()->user()->phone_no,
            'custom_fields' => [
                'mail' => auth()->user()->email,
                // 'note'        => 'IDDQD',
                // 'business id' => '365#GG',
            ],
        ]);

        $customer = new Party([
            'name'          => $invoice->customer?->name,
            'phone' => $invoice->customer?->phone_no,
            'custom_fields' => [
                'mail' => $invoice->customer?->email,
                'GST Number' => $invoice->customer?->gst_no,
            ],
        ]);

        $items = [];
        foreach($invoice->product_log as $product)
            $items[] = (new InvoiceItem())->title($product->name)->pricePerUnit($product->price)->quantity($product->qty);

        $notes = [
            'your multiline',
            'additional notes',
            'in regards of delivery or something else',
        ];
        $notes = implode("<br>", $notes);

        $invoicePDF = InvoicePDF::make('receipt')
            ->series('BIG');

        if($invoice->status==1)
            $invoicePDF = $invoicePDF->status(__('invoices::invoice.paid'));

         $invoicePDF = $invoicePDF->serialNumberFormat($invoice->invoice_number)
            ->seller($client)
            ->buyer($customer)
            // ->date(now()->subWeeks(3))
            ->dateFormat('m/d/Y')
            // ->payUntilDays(14)
            ->currencySymbol('???')
            ->currencyCode('INR')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator(',')
            ->currencyDecimalPoint('.')
            ->filename($invoice->invoice_number.'_invoice')
            ->addItems($items)
            // ->notes($notes)
            ->logo(public_path('/images/app-logo.png'));
            // You can additionally save generated invoice to configured disk
            // ->save('public');

        $link = $invoicePDF->url();
        // Then send mail to party with link

        // And return invoice itself to browser or have a different view
        return $invoicePDF->stream();
    }


    public function userDetails(Request $request,$customers){
        $invoices = Invoice::with(['customer', 'payments'])
            ->sortable()
            ->where('customer_id',$customers)
//            ->where('payment_method','>',0)
            ->when(request('search'),function($q) use($customers){
                $q->where(function($q2){
                    $q2->where('invoice_number', 'LIKE', '%' . request('search').'%')
                        ->orWhereHas('customer',function($q3){
                            $q3->where('gst_no','LIKE','%'.request('search').'%');
                        })
                        ->orWhereHas('payments',function($q4){
                            $q4->where('gateway','LIKE','%'.request('search').'%');
                        })
                        ->orWhere('total_amount','LIKE','%'.request('search').'%');
                });
            })
            ->latest()
            ->paginate(10);

        $rinvoices = RecurringInvoice::with(['invoices', 'customer'])
            ->sortable()
            ->where('customer_id',$customers)
            ->when(request('search'),function($q) use($customers){
                $q->where(function($q2) {
                    $q2->orWhereHas('invoices', function ($q3) {
                        $q3->sortable(['invoice_number','total_amount'])
                        ->where('invoice_number', 'LIKE', '%' . request('search') . '%')
                            ->orWhere('total_amount', 'LIKE', '%' . request('search') . '%');
                    })
                        ->orWhereHas('customer', function ($q4) {
                            $q4->where('gst_no', 'LIKE', '%' . request('search') . '%');
                        });
                });
            })
            ->latest()
            ->paginate(10);

        $customer_data = Customer::where('user_id', auth()->id())->first();

        return view('customer.invoice.user_detail',compact('invoices','rinvoices','customer_data'));
    }

}
