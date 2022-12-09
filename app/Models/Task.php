<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $dates = ['created_at','updated_at','date','start_date','end_date','task_time'];

    public function task_category()
    {
        return $this->belongsTo('App\Models\TaskCategory','task_category_id','id');
    }

    public function getFrequency()
    {
        switch($this->frequency)
        {
            case 0:
            return 'None';

            case 1:
            return 'Daily';

            case 2:
            return 'Bi-Weely';

            case 3:
            return 'Weekly';

            case 4:
            return 'Monthly';

            default:
            return 'Unknown';
        }
    }
}
