<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Services\Payment\InstamojoService;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\Payment\StripeService;
use App\Services\Payment\RazorpayService;
use App\Models\RecurringInvoice;
use App\Models\Invoice;
use App\Models\RecurringInvoiceInvoice;
use App\Models\ProductLog;
use App\Models\Payment;
use App\Models\Customer;
use Carbon\Carbon;
use Instamojo\Instamojo;
use Razorpay\Api\Api;
use App\Models\PaymentGateway;


class LandingPageController extends Controller
{
    public function index($id)
    {
        $products = Product::where('user_id', $id)->get();
        $selectedProduct = Product::where('user_id', $id)->first();
        if (count($products) == 0)
            return redirect()->back()->with('error', 'Please add products to generate sharable link');
        $gateway = PaymentGateway::where('user_id', $id)->firstOrNew();
        if ($gateway->stripe_active != 1 && $gateway->razorpay_active != 1)
            return redirect()->back()->with('error', 'At least one payment gateway should active to access sharable link.');

        return view('customer.landing.index', compact('products', 'id', 'selectedProduct', 'gateway'));
    }

    public function payInstamojo(Request $request, $id)
    {
        $gateway = PaymentGateway::where('user_id', $id)->firstOrFail();
        $product = Product::findOrFail($request->product_id);
        try {
            $redirectUrl = InstamojoService::process($request, $id, $gateway, $product);
            return redirect($redirectUrl);
        } catch (\Exception $e) {
            return back();
        }
    }

    public function instamojoSuccess(Request $request, $id, $product_id)
    {
        $gateway = PaymentGateway::where('user_id', $id)->firstOrFail();
        $product = Product::findOrFail($request->product_id);
        try {
            InstamojoService::success($request, $id, $gateway, $product);
            return view('customer.landing.thankyou', compact('id'))->with('success', 'Purchase Successful');
        } catch (\Exception $e) {
            dd($e);
            return redirect('/');
        }
    }

    public function getProduct($id, Product $product)
    {
        $json = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image,
            'description' => $product->description,
            'downpayment' => $product->downpayment,
            'emi' => $product->emi,
            'tax' => $product->tax
        ];

