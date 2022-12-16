<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function payments()
    {
        return $this->hasMany('App\Models\Payment','invoice_id','id');
    }

    public function product_log()
    {
        return $this->hasMany('App\Models\ProductLog','invoice_id','id');
    }
}
