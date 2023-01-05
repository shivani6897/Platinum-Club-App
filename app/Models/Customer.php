<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Customer extends Model
{
    use HasFactory,SoftDeletes, Sortable;

    protected $guarded = ['id'];
    protected $dates = ['created_at'];
    public $sortable = ['name', 'company_name','state', 'created_at','gst_no'];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

}
