<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition(): array
    {
        return [
            'exp_name' => $this->faker->name(),
//            'exp_purpose' => $this->faker->text(),
            'exp_description' => $this->faker->text(),
//            'exp_payment_mode' => $this->faker->randomElement(['cash','cheque']),
            'exp_amount' => $this->faker->randomFloat(2,50,1000),
//            'exp_status' => $this->faker->randomElement(['paid','due']),
        ];
    }
}
