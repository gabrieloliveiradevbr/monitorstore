<?php

use Illuminate\Support\Facades\Route;

// Página inicial
Route::get('/', function () {
    return view('cliente.home');
})->name('inicio');

// Rota alternativa para início
Route::get('/inicio', function () {
    return view('cliente.home');
})->name('inicio.alt');

// ROTAS DO CLIENTE (LOJA)
Route::prefix('loja')->group(function () {

    Route::get('/monitores', function () {
        return view('cliente.monitores');
    })->name('loja.monitores');

    Route::get('/acessorios', function () {
        return view('cliente.acessorios');
    })->name('loja.acessorios');

    Route::get('/perifericos', function () {
        return view('cliente.perifericos');
    })->name('loja.perifericos');

    Route::get('/contato', function () {
        return view('cliente.contato');
    })->name('loja.contato');

    Route::get('/minhaconta', function () {
        return view('cliente.minhaconta');
    })->name('loja.minhaconta');

    Route::get('/carrinho', function () {
        return view('cliente.carrinho');
    })->name('loja.carrinho');

    Route::get('/produto/{id}', function ($id) {
        return view('cliente.produto', ['id' => $id]);
    })->name('loja.produto');

    
});


// ROTAS DO FUNCIONÁRIO (ADMIN)
Route::prefix('funcionario')->group(function () {

    Route::get('/dashboard', function () {
        return view('loja.dashboard');
    })->name('funcionario.dashboard');

    Route::get('/produtos', function () {
        return view('loja.admin');
    })->name('funcionario.admin');

    Route::get('/cadastro', function () {
        return view('loja.cadastro_produto');
    })->name('funcionario.cadastro');

    Route::get('/pedidos', function () {
        return view('loja.pedidos');
    })->name('funcionario.pedidos');

    Route::get('/clientes', function () {
        return view('loja.clientes');
    })->name('funcionario.clientes');
});