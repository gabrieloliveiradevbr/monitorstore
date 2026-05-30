<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\Produto;
use App\Models\Cliente;

class funcionarioController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | LOGIN FUNCIONÁRIO
    |--------------------------------------------------------------------------
    */

    public function loginFuncionario(Request $request)
    {

        $funcionario = Funcionario::where(
            'email',
            $request->email
        )->where(
            'senha',
            $request->senha
        )->first();

        if ($funcionario) {

            session([

                'funcionario'       => true,
                'funcionario_id'    => $funcionario->id,
                'funcionario_nome'  => $funcionario->nome,
                'funcionario_cargo' => $funcionario->cargo

            ]);

            return redirect()
                ->route('funcionario.dashboard');
        }

        return redirect()
            ->back()
            ->with(
                'mensagem',
                'Email ou senha incorretos!'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logoutFuncionario()
    {

        session()->forget([

            'funcionario',
            'funcionario_id',
            'funcionario_nome',
            'funcionario_cargo'

        ]);

        return redirect()
            ->route('funcionario.login');
    }

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {

        if (!session('funcionario')) {

            return redirect()
                ->route('funcionario.login');
        }

        $totalProdutos = Produto::count();
        $totalClientes = Cliente::count();
        $produtosSemEstoque = Produto::where('estoque', '<=', 0)->count();
        $totalPedidos = \Illuminate\Support\Facades\DB::table('pedidos')->count();

        return view(
            'loja.dashboard',
            compact('totalProdutos', 'totalClientes', 'produtosSemEstoque', 'totalPedidos')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | LISTAGEM PRODUTOS
    |--------------------------------------------------------------------------
    */

    public function admin()
    {

        if (!session('funcionario')) {

            return redirect()
                ->route('funcionario.login');
        }

        $produtos = Produto::latest()->get();

        return view(
            'loja.admin',
            compact('produtos')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | TELA CADASTRO
    |--------------------------------------------------------------------------
    */

    public function cadastro()
    {

        if (!session('funcionario')) {

            return redirect()
                ->route('funcionario.login');
        }

        return view('loja.cadastro_produto');
    }

    /*
    |--------------------------------------------------------------------------
    | CADASTRAR PRODUTO
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {

        /*
        |--------------------------------------------------------------------------
        | IMAGEM PRINCIPAL
        |--------------------------------------------------------------------------
        */

        $imagem = null;

        if ($request->hasFile('imagem')) {

            $arquivo = $request->file('imagem');

            $imagem = time() . '_1.' .
                $arquivo->getClientOriginalExtension();

            $arquivo->move(
                public_path('uploads/produtos'),
                $imagem
            );
        }

        /*
        |--------------------------------------------------------------------------
        | IMAGEM 2
        |--------------------------------------------------------------------------
        */

        $imagem2 = null;

        if ($request->hasFile('imagem2')) {

            $arquivo = $request->file('imagem2');

            $imagem2 = time() . '_2.' .
                $arquivo->getClientOriginalExtension();

            $arquivo->move(
                public_path('uploads/produtos'),
                $imagem2
            );
        }

        /*
        |--------------------------------------------------------------------------
        | IMAGEM 3
        |--------------------------------------------------------------------------
        */

        $imagem3 = null;

        if ($request->hasFile('imagem3')) {

            $arquivo = $request->file('imagem3');

            $imagem3 = time() . '_3.' .
                $arquivo->getClientOriginalExtension();

            $arquivo->move(
                public_path('uploads/produtos'),
                $imagem3
            );
        }

        /*
        |--------------------------------------------------------------------------
        | IMAGEM 4
        |--------------------------------------------------------------------------
        */

        $imagem4 = null;

        if ($request->hasFile('imagem4')) {

            $arquivo = $request->file('imagem4');

            $imagem4 = time() . '_4.' .
                $arquivo->getClientOriginalExtension();

            $arquivo->move(
                public_path('uploads/produtos'),
                $imagem4
            );
        }

        /*
        |--------------------------------------------------------------------------
        | IMAGEM 5
        |--------------------------------------------------------------------------
        */

        $imagem5 = null;

        if ($request->hasFile('imagem5')) {

            $arquivo = $request->file('imagem5');

            $imagem5 = time() . '_5.' .
                $arquivo->getClientOriginalExtension();

            $arquivo->move(
                public_path('uploads/produtos'),
                $imagem5
            );
        }

        /*
        |--------------------------------------------------------------------------
        | CADASTRO
        |--------------------------------------------------------------------------
        */

        Produto::create([

            'nome'               => $request->nome,
            'categoria'          => $request->categoria,
            'status'             => $request->status,

            'destaque'           => $request->destaque ?? 0,
            'oferta'             => $request->oferta ?? 0,

            'preco'              => $request->preco,
            'preco_pix'          => $request->preco_pix,
            'preco_parcelado'    => $request->preco_parcelado,
            'parcelas'           => $request->parcelas,

            'estoque'            => $request->estoque,

            'descricao'          => $request->descricao,

            'imagem'             => $imagem,
            'imagem2'            => $imagem2,
            'imagem3'            => $imagem3,
            'imagem4'            => $imagem4,
            'imagem5'            => $imagem5

        ]);

        return redirect()
            ->route('funcionario.admin')
            ->with(
                'mensagem',
                'Produto cadastrado com sucesso!'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | TELA EDITAR
    |--------------------------------------------------------------------------
    */

    public function editar($id)
    {

        if (!session('funcionario')) {

            return redirect()
                ->route('funcionario.login');
        }

        $produto = Produto::findOrFail($id);

        return view(
            'loja.cadastro_produto',
            compact('produto')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ATUALIZAR PRODUTO
    |--------------------------------------------------------------------------
    */

    public function atualizar(Request $request, $id)
    {

        $produto = Produto::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | DADOS
        |--------------------------------------------------------------------------
        */

        $produto->nome               = $request->nome;
        $produto->categoria          = $request->categoria;
        $produto->status             = $request->status;

        $produto->destaque           = $request->destaque ?? 0;
        $produto->oferta             = $request->oferta ?? 0;

        $produto->preco              = $request->preco;
        $produto->preco_pix          = $request->preco_pix;
        $produto->preco_parcelado    = $request->preco_parcelado;
        $produto->parcelas           = $request->parcelas;

        $produto->estoque            = $request->estoque;

        $produto->descricao          = $request->descricao;

        /*
        |--------------------------------------------------------------------------
        | IMAGEM PRINCIPAL
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('imagem')) {

            $arquivo = $request->file('imagem');

            $imagem = time() . '_1.' .
                $arquivo->getClientOriginalExtension();

            $arquivo->move(
                public_path('uploads/produtos'),
                $imagem
            );

            $produto->imagem = $imagem;
        }

        /*
        |--------------------------------------------------------------------------
        | IMAGEM 2
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('imagem2')) {

            $arquivo = $request->file('imagem2');

            $imagem2 = time() . '_2.' .
                $arquivo->getClientOriginalExtension();

            $arquivo->move(
                public_path('uploads/produtos'),
                $imagem2
            );

            $produto->imagem2 = $imagem2;
        }

        /*
        |--------------------------------------------------------------------------
        | IMAGEM 3
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('imagem3')) {

            $arquivo = $request->file('imagem3');

            $imagem3 = time() . '_3.' .
                $arquivo->getClientOriginalExtension();

            $arquivo->move(
                public_path('uploads/produtos'),
                $imagem3
            );

            $produto->imagem3 = $imagem3;
        }

        /*
        |--------------------------------------------------------------------------
        | IMAGEM 4
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('imagem4')) {

            $arquivo = $request->file('imagem4');

            $imagem4 = time() . '_4.' .
                $arquivo->getClientOriginalExtension();

            $arquivo->move(
                public_path('uploads/produtos'),
                $imagem4
            );

            $produto->imagem4 = $imagem4;
        }

        /*
        |--------------------------------------------------------------------------
        | IMAGEM 5
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('imagem5')) {

            $arquivo = $request->file('imagem5');

            $imagem5 = time() . '_5.' .
                $arquivo->getClientOriginalExtension();

            $arquivo->move(
                public_path('uploads/produtos'),
                $imagem5
            );

            $produto->imagem5 = $imagem5;
        }

        $produto->save();

        return redirect()
            ->route('funcionario.admin')
            ->with(
                'mensagem',
                'Produto atualizado com sucesso!'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | EXCLUIR PRODUTO
    |--------------------------------------------------------------------------
    */

    public function excluir($id)
    {

        $produto = Produto::findOrFail($id);

        $produto->delete();

        return redirect()
            ->route('funcionario.admin')
            ->with(
                'mensagem',
                'Produto removido com sucesso!'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | PEDIDOS
    |--------------------------------------------------------------------------
    */

    public function pedidos()
    {

        if (!session('funcionario')) {

            return redirect()
                ->route('funcionario.login');
        }

        return view('loja.pedidos');
    }

    /*
    |--------------------------------------------------------------------------
    | CLIENTES
    |--------------------------------------------------------------------------
    */

    public function clientes(Request $request)
    {

        if (!session('funcionario')) {

            return redirect()
                ->route('funcionario.login');
        }

        $busca = $request->busca;

        $clientes = Cliente::when($busca, function ($query) use ($busca) {

            $query->where(
                'nome',
                'like',
                "%{$busca}%"
            )->orWhere(
                'email',
                'like',
                "%{$busca}%"
            );

        })->latest()->get();

        $totalClientes = Cliente::count();

        return view(
            'loja.clientes',
            compact(
                'clientes',
                'totalClientes',
                'busca'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | EXCLUIR CLIENTE
    |--------------------------------------------------------------------------
    */

    public function excluirCliente($id)
    {

        $cliente = Cliente::findOrFail($id);

        $cliente->delete();

        return redirect()
            ->route('funcionario.clientes')
            ->with(
                'mensagem',
                'Cliente excluído com sucesso!'
            );
    }
}