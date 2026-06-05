<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class LojaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HOME
    |--------------------------------------------------------------------------
    */

    public function home()
    {
        $destaques = Produto::where('destaque', 1)
            ->where('status', 'ativo')
            ->latest()
            ->take(4)
            ->get();

        $ofertas = Produto::where('oferta', 1)
            ->where('status', 'ativo')
            ->latest()
            ->take(4)
            ->get();

        return view(
            'cliente.home',
            compact('destaques', 'ofertas')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | MONITORES (com filtros)
    |--------------------------------------------------------------------------
    */

    public function monitores(Request $request)
    {
        $query = Produto::where(function ($q) {
            $q->where('categoria', 'Monitores Gamer')
                ->orWhere('categoria', 'Monitores Profissionais')
                ->orWhere('categoria', 'Monitores Home-Office')
                ->orWhere('categoria', 'Monitores Smart')
                ->orWhere('categoria', 'Monitores Portateis');
        })->where('status', 'ativo');

        $query = $this->aplicarFiltros($query, $request);

        $produtos = $query->get();
        $filtros  = $request->only(['marca', 'preco', 'ordenar', 'busca']);

        return view('cliente.monitores', compact('produtos', 'filtros'));
    }

    /*
    |--------------------------------------------------------------------------
    | PERIFÉRICOS (com filtros)
    |--------------------------------------------------------------------------
    */

    public function perifericos(Request $request)
    {
        $query = Produto::where('categoria', 'Periféricos')
            ->where('status', 'ativo');

        $query = $this->aplicarFiltros($query, $request);

        $produtos = $query->get();
        $filtros  = $request->only(['marca', 'preco', 'ordenar', 'busca']);

        return view('cliente.perifericos', compact('produtos', 'filtros'));
    }

    /*
    |--------------------------------------------------------------------------
    | ACESSÓRIOS (com filtros)
    |--------------------------------------------------------------------------
    */

    public function acessorios(Request $request)
    {
        $query = Produto::where('categoria', 'Acessórios')
            ->where('status', 'ativo');

        $query = $this->aplicarFiltros($query, $request);

        $produtos = $query->get();
        $filtros  = $request->only(['marca', 'preco', 'ordenar', 'busca']);

        return view('cliente.acessorios', compact('produtos', 'filtros'));
    }

    /*
    |--------------------------------------------------------------------------
    | BUSCA GLOBAL
    |--------------------------------------------------------------------------
    */

    public function busca(Request $request)
    {
        $termo = $request->input('q', '');

        $produtos = collect();

        if (strlen(trim($termo)) >= 2) {
            $produtos = Produto::where('status', 'ativo')
                ->where(function ($q) use ($termo) {
                    $q->where('nome', 'like', "%{$termo}%")
                        ->orWhere('descricao', 'like', "%{$termo}%")
                        ->orWhere('categoria', 'like', "%{$termo}%");
                })
                ->latest()
                ->get();
        }

        return view('cliente.busca', compact('produtos', 'termo'));
    }

    /*
    |--------------------------------------------------------------------------
    | PRODUTO INDIVIDUAL
    |--------------------------------------------------------------------------
    */

    public function produto($id)
    {
        $produto = Produto::where('status', 'ativo')
            ->with('avaliacoes.cliente')
            ->findOrFail($id);

        $relacionados = Produto::where('categoria', $produto->categoria)
            ->where('id', '!=', $produto->id)
            ->where('status', 'ativo')
            ->latest()
            ->take(4)
            ->get();

        $mediaNota = $produto->avaliacoes()->avg('nota') ?? 0;

        return view(
            'cliente.produto',
            compact('produto', 'relacionados', 'mediaNota')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER: Aplicar filtros comuns
    |--------------------------------------------------------------------------
    */

    private function aplicarFiltros($query, Request $request)
    {
        // Filtro por marca (busca no nome do produto)
        if ($request->filled('marca')) {
            $query->where('nome', 'like', '%' . $request->marca . '%');
        }

        // Filtro por faixa de preço
        if ($request->filled('preco')) {
            switch ($request->preco) {
                case 'ate-500':
                    $query->where('preco_pix', '<=', 500);
                    break;
                case 'ate-1000':
                    $query->where('preco_pix', '<=', 1000);
                    break;
                case '500-1000':
                    $query->whereBetween('preco_pix', [500, 1000]);
                    break;
                case '1000-2000':
                    $query->whereBetween('preco_pix', [1000, 2000]);
                    break;
                case 'ate-150':
                    $query->where('preco_pix', '<=', 150);
                    break;
                case '150-300':
                    $query->whereBetween('preco_pix', [150, 300]);
                    break;
                case 'acima-300':
                    $query->where('preco_pix', '>', 300);
                    break;
                case 'ate-200':
                    $query->where('preco_pix', '<=', 200);
                    break;
                case '200-500':
                    $query->whereBetween('preco_pix', [200, 500]);
                    break;
                case 'acima-500':
                    $query->where('preco_pix', '>', 500);
                    break;
                case 'acima-2000':
                    $query->where('preco_pix', '>', 2000);
                    break;
            }
        }

        // Ordenação
        switch ($request->ordenar) {
            case 'menor-preco':
                $query->orderBy('preco_pix', 'asc');
                break;
            case 'maior-preco':
                $query->orderBy('preco_pix', 'desc');
                break;
            case 'lancamentos':
                $query->latest();
                break;
            default:
                // relevância = destaques primeiro, depois mais recentes
                $query->orderBy('destaque', 'desc')->latest();
                break;
        }

        return $query;
    }
}
