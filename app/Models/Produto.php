<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produto extends Model
{
    protected $table = 'produtos';

    protected $fillable = [
        'nome',
        'categoria',
        'status',
        'destaque',
        'oferta',
        'preco',
        'preco_pix',
        'preco_parcelado',
        'parcelas',
        'estoque',
        'descricao',
        'imagem',
        'imagem2',
        'imagem3',
        'imagem4',
        'imagem5'
    ];

    public function avaliacoes(): HasMany
    {
        return $this->hasMany(Avaliacao::class, 'produto_id');
    }
}
