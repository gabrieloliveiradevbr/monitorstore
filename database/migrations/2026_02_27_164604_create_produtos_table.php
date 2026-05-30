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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 255);
            $table->string('categoria', 100);
            $table->string('status', 50);
            $table->integer('estoque');
            $table->string('imagem', 255)->nullable();
            $table->text('descricao')->nullable();
            $table->tinyInteger('destaque')->default(0);
            $table->tinyInteger('oferta')->default(0);
            $table->decimal('preco_antigo', 10, 2)->nullable();
            $table->decimal('preco_pix', 10, 2)->nullable();
            $table->decimal('preco_parcelado', 10, 2)->nullable();
            $table->integer('parcelas')->nullable();
            $table->string('imagem2', 255)->nullable();
            $table->string('imagem3', 255)->nullable();
            $table->string('imagem4', 255)->nullable();
            $table->string('imagem5', 255)->nullable();
            $table->decimal('preco', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
