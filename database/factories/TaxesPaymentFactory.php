<?php

namespace Database\Factories;

use App\Models\FinancialOperation;
use App\Models\IndividualEntrepreneurType;
use App\Models\TaxesPayment;
use App\Models\TaxSchema;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaxesPayment>
 */
class TaxesPaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'user_id' => User::get()->random()->id,
            'individual_entrepreneur_type_id' => IndividualEntrepreneurType::get()->random()->id,
            'tax_schema_id' => TaxSchema::get()->random()->id,
            'income' => $this->faker->randomFloat(2, 0, 99999),
            'expenses' => $this->faker->randomFloat(2, 0, 99999),
            //'financial_operation_id' => $financialOperationId,
        ];
    }
}
