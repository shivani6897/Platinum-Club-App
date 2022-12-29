<?php

namespace Database\Seeders;

use App\Models\JobPosition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobPosition::create(['name' => 'CEO']);
        JobPosition::create(['name' => 'Director']);
        JobPosition::create(['name' => 'GM']);
        JobPosition::create(['name' => 'VP']);
        JobPosition::create(['name' => 'CFO']);
        JobPosition::create(['name' => 'Other']);
    }
}
