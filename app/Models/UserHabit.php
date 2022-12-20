<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHabit extends Model
{
    use HasFactory;
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
