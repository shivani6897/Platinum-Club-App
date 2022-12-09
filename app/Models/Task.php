<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function task_category()
    {
        return $this->belongsTo('App\Models\TaskCategory','task_category_id','id');
    }
}
