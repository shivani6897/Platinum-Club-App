<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecurringInvoice extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function invoices()
    {
        return $this->belongsToMany('App\Models\Invoice','recurring_invoice_invoices');
    }
}
