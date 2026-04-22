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
        Schema::create('fornecedorproduto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fornecedor_id_fornecedor');
            $table->unsignedBigInteger('produto_id_produto');

            $table->foreign('fornecedor_id_fornecedor')->references('id')->on('fornecedores')->onDelete('cascade');
            $table->foreign('produto_id_produto')->references('id')->on('produtos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fornecedorproduto');
    }
};
