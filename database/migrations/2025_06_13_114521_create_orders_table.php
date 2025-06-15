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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contact_id')->comment('cliente');
            $table->unsignedBigInteger('seller_id')->comment('vendedor');
            $table->integer('order_type')->default(0);
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->decimal('order_total', 10, 2)->nullable();
            $table->timestamp('date')->nullable();
            $table->timestamp('delivery_date')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();

            $table->foreign('currency_id')->references('id')->on('currencies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
