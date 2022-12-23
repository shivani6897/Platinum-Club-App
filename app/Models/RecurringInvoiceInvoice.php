<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecurringInvoiceInvoice extends Model
{
    use HasFactory;
    protected $table = "recurring_invoice_invoices";
    protected $guarded = ['id'];
}
