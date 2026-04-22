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
        Schema::create('pedidofuncionario', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pedido_id_pedido');
            $table->unsignedBigInteger('funcionario_id_funcionario');

            $table->foreign('pedido_id_pedido')->references('id')->on('pedidos')->onDelete('cascade');
            $table->foreign('funcionario_id_funcionario')->references('id')->on('funcionarios')->onDelete('cascade');
          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidofuncionario');
    }
};
