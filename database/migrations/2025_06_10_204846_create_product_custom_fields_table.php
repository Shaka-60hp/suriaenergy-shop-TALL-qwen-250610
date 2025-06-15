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
        Schema::create('product_custom_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('family_id');
            $table->string('custom_field_name');
            $table->string('custom_field_type')->comment('Valores: string / number / json');
            $table->string('custom_field_unit')->nullable()->comment('Ej: Watt, Volts, Amp');
            $table->tinyInteger('order')->nullable();
            $table->timestamps();

            $table->foreign('family_id')->references('id')->on('product_families');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_custom_fields');
    }
};
