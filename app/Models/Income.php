<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Income extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $dates = ['date'];


    public function incomeCategory()
    {
        return $this->belongsTo(IncomeCategory::class);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

}
