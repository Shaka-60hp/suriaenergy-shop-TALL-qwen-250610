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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->string('sku')->nullable();
            $table->string('product');
            $table->string('image')->nullable();
            $table->integer('qty')->default(0);
            $table->unsignedBigInteger('currency_id');
            $table->decimal('price', 15, 2);
            $table->string('tax_rate', 15)->nullable();
            $table->decimal('tax', 15, 2);
            $table->unsignedBigInteger('seller_id')->comment('proveedor del producto');
            $table->timestamp('delivery_date')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('currency_id')->references('id')->on('currencies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
