<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseCategory extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = ['id'];

    public function expenses()
    {
        return $this->hasMany('App\Models\Expense','expense_category_id','id');
    }
}
