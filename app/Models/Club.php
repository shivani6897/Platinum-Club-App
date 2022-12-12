<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Club extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];


    public function users()
    {
        return $this->hasMany('App\Models\User','club_id','id');
    }
}