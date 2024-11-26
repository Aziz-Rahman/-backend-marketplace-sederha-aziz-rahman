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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable(); // kolom user id jika nanti dibutuhkan
            $table->string('customer_name');
            $table->string('customer_address'); 
            $table->string('customer_city'); 
            $table->string('customer_pos_code'); 
            $table->string('customer_phone'); 
            $table->integer('total_discount')->nullable(); // total diskon setelah belanja
            $table->decimal('total_price', 10, 2); // Total belanja blm dg diskon akhir & shipping
            $table->decimal('shipping_cost', 10, 2)->default(0);
            $table->decimal('final_total_price', 10, 2); // Total brlanja sudah dg shipping & diskon akhir
            $table->string('status')->default('pending'); // Status checkout
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};
