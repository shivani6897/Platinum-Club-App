<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Mail\LandingInvoiceMail;
use App\Models\Income;
use App\Services\Utilities\QueryStringParser;
use App\Models\UserDetail;
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
use Instamojo\Instamojo;
use Razorpay\Api\Api;
use App\Services\Payment\InvoiceService;
use Mail;

class SubscriptionController extends Controller
{
    public function index()
    {
        $rinvoices = RecurringInvoice::with(['invoices', 'customer'])->where('user_id', auth()->id())->paginate(10);
        return view('customer.subscriptions.index', compact('rinvoices'));
    }

    public function getInvoiceLink($id, $invoiceId, $rinvoiceId, InvoiceService $invoiceService)
    {
        $rinvoice = RecurringInvoice::find($rinvoiceId);
        $invoice = Invoice::find($invoiceId);
        $user = User::find($id);
        $gateway = PaymentGateway::where('user_id', $user->id)->firstOrNew();
        $userdetails = UserDetail::where('user_id', $user->id)->first();
        $customer = Customer::where('user_id', $user->id)->first();
        $gateway = PaymentGateway::where('user_id', $user->id)->firstOrNew();
        // $customer = Customer::find($customerId);

        $data = [];
        if (!empty($invoice)) {
            //             dd($invoice);
            //             $tax = $rinvoice?->product?->tax;
            $tax = $invoice->product_log?->first()->product?->tax;
            $due = $invoice->total_amount;
            $subtotal = $due * 100 / (100 + $tax);
            $data = [
                'due' => $due,
                'tax' => $tax,
                'business_address' => $userdetails?->business_address . ', ' . $userdetails?->business_city . ', ' . $userdetails?->business_state . ', ' . $userdetails?->business_country,
                //                 'gst_number' =>$customer?->gst_no,
                'due_date' => Carbon::now()->format('d-m-Y'),
                'invoice_date' => $invoice->created_at->format('d-m-Y'),
                'invoiceId' => $invoice->id,
                'invoice_number' => $invoice->invoice_number,
                'subtotal' => $subtotal,
                'emi' => 0,
                'total_emis'=>1,
                'products' => $invoice->product_log,
                'product' => new \stdClass(),
                'status' => $invoice->status,
                'user' => $user,
                'userdetails' => $userdetails,
                'customer' => $invoice->customer,
                'gateway' => $gateway,
                'paid_by' => ($invoice->payments->last()?->gateway) ? $invoice->payments->last()->gateway : 'Offline',
            ];
        } else {
            $tax = $rinvoice->product->tax;
            $due = $rinvoice->emi_amount;
            $subtotal = $due * 100 / (100 + $tax);

            $emi = $rinvoice->paid_emis;
            $data = [
                'due' => $due,
                'tax' => $tax,
                'due_date' => $rinvoice->next_emi_date->format('d-m-Y'),
                'invoice_date' => Carbon::now()->format('d-m-Y'),
                'invoiceId' => 0,
                'invoice_number' => $invoiceService->generateInvoiceNumber(),
                'subtotal' => $subtotal,
                'emi' => $emi,
                'total_emis'=>$rinvoice->total_emis,
                'products' => [],
                'product' => $rinvoice->product,
                'status' => $rinvoice->status,
                'user' => $user,
                'userdetails' => $userdetails,
                'customer' => $rinvoice->customer,
                'gateway' => $gateway,
                'paid_by' => 'Pending',
            ];
        }

        return view('customer.subscriptions.invoice', compact('id', 'invoiceId', 'rinvoiceId', 'data', 'userdetails'));
    }

