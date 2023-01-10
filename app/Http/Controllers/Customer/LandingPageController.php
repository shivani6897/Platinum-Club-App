<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use App\Mail\LandingInvoiceMail;
use App\Models\Income;
use App\Models\User;
use App\Models\PromoCode;
use App\Models\UserDetail;
use App\Services\Payment\InstamojoService;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\Payment\StripeService;
use App\Services\Payment\RazorpayService;
use App\Services\Payment\InvoiceService;
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
use Mail;


class LandingPageController extends Controller
{
    public function index($id)
    {
        $products = Product::where('user_id', $id)->get();
        $selectedProduct = Product::where('user_id', $id)->first();
        if (count($products) == 0)
            return redirect()->back()->with('error', 'Please add products to generate sharable link');
        $gateway = PaymentGateway::where('user_id', $id)->firstOrNew();

        if(isset($request->code)){
            $promoCode = PromoCode::where('promo_code',$request->code)
            ->where('start_date','<=',Carbon::today())
            ->where('end_date','>=',Carbon::today())
            ->first();

            if($promoCode){
                return response->json(['message'=> 'Coupon Code applied', 'status'=>'success']);
            }
            else{
                return response->json(['message'=> 'Coupon Code doesnot exists', 'status'=>'error']);

            }
        }
        if ($gateway->stripe_active != 1 && $gateway->razorpay_active != 1 && $gateway->instamojo_active != 1)
            return redirect()->back()->with('error', 'At least one payment gateway should active to access sharable link.');

        return view('customer.landing.index', compact('products', 'id', 'selectedProduct', 'gateway'));
    }

