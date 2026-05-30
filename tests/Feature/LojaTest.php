<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Produto;
use App\Models\Cliente;
use App\Models\Funcionario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class LojaTest extends TestCase
{
    use RefreshDatabase;

    public function test_global_search_returns_correct_products(): void
    {
        // 1. Create active and inactive products
        Produto::create([
            'nome' => 'Monitor Gamer LG UltraGear',
            'categoria' => 'Monitores Gamer',
            'status' => 'ativo',
            'preco' => 1200.00,
            'preco_pix' => 1000.00,
            'estoque' => 5,
            'descricao' => 'LG monitor 144hz',
            'imagem' => 'lg.jpg'
        ]);

        Produto::create([
            'nome' => 'Teclado Mecânico Razer BlackWidow',
            'categoria' => 'Periféricos',
            'status' => 'ativo',
            'preco' => 800.00,
            'preco_pix' => 700.00,
            'estoque' => 3,
            'descricao' => 'Razer mechanical keyboard',
            'imagem' => 'razer.jpg'
        ]);

        Produto::create([
            'nome' => 'Monitor Samsung Inativo',
            'categoria' => 'Monitores Gamer',
            'status' => 'inativo',
            'preco' => 1500.00,
            'preco_pix' => 1300.00,
            'estoque' => 2,
            'descricao' => 'Samsung inactive monitor',
            'imagem' => 'samsung.jpg'
        ]);

        // 2. Perform search for "LG"
        $response = $this->get(route('loja.busca', ['q' => 'LG']));
        $response->assertStatus(200);
        $response->assertSee('Monitor Gamer LG UltraGear');
        $response->assertDontSee('Teclado Mecânico Razer BlackWidow');

        // 3. Perform search for "Monitor" (should show active, not inactive)
        $response = $this->get(route('loja.busca', ['q' => 'Monitor']));
        $response->assertStatus(200);
        $response->assertSee('Monitor Gamer LG UltraGear');
        $response->assertDontSee('Monitor Samsung Inativo');
    }

    public function test_filters_and_sorting_work_on_monitores(): void
    {
        Produto::create([
            'nome' => 'LG Monitor 24 polegadas',
            'categoria' => 'Monitores Gamer',
            'status' => 'ativo',
            'preco' => 900.00,
            'preco_pix' => 850.00,
            'estoque' => 5,
        ]);

        Produto::create([
            'nome' => 'Samsung Monitor 4K',
            'categoria' => 'Monitores Profissionais',
            'status' => 'ativo',
            'preco' => 2500.00,
            'preco_pix' => 2300.00,
            'estoque' => 3,
        ]);

        // Filter by brand "LG"
        $response = $this->get(route('loja.monitores', ['marca' => 'LG']));
        $response->assertStatus(200);
        $response->assertSee('LG Monitor 24 polegadas');
        $response->assertDontSee('Samsung Monitor 4K');

        // Filter by price range "ate-1000"
        $response = $this->get(route('loja.monitores', ['preco' => 'ate-1000']));
        $response->assertStatus(200);
        $response->assertSee('LG Monitor 24 polegadas');
        $response->assertDontSee('Samsung Monitor 4K');

        // Sort by major price first
        $response = $this->get(route('loja.monitores', ['ordenar' => 'maior-preco']));
        $response->assertStatus(200);
        $response->assertSeeInOrder(['Samsung Monitor 4K', 'LG Monitor 24 polegadas']);
    }

    public function test_contact_submission_validates_and_succeeds(): void
    {
        // 1. Submit invalid data (should trigger validation errors)
        $response = $this->post(route('contato.store'), [
            'nome' => '',
            'email' => 'invalid-email',
            'assunto' => 'Oi',
            'mensagem' => 'Curto'
        ]);
        $response->assertSessionHasErrors(['nome', 'email', 'assunto', 'mensagem']);

        // 2. Submit valid data
        $response = $this->post(route('contato.store'), [
            'nome' => 'Gabriel Oliveira',
            'email' => 'gabriel@example.com',
            'assunto' => 'Sugestão de monitores',
            'mensagem' => 'Olá, gostaria de saber se vocês pretendem vender monitores OLED em breve.'
        ]);
        $response->assertRedirect(route('loja.contato'));
        $response->assertSessionHas('mensagem_sucesso');
    }

    public function test_admin_dashboard_metrics_are_correct(): void
    {
        // Create 2 products (1 out of stock)
        Produto::create([
            'nome' => 'Monitor com Estoque',
            'categoria' => 'Monitores Gamer',
            'status' => 'ativo',
            'preco' => 1000.00,
            'preco_pix' => 900.00,
            'estoque' => 5,
        ]);
        Produto::create([
            'nome' => 'Monitor Sem Estoque',
            'categoria' => 'Monitores Gamer',
            'status' => 'ativo',
            'preco' => 1200.00,
            'preco_pix' => 1100.00,
            'estoque' => 0,
        ]);

        // Create 3 clients
        Cliente::create(['nome' => 'Cliente 1', 'email' => 'c1@ex.com', 'telefone' => '11999999999', 'cpf' => '111.111.111-11', 'endereco' => 'Rua A']);
        Cliente::create(['nome' => 'Cliente 2', 'email' => 'c2@ex.com', 'telefone' => '11999999999', 'cpf' => '222.222.222-22', 'endereco' => 'Rua B']);
        Cliente::create(['nome' => 'Cliente 3', 'email' => 'c3@ex.com', 'telefone' => '11999999999', 'cpf' => '333.333.333-33', 'endereco' => 'Rua C']);

        // Create 1 employee for session login
        $funcionario = Funcionario::create([
            'nome' => 'Admin Teste',
            'cargo' => 'Gerente',
            'email' => 'admin@monitorstore.com',
            'telefone' => '11988888888',
            'senha' => '123456' // Just raw as used in auth logic
        ]);

        // Log in employee to session
        $response = $this->withSession([
            'funcionario' => true,
            'funcionario_id' => $funcionario->id,
            'funcionario_nome' => $funcionario->nome,
            'funcionario_cargo' => $funcionario->cargo
        ])->get(route('funcionario.dashboard'));

        $response->assertStatus(200);
        $response->assertViewHasAll([
            'totalProdutos' => 2,
            'totalClientes' => 3,
            'produtosSemEstoque' => 1,
            'totalPedidos' => 0
        ]);
    }
}
