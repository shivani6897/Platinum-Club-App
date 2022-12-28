<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function tasks()
    {
        return $this->hasMany('App\Models\Task','task_category_id','id');
    }
}
