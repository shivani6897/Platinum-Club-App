<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
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

class InvoiceController extends Controller
{
    public function index()
    {
        $customers = Customer::where('user_id',auth()->id())->get(['id'])->pluck('id')->toArray();
        $invoices = Invoice::with('customer')
            ->whereIn('customer_id',$customers)
            ->when(request('search'),function($q){
                $q->where('invoice_number','LIKE','%'.request('search').'%')
                    ->orWhereHas('customer',function($q2){
                        $q2->where('name','LIKE','%'.request('search').'%');
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

    public function store(StoreRequest $request)
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
        $invoiceData['invoice_number'] = $user_deatils ? substr($user_deatils , 2, 3).date('Y').$invoicecount : (substr(auth()->user()->first_name , 0, 3)).date('Y').$invoicecount ;
        $invoiceData['total_amount'] = 0;
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

    public function stripeSuccess(Request $request)
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
            $invoiceData['invoice_number'] = date('Ymd').rand(10000,99999);
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
                'email' => auth()->user()->email,
                // 'note'        => 'IDDQD',
                // 'business id' => '365#GG',
            ],
        ]);

        $customer = new Party([
            'name'          => $invoice->customer?->name,
            'phone' => $invoice->customer?->phone_no,
            'custom_fields' => [
                'email' => $invoice->customer?->email,
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
            ->currencySymbol('₹')
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
        // Then send email to party with link

        // And return invoice itself to browser or have a different view
        return $invoicePDF->stream();
    }
}