        return response()->json(['status' => 1, 'message' => 'Data retrived', 'data' => $json]);
    }

    public function stripePaymentIntent($id, $amount)
    {
        $gateway = PaymentGateway::where('user_id', $id)->first();
        $stripe = new StripeService($gateway->stripe_secret, $gateway->stripe_public);
        return $stripe->paymentIntent($amount, explode('_secret_', request('paymentIntent', ''))[0]);
    }

    public function stripeSuccess($id, Request $request)
    {
        $gateway = PaymentGateway::where('user_id', $id)->first();
        \Stripe\Stripe::setApiKey($gateway->stripe_secret);
        $stripe = new \Stripe\StripeClient($gateway->stripe_secret);

        try {
            $paymentIntent = $stripe->paymentIntents->retrieve(
                $request->payment_intent,
                []
            );

            $alreadyPaid = Payment::where('transaction_id', $paymentIntent->id)->first();
            if (!empty($alreadyPaid))
                return redirect()->route('landing.index', compact('id'))->withInput($request->all())->with('error', 'Cannot reload, please try again');

            $customer = Customer::updateOrCreate([
                'user_id' => $id,
                'email' => $request->email,
            ], [
                'name' => $request->first_name . ' ' . $request->last_name,
                'phone_no' => $request->phone_no,
                'state' => '',
            ]);
            // Store Details after payment success

            $invoiceData = $request->only([
                'customer_id',
                'description',
                'payment_method'
            ]);
            $invoiceData['customer_id'] = $customer->id;
            $invoiceData['invoice_number'] = date('Ymd') . rand(10000, 99999);
            $invoiceData['total_amount'] = $paymentIntent->amount / 100;
            $invoiceData['payment_method'] = 3;
            $invoiceData['status'] = ($paymentIntent->status == "succeeded" ? 1 : 2);
            $invoice = Invoice::create($invoiceData);

            //Create Product Log and calculate total amount
            $productData = [];
            $total = 0;

            $product = Product::find($request->product_id);

            // foreach($request->product_id as $key => $product_id)
            // {
            $productData[] = [
                'product_id' => $product->id,
                'invoice_id' => $invoice->id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            // $total += ($request->product_price[$key]*$request->product_qty[$key]);
            // }

            $productLog = ProductLog::insert($productData);

            $payment = Payment::create([
                'invoice_id' => $invoice->id,
                'amount' => $paymentIntent->amount / 100,
                'type' => 3,
                'transaction_id' => $paymentIntent->id,
                'payment_response' => json_encode($paymentIntent),
                'gateway' => 'stripe'
            ]);

            if ($request->payment_type == 1) {
                $product = Product::find($request->product_id);
                $emi = round(($product->price - $request->downpayment) / $request->emi, 2);
                $rinvoiceData = [
                    'user_id' => $id,
                    'customer_id' => $customer->id,
                    'product_id' => $product->id,
                    'downpayment' => $request->downpayment,
                    'paid' => $request->downpayment,
                    'pending' => $product->price - $request->downpayment,
                    'emi_amount' => $emi,
                    'paid_date' => Carbon::now()->format('Y-m-d'),
                    'next_emi_date' => Carbon::now()->addDays(28)->format('Y-m-d'),
                    'total_emis' => $request->emi
                ];
                $rinvoice = RecurringInvoice::create($rinvoiceData);

                $rinvoice->invoices()->attach($invoice->id);
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

            return view('customer.landing.thankyou', compact('id'))->with('success', 'Purchase Successful');
        } catch (\Exception $e) {
            return redirect()->route('landing.index', compact('id'))->withInput($request->all())->with('error', $e->getMessage());
        }
    }

    public function razorpayCreateOrder($id, $amount)
    {
        $gateway = PaymentGateway::where('user_id', $id)->first();
        $razorpay = new RazorpayService($gateway->razorpay_key, $gateway->razorpay_secret);
        $order = $razorpay->createOrder($amount, request('email', ''), request('payment_type', 0));
        return response()->json(['status' => 1, 'message' => 'success', 'order_id' => $order->id]);
    }

    public function razorpaySuccess($id, Request $request)
    {
        $gateway = PaymentGateway::where('user_id', $id)->first();
        $generated_signature = hash_hmac('sha256', $request->razorpay_order_id . "|" . $request->razorpay_payment_id, $gateway->razorpay_secret);

        $api = new Api($gateway->razorpay_key, $gateway->razorpay_secret);

        $razorpayment = $api->payment->fetch($request->razorpay_payment_id);

        $alreadyPaid = Payment::where('transaction_id', $razorpayment->id)->first();
        if (!empty($alreadyPaid))
            return redirect()->route('landing.index', compact('id'))->withInput($request->all())->with('error', 'Cannot reload, please try again');

        if ($generated_signature == $request->razorpay_signature) {

            $customer = Customer::updateOrCreate([
                'user_id' => $id,
                'email' => $request->email,
            ], [
                'name' => $request->first_name . ' ' . $request->last_name,
                'phone_no' => $request->phone_no,
                'state' => '',
            ]);
            // Store Details after payment success

            $invoiceData = $request->only([
                'customer_id',
                'description',
                'payment_method'
            ]);
            $invoiceData['customer_id'] = $customer->id;
            $invoiceData['invoice_number'] = date('Ymd') . rand(10000, 99999);
            $invoiceData['total_amount'] = $razorpayment->amount / 100;
            $invoiceData['payment_method'] = 3;
            $invoiceData['status'] = ($razorpayment->status == "captured" ? 1 : 2);
            $invoice = Invoice::create($invoiceData);

            //Create Product Log and calculate total amount
            $productData = [];
            $total = 0;

            $product = Product::find($request->product_id);

            // foreach($request->product_id as $key => $product_id)
            // {
            $productData[] = [
                'product_id' => $product->id,
                'invoice_id' => $invoice->id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            // $total += ($request->product_price[$key]*$request->product_qty[$key]);
            // }

            $productLog = ProductLog::insert($productData);

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

            if ($request->payment_type == 1) {
                $product = Product::find($request->product_id);
                $emi = round(($product->price - $request->downpayment) / $request->emi, 2);
                $rinvoiceData = [
                    'user_id' => $id,
                    'customer_id' => $customer->id,
                    'product_id' => $product->id,
                    'downpayment' => $request->downpayment,
                    'paid' => $request->downpayment,
                    'pending' => $product->price - $request->downpayment,
                    'emi_amount' => $emi,
                    'paid_date' => Carbon::now()->format('Y-m-d'),
                    'next_emi_date' => Carbon::now()->addDays(28)->format('Y-m-d'),
                    'total_emis' => $request->emi
                ];
                $rinvoice = RecurringInvoice::create($rinvoiceData);

                $rinvoice->invoices()->attach($invoice->id);
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

            return view('customer.landing.thankyou', compact('id'))->with('success', 'Purchase Successful');
        } else {
            return redirect()->route('landing.index', compact('id'))->withInput($request->all())->with('error', 'Error while paying with razorpay, signature did not matched.');
        }
    }
}
