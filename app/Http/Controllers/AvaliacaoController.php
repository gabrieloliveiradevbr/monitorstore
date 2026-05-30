<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avaliacao;
use Illuminate\Support\Facades\Session;

class AvaliacaoController extends Controller
{
    public function store(Request $request)
    {
        $clienteId = Session::get('cliente_id');

        if (!$clienteId) {
            return redirect()->route('login')->with('mensagem', 'Você precisa estar logado para avaliar este produto!');
        }

        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'nota' => 'required|integer|min:1|max:5',
            'comentario' => 'required|string|min:5',
        ]);

        // Evitar que o mesmo cliente avalie o mesmo produto mais de uma vez
        $existente = Avaliacao::where('produto_id', $request->produto_id)
                               ->where('cliente_id', $clienteId)
                               ->first();

        if ($existente) {
            return redirect()->back()->with('mensagem', 'Você já avaliou este produto!');
        }

        Avaliacao::create([
            'produto_id' => $request->produto_id,
            'cliente_id' => $clienteId,
            'nota' => $request->nota,
            'comentario' => $request->comentario,
        ]);

        return redirect()->back()->with('mensagem', 'Sua avaliação foi enviada com sucesso!');
    }
}
