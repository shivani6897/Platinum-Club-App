<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\ProductLog;
use App\Models\Invoice;
use App\Models\Payment;
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
        for($i=0;$i<count($request->product_name);$i++)
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

        return redirect()->back()->with('success','Invoice created');
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
            $invoiceData['status'] = 1;
            $invoice = Invoice::create($invoiceData);

            //Create Product Log and calculate total amount
            $productData = [];
            $total = 0;
            for($i=0;$i<count($request->product_name);$i++)
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

            $payment = Payment::create([
                'invoice_id'=>$invoice->id,
                'amount'=>$paymentIntent->amount/100,
                'type'=>$request->payment_method,
                'transaction_id'=>$paymentIntent->id,
                'payment_response'=>json_encode($paymentIntent),
                'gateway'=>'stripe'
            ]);

            return redirect()->route('invoices.create')->with('success','Invoice Paid');
        }
        catch(\Exception $e)
        {
            return redirect()->route('invoices.create')->withInput($request->all())->with('error',$e->getMessage());
        }
    }
}
