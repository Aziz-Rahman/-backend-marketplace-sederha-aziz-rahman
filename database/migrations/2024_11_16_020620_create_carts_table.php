<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable(); // ID pengguna
            $table->string('session_id', 100)->nullable();
            $table->unsignedBigInteger('product_id'); // ID produk
            $table->integer('quantity'); // Jumlah barang
            $table->decimal('price', 10, 2); // Harga barang per item
            $table->integer('discount')->nullable(); // discount per item
            $table->timestamps();

            // Relasi
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
