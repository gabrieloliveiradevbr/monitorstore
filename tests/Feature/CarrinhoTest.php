<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CarrinhoTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_add_product_to_cart(): void
    {
        $produto = Produto::create([
            'nome' => 'Monitor Teste',
            'categoria' => 'Monitores',
            'status' => 'ativo',
            'preco' => 1000.00,
            'preco_pix' => 900.00,
            'estoque' => 10,
            'descricao' => 'Descrição do monitor teste',
            'imagem' => 'teste.jpg'
        ]);

        $response = $this->post(route('carrinho.adicionar'), [
            'produto_id' => $produto->id,
            'quantidade' => 2
        ]);

        $response->assertRedirect();
        $this->assertEquals(2, session('carrinho')[$produto->id]['quantidade']);
        $this->assertEquals('Monitor Teste', session('carrinho')[$produto->id]['nome']);
    }

    public function test_can_remove_product_from_cart(): void
    {
        $produto = Produto::create([
            'nome' => 'Monitor Teste',
            'categoria' => 'Monitores',
            'status' => 'ativo',
            'preco' => 1000.00,
            'preco_pix' => 900.00,
            'estoque' => 10,
            'descricao' => 'Descrição do monitor teste',
            'imagem' => 'teste.jpg'
        ]);

        // Coloca item na sessão do carrinho
        $this->withSession([
            'carrinho' => [
                $produto->id => [
                    'id' => $produto->id,
                    'nome' => $produto->nome,
                    'preco' => $produto->preco,
                    'preco_pix' => $produto->preco_pix,
                    'imagem' => $produto->imagem,
                    'quantidade' => 1
                ]
            ]
        ]);

        $response = $this->get(route('carrinho.remover', $produto->id));

        $response->assertRedirect(route('loja.carrinho'));
        $this->assertEmpty(session('carrinho'));
    }

    public function test_can_update_product_quantity_in_cart(): void
    {
        $produto = Produto::create([
            'nome' => 'Monitor Teste',
            'categoria' => 'Monitores',
            'status' => 'ativo',
            'preco' => 1000.00,
            'preco_pix' => 900.00,
            'estoque' => 10,
            'descricao' => 'Descrição do monitor teste',
            'imagem' => 'teste.jpg'
        ]);

        $this->withSession([
            'carrinho' => [
                $produto->id => [
                    'id' => $produto->id,
                    'nome' => $produto->nome,
                    'preco' => $produto->preco,
                    'preco_pix' => $produto->preco_pix,
                    'imagem' => $produto->imagem,
                    'quantidade' => 1
                ]
            ]
        ]);

        $response = $this->post(route('carrinho.atualizar'), [
            'produto_id' => [$produto->id],
            'quantidade' => [5]
        ]);

        $response->assertRedirect(route('loja.carrinho'));
        $this->assertEquals(5, session('carrinho')[$produto->id]['quantidade']);
    }
}
