<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserHabit extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function habit()
    {
        return $this->belongsTo('App\Models\Habit','habit_id','id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\Habit','user_id','id');
    }
}
