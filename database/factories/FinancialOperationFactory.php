<?php

namespace Database\Factories;

use App\Models\UserAccount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FinancialOperation>
 */
class FinancialOperationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_account_id' => UserAccount::get()->random()->id,
            'balance_change' => $this->faker->randomFloat(2,0,9999),
            'balance_after' => $this->faker->randomFloat(2,0,999999),
            'created_at' => now(),
        ];
    }
}
