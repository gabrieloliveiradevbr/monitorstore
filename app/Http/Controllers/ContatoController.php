<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nome'     => 'required|string|min:2|max:100',
            'email'    => 'required|email|max:100',
            'assunto'  => 'required|string|min:3|max:150',
            'mensagem' => 'required|string|min:10',
        ], [
            'nome.required'     => 'O nome é obrigatório.',
            'email.required'    => 'O e-mail é obrigatório.',
            'email.email'       => 'Informe um e-mail válido.',
            'assunto.required'  => 'O assunto é obrigatório.',
            'mensagem.required' => 'A mensagem é obrigatória.',
            'mensagem.min'      => 'A mensagem deve ter pelo menos 10 caracteres.',
        ]);

        // Aqui você pode enviar e-mail, salvar em banco, etc.
        // Por ora, apenas retornamos a mensagem de sucesso.

        return redirect()
            ->route('loja.contato')
            ->with('mensagem_sucesso', 'Sua mensagem foi enviada com sucesso! Retornaremos em até 24 horas.');
    }
}
