<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Income>
 */
class IncomeFactory extends Factory
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
            'income_category_id'=>1,
            'income'=>rand(1,100)*1000,
            'date'=>Carbon::today()->subDays(rand(0, 365))->format('Y-m-d'),
        ];
    }
}
