<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncomeCategory extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];

    public function incomes()
    {
        return $this->hasMany('App\Models\Income','income_category_id','id');
    }
}
