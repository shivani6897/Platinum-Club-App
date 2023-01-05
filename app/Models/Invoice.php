<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Invoice extends Model
{
    use HasFactory, SoftDeletes, Sortable;
    protected $guarded = ['id'];
    protected $dates=['created_at'];
    public $sortable = ['invoice_number', 'total_amount', 'created_at'];


    public function payments()
    {
        return $this->hasMany('App\Models\Payment','invoice_id','id');
    }

    public function product_log()
    {
        return $this->hasMany('App\Models\ProductLog','invoice_id','id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }
    public function income(){
        return $this->belongsTo('App\Models\Income', 'id','invoice_id');
    }
}
