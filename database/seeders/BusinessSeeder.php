<?php

namespace Database\Seeders;

use App\Models\Business;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Business::create(['name' => 'Manufacturing']);
        Business::create(['name' => 'Whole Seller']);
        Business::create(['name' => 'Retailer']);
        Business::create(['name' => 'Service Industry']);
        Business::create(['name' => 'Personal Brand']);
    }
}
