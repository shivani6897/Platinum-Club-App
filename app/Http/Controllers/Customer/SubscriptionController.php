<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\RecurringInvoice;
use App\Models\Customer;
use App\Models\User;
use App\Models\PaymentGateway;
use Carbon\Carbon;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductLog;
use Razorpay\Api\Api;

class SubscriptionController extends Controller
{
    public function index()
    {
        $rinvoices = RecurringInvoice::with(['invoices','customer'])->where('user_id',auth()->id())->paginate(10);
        return view('customer.subscriptions.index',compact('rinvoices'));
    }

    public function getInvoiceLink($id,$invoiceId,$rinvoiceId)
    {
        $rinvoice = RecurringInvoice::find($rinvoiceId);
        $invoice = Invoice::find($invoiceId);
        $user = User::find($id);
        $gateway = PaymentGateway::where('user_id',$user->id)->firstOrNew();
        // $customer = Customer::find($customerId);

        $data = [];
        if(!empty($invoice))
        {
            $due = $invoice->total_amount;
            $subtotal = $due*0.82;
            $data = [
                'due'=>$due,
                'due_date'=>Carbon::now()->format('d-m-Y'),
                'invoice_date'=>$invoice->created_at->format('d-m-Y'),
                'invoiceId'=>$invoice->id,
                'invoice_number'=>$invoice->invoice_number,
                'subtotal'=>$subtotal,
                'emi'=>0,
                'products'=>$invoice->product_log,
                'product'=>new \stdClass(),
                'status'=>$invoice->status,
                'user'=>$user,
                'customer'=>$invoice->customer, 
                'gateway'=>$gateway,
                'paid_by'=>($invoice->payments->last()?->gateway)?$invoice->payments->last()->gateway:'Offline',
            ];
        }
        else
        {
            $due = $rinvoice->emi_amount;
            $subtotal = $due*0.82;
            $emi = $rinvoice->paid_emis+1;
            $data = [
                'due'=>$due,
                'due_date'=>$rinvoice->next_emi_date->format('d-m-Y'),
                'invoice_date'=>Carbon::now()->format('d-m-Y'),
                'invoiceId'=>0,
                'invoice_number'=>date('Ymd').rand(1000,9999),
                'subtotal'=>$subtotal,
                'emi'=>$emi,
                'products'=>[],
                'product'=> $rinvoice->product,
                'status'=>0,
                'user'=>$user,
                'customer'=>$rinvoice->customer, 
                'gateway'=>$gateway,
                'paid_by'=>'Pending',
            ];
        }
        return view('customer.subscriptions.invoice',compact('id','invoiceId','rinvoiceId','data'));
    }

    public function paymentPage($id,$invoiceId,$rinvoiceId,$amount)
    {
        $gateway = PaymentGateway::where('user_id',$id)->firstOrNew();
        if($gateway->stripe_active!=1 && $gateway->razorpay_active!=1)
            return redirect()->back()->with('error','At least one payment gateway should active to access sharable link.');

        $invoice = Invoice::find($invoiceId);
        $customer = [];
        if(empty($invoice))
        {
            $rinvoice = RecurringInvoice::find($rinvoiceId);
            $customer = $rinvoice->customer;
        }
        else
            $customer = $invoice->customer;

        return view('customer.subscriptions.invoice_payment',compact('id','invoiceId','rinvoiceId','amount','gateway','customer'));
    }

