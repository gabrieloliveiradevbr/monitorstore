<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\clienteController;
use App\Http\Controllers\funcionarioController;
use App\Http\Controllers\LojaController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\ContatoController;

/*
|--------------------------------------------------------------------------
| PÁGINA INICIAL
|--------------------------------------------------------------------------
*/

Route::get(
    '/',
    [LojaController::class, 'home']
)->name('inicio');

Route::get(
    '/inicio',
    [LojaController::class, 'home']
)->name('inicio.alt');


/*
|--------------------------------------------------------------------------
| LOGIN CLIENTE
|--------------------------------------------------------------------------
*/

Route::get(
    '/login',
    [clienteController::class, 'login']
)->name('login');

Route::post(
    '/login',
    [clienteController::class, 'auth']
)->name('login.auth');

Route::get(
    '/logout',
    [clienteController::class, 'logout']
)->name('logout');


/*
|--------------------------------------------------------------------------
| CADASTRO CLIENTE
|--------------------------------------------------------------------------
*/

Route::post(
    '/clientes',
    [clienteController::class, 'store']
)->name('clientes.store');


/*
|--------------------------------------------------------------------------
| MINHA CONTA
|--------------------------------------------------------------------------
*/

Route::get(
    '/minha-conta/{id}',
    [clienteController::class, 'minhaConta']
)->name('loja.minhaconta');

Route::post(
    '/cliente/atualizar/{id}',
    [clienteController::class, 'atualizarDados']
)->name('cliente.atualizar');

Route::post(
    '/cliente/senha/{id}',
    [clienteController::class, 'atualizarSenha']
)->name('cliente.senha');

Route::post(
    '/cliente/endereco/{id}',
    [clienteController::class, 'atualizarEndereco']
)->name('cliente.endereco');


/*
|--------------------------------------------------------------------------
| ROTAS DA LOJA
|--------------------------------------------------------------------------
*/

Route::prefix('loja')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | HOME LOJA
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/',
        [LojaController::class, 'home']
    )->name('loja.home');


    /*
    |--------------------------------------------------------------------------
    | MONITORES
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/monitores',
        [LojaController::class, 'monitores']
    )->name('loja.monitores');


    /*
    |--------------------------------------------------------------------------
    | ACESSÓRIOS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/acessorios',
        [LojaController::class, 'acessorios']
    )->name('loja.acessorios');


    /*
    |--------------------------------------------------------------------------
    | PERIFÉRICOS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/perifericos',
        [LojaController::class, 'perifericos']
    )->name('loja.perifericos');


    /*
    |--------------------------------------------------------------------------
    | PRODUTO INDIVIDUAL
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/produto/{id}',
        [LojaController::class, 'produto']
    )->name('loja.produto');

    Route::post(
        '/avaliacao',
        [AvaliacaoController::class, 'store']
    )->name('avaliacao.store');


    /*
    |--------------------------------------------------------------------------
    | BUSCA GLOBAL
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/busca',
        [LojaController::class, 'busca']
    )->name('loja.busca');


    /*
    |--------------------------------------------------------------------------
    | CONTATO
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/contato',
        function () {
            return view('cliente.contato');
        }
    )->name('loja.contato');

    Route::post(
        '/contato',
        [ContatoController::class, 'store']
    )->name('contato.store');


    /*
    |--------------------------------------------------------------------------
    | LOGIN CLIENTE
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/login',
        function () {

            return view('cliente.login');
        }
    )->name('loja.login');


    /*
    |--------------------------------------------------------------------------
    | CRIAR CONTA
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/criar',
        function () {

            return view('cliente.criarconta');
        }
    )->name('loja.criar');

    /*
    |--------------------------------------------------------------------------
    | CARRINHO
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/carrinho',
        [clienteController::class, 'carrinho']
    )->name('loja.carrinho');

    Route::post(
        '/carrinho/adicionar',
        [clienteController::class, 'adicionarCarrinho']
    )->name('carrinho.adicionar');

    Route::post(
        '/carrinho/atualizar',
        [clienteController::class, 'atualizarCarrinho']
    )->name('carrinho.atualizar');

    Route::get(
        '/carrinho/remover/{id}',
        [clienteController::class, 'removerCarrinho']
    )->name('carrinho.remover');

    Route::get(
        '/carrinho/finalizar',
        [clienteController::class, 'checkout']
    )->name('carrinho.checkout');

    Route::post(
        '/carrinho/confirmar',
        [clienteController::class, 'finalizarCarrinho']
    )->name('carrinho.confirmar');
});


/*
|--------------------------------------------------------------------------
| LOGIN FUNCIONÁRIO
|--------------------------------------------------------------------------
*/

Route::get(
    '/funcionario/login',
    function () {

        return view('loja.login');
    }
)->name('funcionario.login');

Route::post(
    '/funcionario/login',
    [funcionarioController::class, 'loginFuncionario']
)->name('funcionario.auth');

Route::get(
    '/funcionario/logout',
    [funcionarioController::class, 'logoutFuncionario']
)->name('funcionario.logout');


/*
|--------------------------------------------------------------------------
| ÁREA DO FUNCIONÁRIO
|--------------------------------------------------------------------------
*/

Route::prefix('funcionario')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/dashboard',
        [funcionarioController::class, 'dashboard']
    )->name('funcionario.dashboard');


    /*
    |--------------------------------------------------------------------------
    | PRODUTOS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/produtos',
        [funcionarioController::class, 'admin']
    )->name('funcionario.admin');


    /*
    |--------------------------------------------------------------------------
    | CADASTRO DE PRODUTO
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/cadastro',
        [funcionarioController::class, 'cadastro']
    )->name('funcionario.cadastro');


    /*
    |--------------------------------------------------------------------------
    | SALVAR PRODUTO
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/produto/cadastrar',
        [funcionarioController::class, 'store']
    )->name('funcionario.produto.store');


    /*
    |--------------------------------------------------------------------------
    | EDITAR PRODUTO
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/produto/editar/{id}',
        [funcionarioController::class, 'editar']
    )->name('funcionario.produto.editar');


    /*
    |--------------------------------------------------------------------------
    | ATUALIZAR PRODUTO
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/produto/atualizar/{id}',
        [funcionarioController::class, 'atualizar']
    )->name('funcionario.produto.atualizar');


    /*
    |--------------------------------------------------------------------------
    | EXCLUIR PRODUTO
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/produto/excluir/{id}',
        [funcionarioController::class, 'excluir']
    )->name('funcionario.produto.excluir');


    /*
    |--------------------------------------------------------------------------
    | PEDIDOS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/pedidos',
        [funcionarioController::class, 'pedidos']
    )->name('funcionario.pedidos');


    /*
    |--------------------------------------------------------------------------
    | CLIENTES
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/clientes',
        [funcionarioController::class, 'clientes']
    )->name('funcionario.clientes');


    /*
    |--------------------------------------------------------------------------
    | EXCLUIR CLIENTE
    |--------------------------------------------------------------------------
    */

    Route::delete(
        '/cliente/excluir/{id}',
        [funcionarioController::class, 'excluirCliente']
    )->name('funcionario.cliente.excluir');
});