    public function paymentPage($id, $invoiceId, $rinvoiceId, $amount)
    {
        $gateway = PaymentGateway::where('user_id', $id)->firstOrNew();
        if ($gateway->stripe_active != 1 && $gateway->razorpay_active != 1)
            return redirect()->back()->with('error', 'At least one payment gateway should active to access sharable link.');

        $invoice = Invoice::find($invoiceId);
        $pendingAmount = 0;
        $customer = [];
        if (empty($invoice)) {
            $rinvoice = RecurringInvoice::find($rinvoiceId);
            $pendingAmount = $rinvoice->pending;
            $customer = $rinvoice->customer;
            if($rinvoice->total_emis < 0){
                if ($amount < $rinvoice->emi_amount || $amount > $rinvoice->emi_amount)
                    $amount = $rinvoice->emi_amount;
            }else{
                if ($amount < $rinvoice->emi_amount)
                    $amount = $rinvoice->emi_amount;
                if ($amount > $rinvoice->pending)
                    $amount = $rinvoice->pending;
            }
        } else {
            if ($amount != $invoice->total_amount)
                return redirect()->back()->with('error', 'Payment amount did not matched');
            $customer = $invoice->customer;
        }

        return view('customer.subscriptions.invoice_payment', compact('id', 'invoiceId', 'rinvoiceId', 'amount', 'gateway', 'customer','pendingAmount'));
    }

