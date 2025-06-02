<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('taxes_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('individual_entrepreneur_type_id');
            $table->integer('tax_schema_id');
            $table->decimal('income', 15, 2);
            $table->decimal('expenses', 15, 2);
            $table->integer('financial_operation_id')->unique(); //It is unique() that makes the relationship 1:1, preventing attributes from having the same values.
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('individual_entrepreneur_type_id')->references('id')->on('individual_entrepreneur_types');
            $table->foreign('tax_schema_id')->references('id')->on('tax_schemas');
            $table->foreign('financial_operation_id')->references('id')->on('financial_operations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxes_payments');
    }
};
