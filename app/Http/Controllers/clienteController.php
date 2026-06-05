<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Produto;

class clienteController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    public function login()
    {

        return view('cliente.login');
    }

    /*
    |--------------------------------------------------------------------------
    | CADASTRO
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {

        $cliente = Cliente::create([

            'nome'      => $request->nome,
            'email'     => $request->email,
            'telefone'  => $request->telefone,
            'cpf'       => $request->cpf,
            'senha'     => $request->senha

        ]);

        session([

            'cliente_id' => $cliente->id

        ]);

        return redirect()
            ->route('loja.minhaconta', $cliente->id)
            ->with(
                'mensagem',
                'Conta criada com sucesso!'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | AUTENTICAÇÃO
    |--------------------------------------------------------------------------
    */

    public function auth(Request $request)
    {

        $cliente = Cliente::where(
            'email',
            $request->email
        )
            ->where(
                'senha',
                $request->senha
            )
            ->first();

        if (!$cliente) {

            return redirect()
                ->back()
                ->with(
                    'erro',
                    'E-mail ou senha inválidos!'
                );
        }

        session([

            'cliente_id' => $cliente->id

        ]);

        return redirect()
            ->route(
                'loja.minhaconta',
                $cliente->id
            );
    }

    /*
    |--------------------------------------------------------------------------
    | MINHA CONTA
    |--------------------------------------------------------------------------
    */

    public function minhaConta($id)
    {

        $cliente = Cliente::find($id);

        if (!$cliente) {

            return redirect()
                ->route('login');
        }

        return view(
            'cliente.minhaconta',
            compact('cliente')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout()
    {

        session()->forget('cliente_id');

        return redirect()
            ->route('login')
            ->with(
                'mensagem',
                'Logout realizado com sucesso!'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | ATUALIZAR DADOS
    |--------------------------------------------------------------------------
    */

    public function atualizarDados(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {

            return redirect()
                ->back()
                ->with(
                    'erro',
                    'Cliente não encontrado!'
                );
        }

        $cliente->update([

            'nome'      => $request->nome,
            'email'     => $request->email,
            'telefone'  => $request->telefone

        ]);

        return redirect()
            ->back()
            ->with(
                'mensagem',
                'Dados atualizados com sucesso!'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | ALTERAR SENHA
    |--------------------------------------------------------------------------
    */

    public function atualizarSenha(Request $request, $id)
    {

        $cliente = Cliente::find($id);

        if (!$cliente) {

            return redirect()
                ->back()
                ->with(
                    'erro',
                    'Cliente não encontrado!'
                );
        }

        if ($cliente->senha != $request->senha_atual) {

            return redirect()
                ->back()
                ->with(
                    'erro',
                    'Senha atual incorreta!'
                );
        }

        if ($request->nova_senha != $request->confirma_senha) {

            return redirect()
                ->back()
                ->with(
                    'erro',
                    'As senhas não coincidem!'
                );
        }

        $cliente->update([

            'senha' => $request->nova_senha

        ]);

        return redirect()
            ->back()
            ->with(
                'mensagem',
                'Senha alterada com sucesso!'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | ATUALIZAR ENDEREÇO
    |--------------------------------------------------------------------------
    */

    public function atualizarEndereco(Request $request, $id)
    {

        $cliente = Cliente::find($id);

        if (!$cliente) {

            return redirect()
                ->back()
                ->with(
                    'erro',
                    'Cliente não encontrado!'
                );
        }

        $cliente->update([

            'endereco' => $request->endereco

        ]);

        return redirect()
            ->back()
            ->with(
                'mensagem',
                'Endereço atualizado com sucesso!'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | CARRINHO
    |--------------------------------------------------------------------------
    */

    public function carrinho()
    {

        $carrinho = session()->get(
            'carrinho',
            []
        );

        return view(
            'cliente.carrinho',
            compact('carrinho')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ADICIONAR AO CARRINHO
    |--------------------------------------------------------------------------
    */

    public function adicionarCarrinho(Request $request)
    {

        $produto = Produto::findOrFail(
            $request->produto_id
        );

        $carrinho = session()->get(
            'carrinho',
            []
        );

        $quantidade = (int) $request->quantidade;

        if (isset($carrinho[$produto->id])) {

            $carrinho[$produto->id]['quantidade']
                += $quantidade;
        } else {

            $carrinho[$produto->id] = [

                'id' => $produto->id,

                'nome' => $produto->nome,

                'preco' => $produto->preco,

                'preco_pix' => $produto->preco_pix,

                'imagem' => $produto->imagem,

                'quantidade' => $quantidade

            ];
        }

        session()->put(
            'carrinho',
            $carrinho
        );

        if ($request->acao == 'comprar') {

            return redirect()
                ->route('loja.carrinho');
        }

        return redirect()
            ->back()
            ->with(
                'mensagem',
                'Produto adicionado ao carrinho!'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | REMOVER DO CARRINHO
    |--------------------------------------------------------------------------
    */

    public function removerCarrinho($id)
    {

        $carrinho = session()->get(
            'carrinho',
            []
        );

        if (isset($carrinho[$id])) {

            unset($carrinho[$id]);

            session()->put(
                'carrinho',
                $carrinho
            );
        }

        return redirect()
            ->route('loja.carrinho');
    }

    /*
    |--------------------------------------------------------------------------
    | ATUALIZAR CARRINHO
    |--------------------------------------------------------------------------
    */

    public function atualizarCarrinho(Request $request)
    {
        $carrinho = session()->get('carrinho', []);

        if ($request->has('produto_id') && $request->has('quantidade')) {
            foreach ($request->produto_id as $index => $id) {
                if (isset($carrinho[$id]) && isset($request->quantidade[$index])) {
                    $qtd = (int) $request->quantidade[$index];
                    if ($qtd > 0) {
                        $carrinho[$id]['quantidade'] = $qtd;
                    } else {
                        unset($carrinho[$id]);
                    }
                }
            }
            session()->put('carrinho', $carrinho);
        }

        return redirect()
            ->route('loja.carrinho')
            ->with('mensagem', 'Carrinho atualizado com sucesso!');
    }

    /*
    |--------------------------------------------------------------------------
    | FINALIZAR COMPRA
    |--------------------------------------------------------------------------
    */

    public function checkout()
    {
        if (!session()->has('cliente_id')) {
            return redirect()
                ->route('login')
                ->with('mensagem', 'Você precisa estar logado para finalizar a compra!');
        }

        $carrinho = session()->get('carrinho', []);

        if (empty($carrinho)) {
            return redirect()
                ->route('loja.carrinho')
                ->with('mensagem', 'Seu carrinho está vazio.');
        }

        $subtotal = 0;
        $totalItens = 0;

        foreach ($carrinho as $item) {
            $subtotal += ($item['preco_pix'] ?? $item['preco']) * $item['quantidade'];
            $totalItens += $item['quantidade'];
        }

        $limiteFreteGratis = 500.00;
        $frete = ($subtotal >= $limiteFreteGratis || $totalItens == 0) ? 0.00 : 35.00;
        $total = $subtotal + $frete;
        $progresso = $subtotal >= $limiteFreteGratis ? 100 : round(($subtotal / $limiteFreteGratis) * 100);
        $faltaFrete = max(0, $limiteFreteGratis - $subtotal);

        return view('cliente.checkout', [
            'carrinho' => $carrinho,
            'subtotal' => $subtotal,
            'totalItens' => $totalItens,
            'frete' => $frete,
            'total' => $total,
            'progresso' => $progresso,
            'faltaFrete' => $faltaFrete,
        ]);
    }

    public function finalizarCarrinho()
    {
        if (!session()->has('cliente_id')) {
            return redirect()
                ->route('login')
                ->with('mensagem', 'Você precisa estar logado para finalizar a compra!');
        }

        $carrinho = session()->get('carrinho', []);

        if (empty($carrinho)) {
            return redirect()
                ->route('loja.carrinho')
                ->with('mensagem', 'Seu carrinho está vazio.');
        }

        $clienteId = session('cliente_id');

        $funcionarioId = \App\Models\Funcionario::query()->value('id');
        $funcionarioId = $funcionarioId ?: 0;

        $pedido = \Illuminate\Support\Facades\DB::table('pedidos')->insertGetId([
            'data_pedido' => now()->toDateString(),
            'id_cliente' => $clienteId,
            'id_funcionario' => $funcionarioId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        foreach ($carrinho as $item) {
            $produtoId = $item['id'];
            $qtd = (int) ($item['quantidade'] ?? 0);
            if ($qtd <= 0) {
                continue;
            }

            $precoUnitario = $item['preco_pix'] ?? $item['preco'] ?? 0;

            \Illuminate\Support\Facades\DB::table('pedidoproduto')->insert([
                'quantidade' => (string) $qtd,
                'preco_unitario' => (string) $precoUnitario,
                'id_pedido' => $pedido,
                'id_produto' => $produtoId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            \App\Models\Produto::where('id', $produtoId)->update([
                'estoque' => \Illuminate\Support\Facades\DB::raw('estoque - ' . $qtd),
            ]);
        }

        session()->forget('carrinho');

        return redirect()
            ->route('loja.home')
            ->with('mensagem', 'Compra finalizada com sucesso! Seu pedido foi registrado.');
    }
}
