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
                'name'=>'Selling',
                'active'=>1,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],[
                'name'=>'Content Marketing',
                'active'=>1,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],[
                'name'=>'Systems',
                'active'=>1,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'Courses',
                'active'=>1,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'Community',
                'active'=>1,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'Finances',
                'active'=>1,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'Learning',
                'active'=>1,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],[
                'name'=>'Recreation',
                'active'=>1,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]
        ]);
    }
}
