<?php

namespace App\Services\Payment;

use App\Models\Customer;
use App\Models\Income;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\PaymentGateway;
use App\Models\Product;
use App\Models\ProductLog;
use App\Models\RecurringInvoice;
use App\Services\Utilities\QueryStringParser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Instamojo\Instamojo;

final class InstamojoService
{
    public static function process(Request $request, $id, PaymentGateway $gateway, Product $product)
    {
        $api = self::getApi($gateway);

        $url = url("landing/{$id}/{$product->id}/instamojo/success");

        try {
            $response = $api->createGatewayOrder(array(
                "name" => $request->first_name . " " . $request->last_name,
                "email" => $request->email,
                "phone" => $request->phone_no,
                "amount" => $request->payment_type == '0' ? $product->price : $request->downpayment,
                "transaction_id" => md5(rand(000000, 11111111) + time()), /**transaction_id is unique Id**/
                "currency" => "INR",
                'redirect_url' => $url . "?downpayment={$request->downpayment}&payment_type={$request->payment_type}&emi={$request->emi}"
            ));
            if ($response) {
                return $response['payment_options']['payment_url'];
            }
        } catch (\Exception $e) {
            throw new \Exception("Something went wrong");
        }
    }

    public static function success(Request $request, $id, $gateway, $product)
    {
        $api = self::getApi($gateway);
        $response = $api->getPaymentRequestDetails($request->id);

        $url = $response['redirect_url'];
        $url_components = parse_url($url, PHP_URL_QUERY);
        $requestQuery = QueryStringParser::parse($url_components);


        $alreadyPaid = Payment::where('transaction_id', $request->id)->first();
        if (!empty($alreadyPaid))
            return redirect()->route('landing.index', compact('id'))->withInput($request->all())->with('error', 'Cannot reload, please try again');

        $customer = Customer::updateOrCreate([
            'user_id' => $id,
            'email' => $response['email'],
        ], [
            'name' => $response['buyer_name'],
            'phone_no' => $response['phone'],
            'state' => '',
        ]);
        // Store Details after payment success

        $invoiceData['customer_id'] = $customer->id;
        $invoiceData['invoice_number'] = date('Ymd') . rand(10000, 99999);
        $invoiceData['total_amount'] = $response['amount'];
        $invoiceData['payment_method'] = 3;
        $invoiceData['status'] = ($response['status'] == "Completed" ? 1 : 2);
        $invoice = Invoice::create($invoiceData);

        //Create Product Log and calculate total amount
        $productData = [];
        $total = 0;

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

        $payment = Payment::create([
            'invoice_id' => $invoice->id,
            'amount' => $response['amount'],
            'type' => 3,
            'transaction_id' => $request->id,
            'payment_response' => json_encode($response),
            'gateway' => 'instamojo'
        ]);

        if ($requestQuery['payment_type'] == 1) {
            $emi = round(($product->price - ((float)$requestQuery['downpayment'])) / (int)$requestQuery['emi'], 2);
            $rinvoiceData = [
                'user_id' => $id,
                'customer_id' => $customer->id,
                'product_id' => $product->id,
                'downpayment' => ((float)$requestQuery['downpayment']),
                'paid' => ((float)$requestQuery['downpayment']),
                'pending' => $product->price - ((float)$requestQuery['downpayment']),
                'emi_amount' => $emi,
                'paid_date' => Carbon::now()->format('Y-m-d'),
                'next_emi_date' => Carbon::now()->addDays(28)->format('Y-m-d'),
                'total_emis' => (int)$requestQuery['emi']
            ];
            $rinvoice = RecurringInvoice::create($rinvoiceData);

            $rinvoice->invoices()->attach($invoice->id);
        }

        $incomeData['user_id'] = auth()->id();
        $incomeData['invoice_id'] = $invoice->id;
        $incomeData['date'] = Carbon::now()->format('Y-m-d');
        $incomeData['income'] = $invoice->total_amount;
        $incomeData['description'] = 'Payment from Invoice';
        $incomeData['income_category_id'] = 1;

        Income::create($incomeData);
    }

    /**
     * @param $gateway
     * @return Instamojo
     */
    private static function getApi($gateway): Instamojo
    {
        return Instamojo::init('app', [
            "client_id" => $gateway->instamojo_key,
            "client_secret" => $gateway->instamojo_token,
        ], config('instamojo.sandbox'));
    }
}