    public function stripeSuccess($id, $invoiceId, $rinvoiceId, Request $request, InvoiceService $invoiceService)
    {
        $invoice = Invoice::find($invoiceId);
        $amount = 0;
        $rinvoice = NULL;
        if (empty($invoice)) {
            $rinvoice = RecurringInvoice::find($rinvoiceId);
            $amount = $rinvoice->emi_amount;
        } else
            $amount = $invoice->total_amount;
        $gateway = PaymentGateway::where('user_id', $id)->first();
        \Stripe\Stripe::setApiKey($gateway->stripe_secret);
        $stripe = new \Stripe\StripeClient($gateway->stripe_secret);

        try {
            $paymentIntent = $stripe->paymentIntents->retrieve(
                $request->payment_intent,
                []
            );

            // Redirect if amount paid less then actual amount
            if (($paymentIntent->amount / 100) < ($amount - 1)) {
                return redirect()->route('invoices.payment.page', [
                    'id' => $id,
                    'invoiceId' => $invoiceId,
                    'rinvoiceId' => $rinvoiceId,
                    'amount' => $amount,
                ])->withInput($request->all())->with('error', 'Payment amount mismatch');
            }

            $alreadyPaid = Payment::where('transaction_id', $paymentIntent->id)->first();
            if (!empty($alreadyPaid))
                return redirect()->route('invoices.payment.page', [
                    'id' => $id,
                    'invoiceId' => $invoiceId,
                    'rinvoiceId' => $rinvoiceId,
                    'amount' => $amount,
                ])->withInput($request->all())->with('error', 'Cannot reload, Please try again');

            if (!empty($invoice)) {
                $payment = Payment::create([
                    'invoice_id' => $invoice->id,
                    'amount' => $paymentIntent->amount / 100,
                    'type' => 3,
                    'transaction_id' => $paymentIntent->id,
                    'payment_response' => json_encode($paymentIntent),
                    'gateway' => 'stripe'
                ]);
                $invoice->update(['status' => 1]);
            } else {
                $invoice = $rinvoice->invoices->last();
                if (empty($invoice)) {
                    return redirect()->route('invoices.payment.page', [
                        'id' => $id,
                        'invoiceId' => $invoiceId,
                        'rinvoiceId' => $rinvoiceId,
                        'amount' => $amount,
                    ])->withInput($request->all())->with('error', 'Invoice details not found');
                }
                // Store Details after payment success

                $invoiceData = [
                    'customer_id' => $invoice->customer_id,
                    'description' => $invoice->description,
                    'payment_method' => 3,
                    'invoice_number' => $invoiceService->generateInvoiceNumber(),
                    'total_amount' => $paymentIntent->amount / 100,
                    'status' => ($paymentIntent->status == "succeeded" ? 1 : 2),
                ];
                $invoice = Invoice::create($invoiceData);

                //Create Product Log and calculate total amount
                $productData = [];
                $total = 0;

                $product = Product::find($rinvoice->product_id);
                
                $payment = Payment::create([
                    'invoice_id' => $invoice->id,
                    'amount' => $paymentIntent->amount / 100,
                    'type' => 3,
                    'transaction_id' => $paymentIntent->id,
                    'payment_response' => json_encode($paymentIntent),
                    'gateway' => 'stripe'
                ]);

                $paid_amount = $paymentIntent->amount/100;
                $paid_emis = $rinvoice->paid_emis + 1;

                if ($rinvoice->total_emis < 0) {
                    $paid = $paid_amount;
                    $pending = 0;
                    $next_emi_date = $rinvoice->next_emi_date->add(1, $rinvoice->billed_at);
                    $status = 1;
                }else{
                    $pending = $rinvoice->pending - $paid_amount;
                    $next_emi_date = $rinvoice->next_emi_date->addDays('28')->format('Y-m-d');
                    if ($paid_amount > $rinvoice->emi_amount) {
                        $balance = $paid_amount - $rinvoice->emi_amount;

                        // pay another emi when balance amount is more
                        // if($balance > $rinvoice->emi_amount){
                        //     $emiCount = floor($balance/$rinvoice->emi_amount);
                        //     $paid_emis = $paid_emis + $emiCount;
                        // }

                        $due_emis = $rinvoice->total_emis - $paid_emis;
                        $emi_amount = $pending/$due_emis;
                        $rinvoice->update(['emi_amount' => $emi_amount]);
                    }
                }

                $rinvoice->update([
                    'paid' => $rinvoice->paid + $paid_amount,
                    'pending' => $pending,
                    'paid_date' => date('Y-m-d'),
                    'next_emi_date' => $next_emi_date,
                    'paid_emis' => $paid_emis,
                    'status' => (($pending < 0 || $pending == 0) ? 1 : 0)
                ]);
                $rinvoice->invoices()->attach($invoice->id);

                $productData[] = [
                    'product_id' => $product->id,
                    'invoice_id' => $invoice->id,
                    'name' => $product->name . '[' . ($rinvoice->paid_emis + 1) . ']',
                    'price' => $paymentIntent->amount / 100,
                    'qty' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $productLog = ProductLog::insert($productData);
            }
            $incomeData = $request->only([
                'date', 'income'
            ]);
            $incomeData['user_id'] = $id;
            $incomeData['invoice_id'] = $invoice->id;
            $incomeData['date'] = Carbon::now()->format('Y-m-d');
            $incomeData['income'] = $invoice->total_amount;
            $incomeData['description'] = 'Payment from Invoice';
            $incomeData['income_category_id'] = 1;
            $income = Income::create($incomeData);

            $user = User::where('id',$id)->first();

            $invoiceId = (!empty($rinvoice)?0:$invoice->id);
            $rinvoiceId = (!empty($rinvoice)?$rinvoice->id:0);

            if(!empty($invoice->customer))
                Mail::to($invoice->customer->email)->send(new LandingInvoiceMail($id, $invoiceId, $rinvoiceId));

            return view('customer.landing.thankyou', compact('id'))->with('success', 'Purchase Successful');
        } catch (\Exception $e) {
            return redirect()->route('landing.index', compact('id'))->withInput($request->all())->with('error', $e->getMessage());
        }
    }

    public function razorpaySuccess($id, $invoiceId, $rinvoiceId, Request $request, InvoiceService $invoiceService)
    {
        $invoice = Invoice::find($invoiceId);
        $amount = 0;

        $rinvoice = NULL;
        if (empty($invoice)) {
            $rinvoice = RecurringInvoice::find($rinvoiceId);
            $amount = $rinvoice->emi_amount;
        } else
            $amount = $invoice->total_amount;

        $gateway = PaymentGateway::where('user_id', $id)->first();
        $generated_signature = hash_hmac('sha256', $request->razorpay_order_id . "|" . $request->razorpay_payment_id, $gateway->razorpay_secret);

        $api = new Api($gateway->razorpay_key, $gateway->razorpay_secret);

        $razorpayment = $api->payment->fetch($request->razorpay_payment_id);

        $alreadyPaid = Payment::where('transaction_id', $razorpayment->id)->first();
        if (!empty($alreadyPaid))
            return redirect()->route('invoices.payment.page', [
                'id' => $id,
                'invoiceId' => $invoiceId,
                'rinvoiceId' => $rinvoiceId,
                'amount' => $amount,
            ])->withInput($request->all())->with('error', 'Cannot reload, Please try again');


        // Redirect if amount paid less then actual amount
        if (($razorpayment->amount / 100) < ($amount - 1)) {
            return redirect()->route('invoices.payment.page', [
                'id' => $id,
                'invoiceId' => $invoiceId,
                'rinvoiceId' => $rinvoiceId,
                'amount' => $amount,
            ])->withInput($request->all())->with('error', 'Payment amount mismatch');
        }

        if (!empty($invoice)) {
            $payment = Payment::create([
                'invoice_id' => $invoice->id,
                'amount' => $razorpayment->amount / 100,
                'type' => 3,
                'transaction_id' => $razorpayment->id,
                'payment_response' => json_encode($request->only([
                    'razorpay_payment_id',
                    'razorpay_order_id',
                    'razorpay_signature'
                ])),
                'gateway' => 'razorpay'
            ]);
            $invoice->update(['status' => 1]);
        } else {
            $invoice = $rinvoice->invoices->last();
            if (empty($invoice)) {
                return redirect()->route('invoices.payment.page', [
                    'id' => $id,
                    'invoiceId' => $invoiceId,
                    'rinvoiceId' => $rinvoiceId,
                    'amount' => $amount,
                ])->withInput($request->all())->with('error', 'Invoice details not found');
            }
            // Store Details after payment success

            $invoiceData = [
                'customer_id' => $invoice->customer_id,
                'description' => $invoice->description,
                'payment_method' => 3,
                'invoice_number' => $invoiceService->generateInvoiceNumber(),
                'total_amount' => $razorpayment->amount / 100,
                'status' => ($razorpayment->status == "captured" ? 1 : 2),
            ];
            $invoice = Invoice::create($invoiceData);

            //Create Product Log and calculate total amount
            $productData = [];
            $total = 0;

            $product = Product::find($rinvoice->product_id);

            $payment = Payment::create([
                'invoice_id' => $invoice->id,
                'amount' => $razorpayment->amount / 100,
                'type' => 3,
                'transaction_id' => $razorpayment->id,
                'payment_response' => json_encode($request->only([
                    'razorpay_payment_id',
                    'razorpay_order_id',
                    'razorpay_signature'
                ])),
                'gateway' => 'razorpay'
            ]);

            $paid_amount = $razorpayment->amount/100;
            $paid_emis = $rinvoice->paid_emis + 1;

            if ($rinvoice->total_emis < 0) {
                $paid = $paid_amount;
                $pending = 0;
                $next_emi_date = $rinvoice->next_emi_date->add(1, $rinvoice->billed_at);
                $status = 1;
            }else{
                $pending = $rinvoice->pending - $paid_amount;
                $next_emi_date = $rinvoice->next_emi_date->addDays('28')->format('Y-m-d');
                if ($paid_amount > $rinvoice->emi_amount) {
                    $balance = $paid_amount - $rinvoice->emi_amount;

                    // pay another emi when balance amount is more
                    // if($balance > $rinvoice->emi_amount){
                    //     $emiCount = floor($balance/$rinvoice->emi_amount);
                    //     $paid_emis = $paid_emis + $emiCount;
                    // }

                    $due_emis = $rinvoice->total_emis - $paid_emis;
                    $emi_amount = $pending/$due_emis;
                    $rinvoice->update(['emi_amount' => $emi_amount]);
                }
            }

            $rinvoice->update([
                'paid' => $rinvoice->paid + $paid_amount,
                'pending' => $pending,
                'paid_date' => date('Y-m-d'),
                'next_emi_date' => $next_emi_date,
                'paid_emis' => $paid_emis,
                'status' => (($pending < 0 || $pending == 0) ? 1 : 0)
            ]);
            $rinvoice->invoices()->attach($invoice->id);

            $productData[] = [
                'product_id' => $product->id,
                'invoice_id' => $invoice->id,
                'name' => $product->name . '[' . $paid_emis . ']',
                'price' => $razorpayment->amount / 100,
                'qty' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $productLog = ProductLog::insert($productData);
        }
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

        $user = User::where('id',$id)->first();

        $invoiceId = (!empty($rinvoice)?0:$invoice->id);
        $rinvoiceId = (!empty($rinvoice)?$rinvoice->id:0);

        if(!empty($invoice->customer))
            Mail::to($invoice->customer->email)->send(new LandingInvoiceMail($id, $invoiceId, $rinvoiceId));

        return view('customer.landing.thankyou', compact('id'))->with('success', 'Purchase Successful');
    }

    public function instamojoPayment(Request $request, $id, $invoiceId, $rinvoiceId, $amount)
    {
        $gateway = PaymentGateway::where('user_id', $id)->firstOrFail();
        $api = Instamojo::init('app', [
            "client_id" => $gateway->instamojo_key,
            "client_secret" => $gateway->instamojo_token
        ], config('instamojo.sandbox'));

        $customer = RecurringInvoice::findOrFail($rinvoiceId)?->customer;

        $url = url("/invoices/payment/{$id}/{$invoiceId}/{$rinvoiceId}/instamojo/success");

        if ($customer) {
            try {
                $response = $api->createGatewayOrder(array(
                    "name" => $customer->name,
                    "email" => $customer->email,
                    "phone" => $customer->phone_no,
                    "amount" => $request->payable_amount,
                    "transaction_id" => md5(rand(000000, 11111111) + time()),
                    'redirect_url' => $url,
                    "currency" => "INR"
                ));

                if ($response) {
                    return redirect($response['payment_options']['payment_url']);
                }
            } catch (\Exception $e) {
                dd($e);
                return back();
            }
        }
    }

    public function instamojoSuccess(Request $request, $id, $invoiceId, $rinvoiceId, InvoiceService $invoiceService)
    {
        $gateway = PaymentGateway::where('user_id', $id)->firstOrFail();
        $api = Instamojo::init('app', [
            "client_id" => $gateway->instamojo_key,
            "client_secret" => $gateway->instamojo_token
        ], config('instamojo.sandbox'));


        $invoice = Invoice::find($invoiceId);
        $amount = 0;

        $rinvoice = NULL;
        if (empty($invoice)) {
            $rinvoice = RecurringInvoice::find($rinvoiceId);
            $amount = $rinvoice->emi_amount;
        } else
            $amount = $invoice->total_amount;


        $api = Instamojo::init('app', [
            "client_id" => $gateway->instamojo_key,
            "client_secret" => $gateway->instamojo_token
        ], config('instamojo.sandbox'));

        $response = $api->getPaymentRequestDetails($request->id);

        $alreadyPaid = Payment::where('transaction_id', $response['id'])->first();

        if (!empty($alreadyPaid))
            return redirect()->route('invoices.payment.page', [
                'id' => $id,
                'invoiceId' => $invoiceId,
                'rinvoiceId' => $rinvoiceId,
                'amount' => $amount,
            ])->withInput($request->all())->with('error', 'Cannot reload, Please try again');


        // Redirect if amount paid less then actual amount
        if ((float)$response['amount'] < ($amount - 1)) {
            return redirect()->route('invoices.payment.page', [
                'id' => $id,
                'invoiceId' => $invoiceId,
                'rinvoiceId' => $rinvoiceId,
                'amount' => $amount,
            ])->withInput($request->all())->with('error', 'Payment amount mismatch');
        }

        if (!empty($invoice)) {
            $payment = Payment::create([
                'invoice_id' => $invoice->id,
                'amount' => (float)$response['amount'],
                'type' => 3,
                'transaction_id' => $request->id,
                'payment_response' => json_encode($response),
                'gateway' => 'instamojo'
            ]);
            $invoice->update(['status' => 1]);
        } else {
            $invoice = $rinvoice->invoices->last();
            if (empty($invoice)) {
                return redirect()->route('invoices.payment.page', [
                    'id' => $id,
                    'invoiceId' => $invoiceId,
                    'rinvoiceId' => $rinvoiceId,
                    'amount' => $amount,
                ])->withInput($request->all())->with('error', 'Invoice details not found');
            }
            // Store Details after payment success

            $invoiceData = [
                'customer_id' => $invoice->customer_id,
                'description' => $invoice->description,
                'payment_method' => 3,
                'invoice_number' => $invoiceService->generateInvoiceNumber(),
                'total_amount' => (float)$response['amount'],
                'status' => ($response['status'] == "Completed" ? 1 : 2),
            ];
            $invoice = Invoice::create($invoiceData);

            //Create Product Log and calculate total amount
            $productData = [];
            $total = 0;

            $product = Product::find($rinvoice->product_id);

            $payment = Payment::create([
                'invoice_id' => $invoice->id,
                'amount' => (float)$response['amount'],
                'type' => 3,
                'transaction_id' => $request->id,
                'payment_response' => json_encode($response),
                'gateway' => 'instamojo'
            ]);

            $paid_amount = (float)$response['amount'];
            $paid_emis = $rinvoice->paid_emis + 1;

            if ($rinvoice->total_emis < 0) {
                $paid = $paid_amount;
                $pending = 0;
                $next_emi_date = $rinvoice->next_emi_date->add(1, $rinvoice->billed_at);
                $status = 1;
            }else{
                $pending = $rinvoice->pending - $paid_amount;
                $next_emi_date = $rinvoice->next_emi_date->addDays('28')->format('Y-m-d');
                if ($paid_amount > $rinvoice->emi_amount) {
                    $balance = $paid_amount - $rinvoice->emi_amount;

                    // pay another emi when balance amount is more
                    // if($balance > $rinvoice->emi_amount){
                    //     $emiCount = floor($balance/$rinvoice->emi_amount);
                    //     $paid_emis = $paid_emis + $emiCount;
                    // }

                    $due_emis = $rinvoice->total_emis - $paid_emis;
                    $emi_amount = $pending/$due_emis;
                    $rinvoice->update(['emi_amount' => $emi_amount]);
                }
            }

            $rinvoice->update([
                'paid' => $rinvoice->paid + $paid_amount,
                'pending' => $pending,
                'paid_date' => date('Y-m-d'),
                'next_emi_date' => $next_emi_date,
                'paid_emis' => $paid_emis,
                'status' => (($pending < 0 || $pending == 0) ? 1 : 0)
            ]);
            $rinvoice->invoices()->attach($invoice->id);

            // PRODUCT LOG
            $productData[] = [
                'product_id' => $product->id,
                'invoice_id' => $invoice->id,
                'name' => $product->name . '[' . $paid_emis . ']',
                'price' => (float)$response['amount'],
                'qty' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $productLog = ProductLog::insert($productData);
        }

        //        $incomeData['invoice_id'] = $customer->id;
        $incomeData['user_id'] = auth()->id();
        $incomeData['invoice_id'] = $invoice->id;
        $incomeData['date'] = Carbon::now()->format('Y-m-d');
        $incomeData['income'] = $invoice->total_amount;
        $incomeData['description'] = 'Payment from Invoice';
        $incomeData['income_category_id'] = 1;
        $income = Income::create($incomeData);

        $user = User::where('id',$id)->first();

        $invoiceId = (!empty($rinvoice)?0:$invoice->id);
        $rinvoiceId = (!empty($rinvoice)?$rinvoice->id:0);

        if(!empty($invoice->customer))
            Mail::to($invoice->customer->email)->send(new LandingInvoiceMail($id, $invoiceId, $rinvoiceId));

        return view('customer.landing.thankyou', compact('id'))->with('success', 'Purchase Successful');
    }

    public function userDetails(Request $request,$customers){
        $input = $request->all();
        $customer = Customer::where('user_id',auth()->id())->get(['id'])->pluck('id')->toArray();
        $invoices = Invoice::with(['customer','payments'])
            ->sortable()
//            ->where('payment_method','>',0)
            ->where('customer_id',$customers)
            ->when(request('search'),function($q) use($customers){
                $q->where(function($q2){
                    $q2->where('invoice_number', 'LIKE', '%' . request('search').'%')
                        ->orWhere('total_amount','LIKE','%'.request('search').'%')
                         ->orWhereHas('customer',function($q3){
                            $q3->where('gst_no','LIKE','%'.request('search').'%');
                        })
                        ->orWhereHas('payments',function($q4){
                            $q4->where('gateway','LIKE','%'.request('search').'%');
                        });
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

        return view('customer.subscriptions.user_detail',compact('invoices','rinvoices','customer_data'));
    }

}


