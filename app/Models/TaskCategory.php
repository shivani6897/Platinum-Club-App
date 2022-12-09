<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskCategory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function tasks()
    {
        return $this->hasMany('App\Models\Task','task_category_id','id');
    }
}
