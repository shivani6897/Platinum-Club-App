<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
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
        $products = Product::pluck('name', 'id')->all();
        $customers = Customer::where('user_id',auth()->id())->get(['id','name']);
        return view('customer.invoice.create',compact('customers', 'products'));
    }

    public function store(StoreRequest $request)
    {
        // Init stripe to use later
        // \Stripe\Stripe::setApiKey(config('payment.STRIPE_SECRET'));
        // $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        // $token = new \stdClass();
        // if($request->payment_method==1 || $request->payment_method==2)
        // {
        //     try
        //     {
        //         $token = $stripe->tokens->create([
        //           'card' => [
        //             'number' => $request->card_number,
        //             'exp_month' => explode('/',$request->expiry_date)[0],
        //             'exp_year' => '20'.explode('/',$request->expiry_date)[1],
        //             'cvc' => $request->security_code,
        //           ],
        //         ]);
        //     }
        //     catch(\Exception $e)
        //     {
        //         return redirect()->back()->withInput($request->validated())->with('error',$e->getMessage());
        //     }
        //     // dd($token->id);
        // }

        // dd($request->all(), array_flip($request->product_id));

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

        // if($request->payment_method==1 || $request->payment_method==2)
        // {
        //     try
        //     {
        //         $payment_response = $stripe->charges->create([
        //           'amount' => $total*100,
        //           'currency' => 'inr',
        //           'source' => $token->id,
        //           'description' => $request->description,
        //         ]);
        //         $paymentIntent = \Stripe\PaymentIntent::create([
        //             'amount' => $total*100,
        //             'currency' => 'inr',
        //             'automatic_payment_methods' => [
        //                 'enabled' => true,
        //             ],
        //         ]);

        //         return view('customer.invoice.stripe',compact('paymentIntent'));
        //         $payment = Payment::create([
        //             'invoice_id'=>$invoice->id,
        //             'amount'=>$total,
        //             'type'=>$request->payment_method,
        //             'transaction_id'=>$payment_response->balance_transaction,
        //             'payment_response'=>json_encode($payment_response),
        //             'gateway'=>'stripe'
        //         ]);
        //         $invoice->update([
        //             'total_amount'=>$total,
        //             'status'=>1
        //         ]);
        //     }
        //     catch(\Exception $e)
        //     {
        //         $invoice->delete();
        //         return redirect()->back()->withInput($request->validated())->with('error',$e->getMessage());
        //     }

        // }
        // else
        // {
            $invoice->update([
                'total_amount'=>$total
            ]);
        // }
        $productLog = ProductLog::insert($productData);

        return redirect()->route('invoices.index')->with('success','Invoice created');
    }

    public function paymentIntent($amount)
    {
        // This is your test secret API key.
        \Stripe\Stripe::setApiKey(config('payment.STRIPE_SECRET'));
        $stripe = new \Stripe\StripeClient(config('payment.STRIPE_SECRET'));

        
        header('Content-Type: application/json');

        try {
            // retrieve JSON from POST body
            $jsonStr = file_get_contents('php://input');
            $jsonObj = json_decode($jsonStr);

            if(!empty(explode('_secret_',request('paymentIntent',''))[0]))
            {
                $paymentIntent = $stripe->paymentIntents->update(
                  explode('_secret_',request('paymentIntent',''))[0],
                  ['amount' => $amount*100]
                );

                $output = [
                    'clientSecret' => $paymentIntent->client_secret,
                ];

                echo json_encode($output);
            }
            else
            {

                // Create a PaymentIntent with amount and currency
                $paymentIntent = \Stripe\PaymentIntent::create([
                    'amount' => $amount*100,
                    'currency' => 'inr',
                    'automatic_payment_methods' => [
                        'enabled' => true,
                    ],
                ]);

                $output = [
                    'clientSecret' => $paymentIntent->client_secret,
                ];

                echo json_encode($output);
            }

            
        } catch (Error $e) {
                http_response_code(500);
                echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function stripeSuccess(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('payment.STRIPE_SECRET'));
        $stripe = new \Stripe\StripeClient(config('payment.STRIPE_SECRET'));
        
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
            'name'          => 'Platinum',
            // 'phone'         => '(520) 318-9486',
            'custom_fields' => [
                // 'note'        => 'IDDQD',
                // 'business id' => '365#GG',
            ],
        ]);

        $customer = new Party([
            'name'          => $invoice->customer?->name,
            'custom_fields' => [
                'email' => $invoice->customer?->email,
                'Contact Number' => $invoice->customer?->phone_no,
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
            ->addItems($items);
            // ->notes($notes)
            // ->logo(public_path('vendor/invoices/sample-logo.png'))
            // You can additionally save generated invoice to configured disk
            // ->save('public');

        $link = $invoicePDF->url();
        // Then send email to party with link

        // And return invoice itself to browser or have a different view
        return $invoicePDF->stream();
    }
}
