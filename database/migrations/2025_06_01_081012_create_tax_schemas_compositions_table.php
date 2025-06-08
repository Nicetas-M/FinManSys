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
        Schema::create('tax_schemas_compositions', function (Blueprint $table) {
            $table->id();
            $table->integer('tax_schema_id');
            $table->integer('tax_type_id');
            $table->timestamps();

            //$table->primary(['tax_schema_id', 'tax_type_id']);

            $table->foreign('tax_schema_id')->references('id')->on('tax_schemas');
            $table->foreign('tax_type_id')->references('id')->on('tax_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tax_schemas_compositions');
    }
};
