<?php

namespace Database\Seeders;

use App\Models\ExpenseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExpenseCategory::create(['name' => 'Ad Spend']);
        ExpenseCategory::create(['name' => 'Salary']);
        ExpenseCategory::create(['name' => 'Rent']);
        ExpenseCategory::create(['name' => 'Utilites']);
        ExpenseCategory::create(['name' => 'Other Overhead']);
    }
}
