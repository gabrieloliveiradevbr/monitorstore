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
        Schema::create('clinte_pedido', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id_cliente');
            $table->unsignedBigInteger('pedido_id_pedido');

            $table->foreign('cliente_id_cliente')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('pedido_id_pedido')->references('id')->on('pedidos')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinte_pedido');
    }
};
