<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecurringInvoice extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $dates = ['next_emi_date','paid_date'];

    public function invoices()
    {
        return $this->belongsToMany('App\Models\Invoice','recurring_invoice_invoices');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer','customer_id','id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
}
