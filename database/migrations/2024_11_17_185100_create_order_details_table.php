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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('checkout_id')->constrained('checkouts')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->string('image')->nullable();
            $table->string('title');
            $table->text('description');
            $table->integer('quantity');
            $table->decimal('price', 10, 2); // Harga per item
            $table->integer('discount')->default(0); // diskon per item jika ada
            $table->decimal('subtotal', 10, 2); // Subtotal untuk item
            $table->timestamps();

            // $table->foreign('checkout_id')->references('id')->on('checkouts')->onDelete('cascade');
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
