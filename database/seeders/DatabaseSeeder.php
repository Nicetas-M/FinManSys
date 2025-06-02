<?php

namespace Database\Seeders;

use App\Models\FinancialOperation;
use App\Models\TaxesPayment;
use App\Models\TaxSchemaComposition;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\UserAccount;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {
        User::factory(10)->create();

        DB::table('currencies')->insert([
            [
                'alfa-3' => 'UAH',
                'number-3' => 980,
                'name' => 'Ukrainian hryvnia',
            ], [
                'alfa-3' => 'USD',
                'number-3' => 840,
                'name' => 'US dollar',
            ], [
                'alfa-3' => 'EUR',
                'number-3' => 978,
                'name' => 'Euro',
            ]
        ]);

        DB::table('tax_types')->insert([
            [
                'name' => 'name1',
                'formula' => 'formula1'
            ], [
                'name' => 'name2',
                'formula' => 'formula2'
            ], [
                'name' => 'name3',
                'formula' => 'formula3'
            ],
        ]);

        DB::table('tax_schemas')->insert([
            [
                'name' => 'name1',
                'description' => 'description1'
            ], [
                'name' => 'name2',
                'description' => 'description2'
            ], [
                'name' => 'name3',
                'description' => 'description3'
            ],
        ]);

        DB::table('tax_schemas_compositions')->insert([
            [
                'tax_schema_id' => '1',
                'tax_type_id' => '1'
            ], [
                'tax_schema_id' => '1',
                'tax_type_id' => '3'
            ], [
                'tax_schema_id' => '2',
                'tax_type_id' => '3'
            ], [
                'tax_schema_id' => '2',
                'tax_type_id' => '1'
            ],
        ]);

        //TaxSchemaComposition::factory(2)->create();

        DB::table('individual_entrepreneur_types')->insert([
            [
                'name' => 'ФОП 1 групи',
                'description' => 'Підприємці без найманих працівників, які займаються роздрібною торгівлею на ринках або наданням послуг людям.',
                'income_limit' => 1185700.00,
                'reporting_frequency' => 30,
            ], [
                'name' => 'ФОП 2 групи',
                'description' => 'Вид оформлення для невеликого бізнесу з розширеними можливостями та більшим обсягом доходів.',
                'income_limit' => 5921400.00,
                'reporting_frequency' => 30,
            ], [
                'name' => 'ФОП 3 групи',
                'description' => 'Підприємці, які можуть працювати самостійно, так і наймати необмежену кількість робітників.',
                'income_limit' => 8285700.00,
                'reporting_frequency' => 30,
            ],
        ]);

        UserAccount::factory(10)->create();

        FinancialOperation::factory(100)->create();

        $allIds = FinancialOperation::pluck('id')->toArray();
        $usedIds = TaxesPayment::pluck('financial_operation_id')->toArray();
        $availableIds = array_diff($allIds, $usedIds);
        $financialOperationId = null;
        foreach(array_slice($availableIds, 0, 25) as $id) {
            TaxesPayment::factory()->create([
                'financial_operation_id' => $id
            ]);
        }
    }
}
