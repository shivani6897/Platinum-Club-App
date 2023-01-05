<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class RecurringInvoice extends Model
{
    use HasFactory, SoftDeletes, Sortable;
    protected $guarded = ['id'];
    protected $dates = ['next_emi_date','paid_date'];
    public $sortable = ['downpayment', 'paid','pending', 'emi_amount','paid_date', 'next_emi_date', 'paid_emis', 'total_emis','created_at'];


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
