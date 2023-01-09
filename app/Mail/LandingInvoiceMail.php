<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use App\Models\RecurringInvoice;
use App\Models\Invoice;
use App\Models\User;
use App\Models\PaymentGateway;
use App\Models\UserDetail;
use App\Models\Customer;

use App\Services\Payment\InvoiceService;
use Carbon\Carbon;

class LandingInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;
    // public $userdetails, $user,$customer,$productData, $products,$subtotal,$emi,$tax,$due;
    private $userId, $invoiceId, $rinvoiceId, $invoiceService;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct ($userId, $invoiceId, $rinvoiceId)
    // ($invoiceData,$userdetails, $user,$customer,$products,$productData,$subtotal,$tax,$due)
//    public function __construct($invoiceData,$userdetails, $user,$customer,$products,$productData,$subtotal,$emi,$tax,$due)
    {
        $this->userId = $userId;
        $this->invoiceId = $invoiceId;
        $this->rinvoiceId = $rinvoiceId;
        $this->invoiceService = new InvoiceService();
//         $this->invoiceData = $invoiceData;
//         $this->customer = $customer;
//         $this->userdetails = $userdetails;
//         $this->user = $user;
//         $this->products = $products;
//         $this->productData = $productData;
//         $this->subtotal = $subtotal;
// //        $this->emi = $emi;
//         $this->tax = $tax;
//         $this->due = $due;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Invoice Mail',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        $rinvoice = RecurringInvoice::find($this->rinvoiceId);
        $invoice = Invoice::find($this->invoiceId);
        $user = User::find($this->userId);
        $gateway = PaymentGateway::where('user_id', $user->id)->firstOrNew();
        $userdetails = UserDetail::where('user_id', $user->id)->first();

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
                'invoice_number' => $this->invoiceService->generateInvoiceNumber(),
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

        return new Content(
            view: 'emails.invoice',
            // view: 'emails.landing_invoice',
            with: [
                    'data'=>$data,
                    'id'=>$this->userId,
                    'invoiceId'=>$this->invoiceId,
                    'rinvoiceId'=>$this->rinvoiceId,
//                 'invoiceData' => $this->invoiceData,
//                 'customer' => $this->customer,
//                 'userdetails' => $this->userdetails,
//                 'user' => $this->user,
//                 'products' => $this->products,
//                 'productData' => $this->productData,
//                 'subtotal' => $this->subtotal,
// //                'emi' => $this->emi,
//                 'tax' => $this->tax,
//                 'due' => $this->due,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