    public function stripeSuccess($id,$invoiceId,$rinvoiceId,Request $request)
    {
        $invoice = Invoice::find($invoiceId);
        $amount = 0;
        if(empty($invoice))
        {
            $rinvoice = RecurringInvoice::find($rinvoiceId);
            $amount = $rinvoice->emi_amount;
        }
        else
            $amount = $invoice->total_amount;
        $gateway = PaymentGateway::where('user_id',$id)->first();
        \Stripe\Stripe::setApiKey($gateway->stripe_secret);
        $stripe = new \Stripe\StripeClient($gateway->stripe_secret);
        
        try
        {
            $paymentIntent = $stripe->paymentIntents->retrieve(
              $request->payment_intent,
              []
            );

            // Redirect if amount paid less then actual amount
            if(($paymentIntent->amount/100)<($amount-1))
            {
                return redirect()->route('invoices.payment.page',[
                    'id'=>$id,
                    'invoiceId'=>$invoiceId,
                    'rinvoiceId'=>$rinvoiceId,
                    'amount'=>$amount,
                ])->withInput($request->all())->with('error','Payment amount mismatch');
            }

            $alreadyPaid = Payment::where('transaction_id',$paymentIntent->id)->first();
            if(!empty($alreadyPaid))
                return redirect()->route('invoices.payment.page',[
                    'id'=>$id,
                    'invoiceId'=>$invoiceId,
                    'rinvoiceId'=>$rinvoiceId,
                    'amount'=>$amount,
                ])->withInput($request->all())->with('error','Cannot reload, Please try again');

            if(!empty($invoice))
            {
                $payment = Payment::create([
                    'invoice_id'=>$invoice->id,
                    'amount'=>$paymentIntent->amount/100,
                    'type'=>3,
                    'transaction_id'=>$paymentIntent->id,
                    'payment_response'=>json_encode($paymentIntent),
                    'gateway'=>'stripe'
                ]);
                $invoice->update(['status'=>1]);
            }
            else
            {
                $invoice = $rinvoice->invoices->last();
                if(empty($invoice))
                {
                    return redirect()->route('invoices.payment.page',[
                        'id'=>$id,
                        'invoiceId'=>$invoiceId,
                        'rinvoiceId'=>$rinvoiceId,
                        'amount'=>$amount,
                    ])->withInput($request->all())->with('error','Invoice details not found');
                }
                // Store Details after payment success

                $invoiceData = [
                    'customer_id'=>$invoice->customer_id,
                    'description'=>$invoice->description,
                    'payment_method'=>3,
                    'invoice_number'=>date('Ymd').rand(10000,99999),
                    'total_amount'=>$paymentIntent->amount/100,
                    'status'=>($paymentIntent->status=="succeeded"?1:2),
                ];
                $invoice = Invoice::create($invoiceData);

                //Create Product Log and calculate total amount
                $productData = [];
                $total = 0;

                $product = Product::find($rinvoice->product_id);
                $productData[] = [
                    'product_id' => $product->id,
                    'invoice_id' => $invoice->id,
                    'name' => $product->name.'['.($rinvoice->paid_emis+1).']',
                    'price' => $paymentIntent->amount/100,
                    'qty' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $productLog = ProductLog::insert($productData);

                $payment = Payment::create([
                    'invoice_id'=>$invoice->id,
                    'amount'=>$paymentIntent->amount/100,
                    'type'=>3,
                    'transaction_id'=>$paymentIntent->id,
                    'payment_response'=>json_encode($paymentIntent),
                    'gateway'=>'stripe'
                ]);

                $rinvoice->update([
                    'paid'=>$rinvoice->paid+$rinvoice->emi_amount,
                    'pending'=>$rinvoice->pending-$rinvoice->emi_amount,
                    'paid_date'=>date('Y-m-d'),
                    'next_emi_date'=>$rinvoice->next_emi_date->addDays('28')->format('Y-m-d'),
                    'paid_emis'=>$rinvoice->paid_emis+1,
                    'status'=>(($rinvoice->paid_emis+1)>=$rinvoice->total_emis?1:0)
                ]);
                $rinvoice->invoices()->attach($invoice->id);
            }

            return view('customer.landing.thankyou',compact('id'))->with('success','Purchase Successful');
        }
        catch(\Exception $e)
        {
            return redirect()->route('landing.index',compact('id'))->withInput($request->all())->with('error',$e->getMessage());
        }
    }

    public function razorpaySuccess($id,$invoiceId,$rinvoiceId,Request $request)
    {
        $invoice = Invoice::find($invoiceId);
        $amount = 0;

        if(empty($invoice))
        {
            $rinvoice = RecurringInvoice::find($rinvoiceId);
            $amount = $rinvoice->emi_amount;
        }
        else
            $amount = $invoice->total_amount;
        
        $gateway = PaymentGateway::where('user_id',$id)->first();
        $generated_signature = hash_hmac('sha256',$request->razorpay_order_id . "|" . $request->razorpay_payment_id, $gateway->razorpay_secret);

        $api = new Api($gateway->razorpay_key, $gateway->razorpay_secret);

        $razorpayment = $api->payment->fetch($request->razorpay_payment_id);

        $alreadyPaid = Payment::where('transaction_id',$razorpayment->id)->first();
        if(!empty($alreadyPaid))
            return redirect()->route('invoices.payment.page',[
                'id'=>$id,
                'invoiceId'=>$invoiceId,
                'rinvoiceId'=>$rinvoiceId,
                'amount'=>$amount,
            ])->withInput($request->all())->with('error','Cannot reload, Please try again');
        

            // Redirect if amount paid less then actual amount
            if(($razorpayment->amount/100)<($amount-1))
            {
                return redirect()->route('invoices.payment.page',[
                    'id'=>$id,
                    'invoiceId'=>$invoiceId,
                    'rinvoiceId'=>$rinvoiceId,
                    'amount'=>$amount,
                ])->withInput($request->all())->with('error','Payment amount mismatch');
            }

            if(!empty($invoice))
            {
                $payment = Payment::create([
                    'invoice_id'=>$invoice->id,
                    'amount'=>$razorpayment->amount/100,
                    'type'=>3,
                    'transaction_id'=>$razorpayment->id,
                    'payment_response'=>json_encode($request->only([
                        'razorpay_payment_id',
                        'razorpay_order_id',
                        'razorpay_signature'
                    ])),
                    'gateway'=>'razorpay'
                ]);
                $invoice->update(['status'=>1]);
            }
            else
            {
                $invoice = $rinvoice->invoices->last();
                if(empty($invoice))
                {
                    return redirect()->route('invoices.payment.page',[
                        'id'=>$id,
                        'invoiceId'=>$invoiceId,
                        'rinvoiceId'=>$rinvoiceId,
                        'amount'=>$amount,
                    ])->withInput($request->all())->with('error','Invoice details not found');
                }
                // Store Details after payment success

                $invoiceData = [
                    'customer_id'=>$invoice->customer_id,
                    'description'=>$invoice->description,
                    'payment_method'=>3,
                    'invoice_number'=>date('Ymd').rand(10000,99999),
                    'total_amount'=>$razorpayment->amount/100,
                    'status'=>($razorpayment->status=="captured"?1:2),
                ];
                $invoice = Invoice::create($invoiceData);

                //Create Product Log and calculate total amount
                $productData = [];
                $total = 0;

                $product = Product::find($rinvoice->product_id);
                $productData[] = [
                    'product_id' => $product->id,
                    'invoice_id' => $invoice->id,
                    'name' => $product->name.'['.($rinvoice->paid_emis+1).']',
                    'price' => $razorpayment->amount/100,
                    'qty' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $productLog = ProductLog::insert($productData);

                $payment = Payment::create([
                    'invoice_id'=>$invoice->id,
                    'amount'=>$razorpayment->amount/100,
                    'type'=>3,
                    'transaction_id'=>$razorpayment->id,
                    'payment_response'=>json_encode($request->only([
                        'razorpay_payment_id',
                        'razorpay_order_id',
                        'razorpay_signature'
                    ])),
                    'gateway'=>'razorpay'
                ]);

                $rinvoice->update([
                    'paid'=>$rinvoice->paid+$rinvoice->emi_amount,
                    'pending'=>$rinvoice->pending-$rinvoice->emi_amount,
                    'paid_date'=>date('Y-m-d'),
                    'next_emi_date'=>$rinvoice->next_emi_date->addDays('28')->format('Y-m-d'),
                    'paid_emis'=>$rinvoice->paid_emis+1,
                    'status'=>(($rinvoice->paid_emis+1)>=$rinvoice->total_emis?1:0)
                ]);
                $rinvoice->invoices()->attach($invoice->id);
            }

            return view('customer.landing.thankyou',compact('id'))->with('success','Purchase Successful');
    }
}
