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
        Schema::create('order_product', function (Blueprint $table) { 
        $table->id();
        $table->string('name_client');
        $table->integer('cel_client');
        $table->string('ubi_client');
        $table->string('mail_client');
        $table->text('productos'); // Cambiado a text() para permitir cadenas largas
        $table->integer('order_id')->unsigned();
        $table->integer('product_id')->unsigned();
        $table->integer('quantity');
        // Definir las claves foráneas
        $table->foreign('order_id')->references('id')
            ->on('orders')->onDelete('cascade');
        $table->foreign('product_id')->references('id')
            ->on('products')->onDelete('cascade');
        $table->timestamps();
        // No incluir $table->timestamps(); aquí para evitar duplicados de created_at y updated_at
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product');
    }
};
