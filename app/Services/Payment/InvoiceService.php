<?php

namespace App\Services\Payment;
use App\Models\Invoice;
use App\Models\UserDetail;

class InvoiceService {

    public function generateInvoiceNumber()
    {
        $user_deatils = UserDetail::where('user_id',auth()->id())->first('business_name');
        $invoicecount = Invoice::whereYear('created_at', date('Y'))->count();
        $invoicecount = strlen($invoicecount) == 1 ?  '0'.$invoicecount+1 : $invoicecount+1;
        $invoice_number = $user_deatils ? strtoupper(substr($user_deatils->business_name , 0, 3)).date('Y').$invoicecount : strtoupper(substr(auth()->user()->first_name , 0, 3)).date('Y').$invoicecount;

        return $invoice_number;
    }
}