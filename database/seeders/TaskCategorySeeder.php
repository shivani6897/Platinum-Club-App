<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\TaskCategory::insert([
            [
                'name'=>'Learning',
                'active'=>1,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],[
                'name'=>'System Setup',
                'active'=>1,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],[
                'name'=>'Finance Management',
                'active'=>1,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'Sales Meetings/Webinars',
                'active'=>1,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'Team Meetings',
                'active'=>1,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'Marketing',
                'active'=>1,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'Break',
                'active'=>1,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]
        ]);
    }
}
