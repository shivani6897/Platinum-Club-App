<?php

namespace App\Services\Payment;
use App\Mail\LandingInvoiceMail;
use App\Models\Invoice;
use App\Models\UserDetail;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductLog;
use App\Models\Payment;
use App\Models\RecurringInvoice;
use App\Models\User;
use App\Models\Income;
use Carbon\Carbon;
use Mail;

class InvoiceService {

    public function generateInvoiceNumber($id)
    {
        $user_deatils = UserDetail::where('user_id',$id)->first();
        $user = User::find($id);
        $invoicecount = Invoice::whereYear('created_at', date('Y'))->count();
        $invoicecount = strlen($invoicecount) == 1 ?  '0'.$invoicecount+1 : $invoicecount+1;

        $invoice_number = (!empty($user_deatils) && !empty($user_deatils->business_name)) ? strtoupper(substr($user_deatils->business_name , 0, 3)).date('Y').$invoicecount : strtoupper(substr($user->first_name , 0, 3)).date('Y').$invoicecount;

        return $invoice_number;
    }

    public static function create($id,$request,$invoiceAmount,$paymentStatus,$trnId,$paymentResponse,$gateway,$productIds)
    {
        $invoiceService = new InvoiceService();

        $customer = Customer::updateOrCreate([
            'user_id' => $id,
            'phone_no' => $request->phone_no
        ], [
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'state' => '',
        ]);

        // Store Details after payment success
        $invoice = Invoice::create([
            'user_id' => $id,
            'customer_id' => $customer->id,
            'invoice_number' => $invoiceService->generateInvoiceNumber($id),
            'total_amount' => $invoiceAmount,
            'payment_method' => 3,
            'status' => $paymentStatus,
        ]);

        //Create Product Log and calculate total amount
        $productData = [];
        $total = 0;
        $products = Product::whereIn('id',$productIds)->get();
        if(empty($products))
        {
            $invoice->delete();
            return false;
        }
        $product = $products[0];
        $products = $products->keyBy('id');

        foreach($productIds as $pid)
        {
            $productData[] = [
                'product_id' => $products[$pid]->id,
                'invoice_id' => $invoice->id,
                'name' => $products[$pid]->name,
                'price' => $products[$pid]->price,
                'qty' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $productLog = ProductLog::insert($productData);

        $payment = Payment::create([
            'invoice_id' => $invoice->id,
            'amount' => $invoiceAmount,
            'type' => 3,
            'transaction_id' => $trnId,
            'payment_response' => $paymentResponse,
            'gateway' => $gateway
        ]);

        $rinvoice = NULL;
        // Only run is recursive invoice required 
        // Cases: Free trial | Payment Type EMI | Subscription Based Product
        if ($request->is_free_trial || $request->payment_type == 1 || $product->is_subscription) 
        {

            $defaultData = [
                'user_id' => $id,
                'customer_id' => $customer->id,
                'product_id' => $product->id,
            ];

            $paid = 0;
            $downpayment = 0;
            $pending = $product->price;
            $billed_at = null;
            if($request->is_free_trial){
                $is_free_trial = true;
                $trial_price = $product->trial_price;
                $paid += $product->trial_price;
                $total_emis = 1;
                $emi_amount = $product->price;
                $next_emi_date = Carbon::now()->add($product->trial_duration,$product->trial_duration_type);
            }else{
                $is_free_trial = false;
                $trial_price = 0;
                $next_emi_date = Carbon::now()->addDays(28)->format('Y-m-d');
            }

            if ($request->payment_type == 1) {
                $emi_amount = round(($product->price - $request->downpayment) / $request->emi, 2);
                $downpayment = $request->downpayment;
                $paid += $request->downpayment;
                $pending -= $request->downpayment;
                $total_emis = $request->emi;
            }

            if($product->is_subscription){
                $total_emis = -1;
                $emi_amount = $product->price;
                $pending = !$request->is_free_trial ? 0 : $pending;
                $billed_at = $product->billing_period;
                $paid = !$request->is_free_trial ? $product->price : $product->trial_price;
            }

            $rData = [
                'is_free_trial' => $is_free_trial,
                'trial_price' => $trial_price,
                'downpayment' => $downpayment,
                'paid' => $paid,
                'pending' => $pending,
                'emi_amount' => $emi_amount,
                'next_emi_date' => $next_emi_date,
                'paid_date' => Carbon::now()->format('Y-m-d'),
                'total_emis' => $total_emis,
                'billed_at' => $billed_at
            ];  

            $rinvoiceData = array_merge($defaultData,$rData);
            $rinvoice = RecurringInvoice::create($rinvoiceData);
            $rinvoice->invoices()->attach($invoice->id);
        }
        
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

        return true;
    }
}