<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecurringInvoiceInvoice extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "recurring_invoice_invoices";
    protected $guarded = ['id'];
}