    public function payInstamojo(Request $request, $id, InvoiceService $invoiceService)
    {
        if($request->gateway){
            $gateway = PaymentGateway::where('user_id', $id)->firstOrFail();
            $product = Product::findOrFail($request->product_id);
            try {
                $redirectUrl = InstamojoService::process($request, $id, $gateway, $product);
                return redirect($redirectUrl);
            } catch (\Exception $e) {
                return back();
            }
        }else{
            try{
                $customer = Customer::updateOrCreate([
                    'user_id' => $id,
                    'phone_no' => $request->phone_no,
                ], [
                    'name' => $request->first_name . ' ' . $request->last_name,
                    'email' => $request->email,
                    'state' => '',
                ]);

                // Store Details after payment success
                $invoiceData = $request->only([
                    'customer_id',
                    'description',
                    'payment_method'
                ]);
                $invoiceData['customer_id'] = $customer->id;
                $invoiceData['invoice_number'] = $invoiceService->generateInvoiceNumber($id);
                $invoiceData['total_amount'] = 0;
                $invoiceData['payment_method'] = 0;
                $invoiceData['status'] = 1;
                $invoice = Invoice::create($invoiceData);

                //Create Product Log and calculate total amount
                $productData = [];
                $total = 0;

                $product = Product::find($request->product_id);
                $productData[] = [
                    'product_id' => $product->id,
                    'invoice_id' => $invoice->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'qty' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $productLog = ProductLog::insert($productData);

                $defaultData = [
                    'user_id' => $id,
                    'customer_id' => $customer->id,
                    'product_id' => $product->id,
                    'downpayment' => $request->downpayment,
                ];

                $freeTrialData = $this->freeTrialData($product,$request);

                if ($request->payment_type == 1) { 
                    $emi = round(($product->price - $request->downpayment) / $request->emi, 2);
                    $rData = [
                        'pending' => $product->price - $request->downpayment,
                        'emi_amount' => $emi,
                        'total_emis' => $request->emi
                    ];
                }else{
                    $rData = [
                        'pending' => $product->price,
                        'emi_amount' => $product->price,
                        'total_emis' => 1
                    ];
                }
                $rinvoiceData = array_merge($defaultData,$freeTrialData,$rData);
                $rinvoice = RecurringInvoice::create($rinvoiceData);
                $rinvoice->invoices()->attach($invoice->id);
                
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

                Mail::to($customer->email)->send(new LandingInvoiceMail($id, $invoiceId, $rinvoiceId));

                return view('customer.landing.thankyou', compact('id'))->with('success', 'Purchase Successful');
            }catch(Exception $e){
                return redirect()->route('landing.index', compact('id'))->withInput($request->all())->with('error', $e->getMessage());
            }
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
            return redirect()->route('landing.index', compact('id'))->withInput($request->all())->with('error', $e->getMessage());
        }
    }

    public function getProduct($id, Product $product)
    {
        if ($product->is_free_trial == 1){
            if ($product->trial_price != 0){
                $trial_msg = 'Rs '.$product->trial_price." will be charge for trial period.";
            }else{
                $trial_msg = "You will not be charged until your trial ends.";
            }
            $trial_msg = $trial_msg.' Your trial period ends after <b>'.$product->trial_duration.' '.$product->trial_duration_type.'</b>';
        }else{
            $trial_msg = '';
        }
        $json = [
            'id'=>$product->id,
            'name'=>$product->name,
            'price'=>$product->price,
            'image'=>$product->image,
            'description'=>$product->description,
            'downpayment'=>$product->downpayment,
            'emi'=>$product->emi,
            'tax'=>$product->tax,
            'is_free_trial'=>$product->is_free_trial,
            'trial_duration_type'=>$product->trial_duration_type,
            'trial_duration'=>$product->trial_duration,
            'trial_price'=>$product->trial_price,
            'trial_msg'=>$trial_msg,
            'is_subscription'=>$product->is_subscription,
            'billing_period'=>$product->billing_period
        ];

        return response()->json(['status' => 1, 'message' => 'Data retrived', 'data' => $json]);
    }

    public function stripePaymentIntent($id, $amount)
    {
        $gateway = PaymentGateway::where('user_id', $id)->first();
        $stripe = new StripeService($gateway->stripe_secret, $gateway->stripe_public);
        return $stripe->paymentIntent($amount, explode('_secret_', request('paymentIntent', ''))[0]);
    }

    public function stripeSuccess($id, Request $request, InvoiceService $invoiceService)
    {
        $gateway = PaymentGateway::where('user_id', $id)->first();
        \Stripe\Stripe::setApiKey($gateway->stripe_secret);
        $stripe = new \Stripe\StripeClient($gateway->stripe_secret);

        // try {
            $paymentIntent = $stripe->paymentIntents->retrieve(
                $request->payment_intent,
                []
            );
            $alreadyPaid = Payment::where('transaction_id', $paymentIntent->id)->first();
            if (!empty($alreadyPaid)){
                return redirect()->route('landing.index', compact('id'))->withInput($request->all())->with('error', 'Cannot reload, please try again');
            }

            $flg = InvoiceService::create(
                $id,
                $request,
                ($paymentIntent->amount / 100),
                ($paymentIntent->status == "succeeded" ? 1 : 2),
                $paymentIntent->id,
                json_encode($paymentIntent),
                'stripe',
                [$request->product_id],
            );

            if($flg)
                return view('customer.landing.thankyou', compact('id'))->with('success', 'Purchase Successful');
            else
                return redirect()->route('landing.index', compact('id'))->withInput($request->all())->with('error', $e->getMessage());
        // } catch (\Exception $e) {
        //     return redirect()->route('landing.index', compact('id'))->withInput($request->all())->with('error', $e->getMessage());
        // }
    }

    public function razorpayCreateOrder($id, $amount)
    {
        $gateway = PaymentGateway::where('user_id', $id)->first();
        $razorpay = new RazorpayService($gateway->razorpay_key, $gateway->razorpay_secret);
        $order = $razorpay->createOrder($amount, request('email', ''), request('payment_type', 0));
        return response()->json(['status' => 1, 'message' => 'success', 'order_id' => $order->id]);
    }

    public function razorpaySuccess($id, Request $request, InvoiceService $invoiceService)
    {
        $gateway = PaymentGateway::where('user_id', $id)->first();
        $generated_signature = hash_hmac('sha256', $request->razorpay_order_id . "|" . $request->razorpay_payment_id, $gateway->razorpay_secret);
        $api = new Api($gateway->razorpay_key, $gateway->razorpay_secret);
        $razorpayment = $api->payment->fetch($request->razorpay_payment_id);

        $alreadyPaid = Payment::where('transaction_id', $razorpayment->id)->first();
        if (!empty($alreadyPaid))
            return redirect()->route('landing.index', compact('id'))->withInput($request->all())->with('error', 'Cannot reload, please try again');

        if ($generated_signature == $request->razorpay_signature) {

            $flg = InvoiceService::create(
                $id,
                $request,
                ($razorpayment->amount / 100),
                ($razorpayment->status == "captured" ? 1 : 2),
                $razorpayment->id,
                json_encode($request->only([
                    'razorpay_payment_id',
                    'razorpay_order_id',
                    'razorpay_signature'
                ])),
                'razorpay',
                [$request->product_id],
            );
            
            if($flg)
                return view('customer.landing.thankyou', compact('id'))->with('success', 'Purchase Successful');
            else
                return redirect()->route('landing.index', compact('id'))->withInput($request->all())->with('error', $e->getMessage());
        } else {
            return redirect()->route('landing.index', compact('id'))->withInput($request->all())->with('error', 'Error while paying with razorpay, signature did not matched.');
        }
    }
}
