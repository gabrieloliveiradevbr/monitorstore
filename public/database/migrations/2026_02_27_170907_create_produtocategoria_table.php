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
        Schema::create('produtocategoria', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('categoria_id_categoria');
            $table->unsignedBigInteger('produto_id_produto');

            $table->foreign('categoria_id_categoria')->references('id')->on('categorias')->onDelete('cascade');
            $table->foreign('produto_id_produto')->references('id')->on('produtos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtocategoria');
    }
};
