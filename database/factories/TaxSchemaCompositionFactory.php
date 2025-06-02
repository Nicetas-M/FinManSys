<?php

namespace Database\Factories;

use App\Models\TaxSchema;
use App\Models\TaxType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaxSchemaComposition>
 */
class TaxSchemaCompositionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tax_schema_id' => TaxSchema::get()->random()->id,
            'tax_type_id' => TaxType::get()->random()->id,
        ];
    }
}
