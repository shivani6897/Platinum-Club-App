<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

/**
 * App\Models\BusinessStat
 *
 * @property int $id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessStat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessStat newQuery()
 * @method static \Illuminate\Database\Query\Builder|BusinessStat onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessStat query()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessStat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessStat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessStat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessStat whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|BusinessStat withTrashed()
 * @method static \Illuminate\Database\Query\Builder|BusinessStat withoutTrashed()
 * @mixin \Eloquent
 */
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
