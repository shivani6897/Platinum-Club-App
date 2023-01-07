<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use HasFactory, SoftDeletes,Sortable;
    protected $guarded = ['id'];
    public $sortable = ['price','created_at'];


    const DURATION_TYPE = [
        'day' => 'DAY',
        'month' => 'MONTH',
        'year' => 'YEAR'
    ];

    public function recurringInvoice()
    {
        return $this->hasMany(RecurringInvoice::class,'product_id','id');
    }
}
