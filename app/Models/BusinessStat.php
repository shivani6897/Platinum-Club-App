<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class BusinessStat extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'month', 'revenue_earned', 'ad_spends', 'avg_cost_per_lead', 'leads_generated', 'paid_customer', 'group_size', 'overheads', 'net_profit', 'profitability'
    ];

    public function getMonthAttribute($value)
    {
        $date = new Carbon($value);
        return $value ? $date->format('F Y') : '';
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
