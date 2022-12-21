<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'=>2,
            'expense_category_id'=>1,
            'expense'=>rand(1,100)*1000,
            'date'=>Carbon::today()->subDays(rand(0, 365))->format('Y-m-d'),
        ];
    }
}
