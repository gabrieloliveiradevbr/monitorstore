@extends('layout_funcionario')

@section('conteudo')

<link rel="stylesheet" href="{{ asset('/css/loja/clientes.css') }}">

<div class="page-header">

    <h2>Gerenciamento de Clientes</h2>

    <p>
        Visualize e gerencie os clientes cadastrados na loja.
    </p>

</div>

<section class="summary-cards">

    <div class="summary-card">
        <div class="card-icon">
            <i class="fa-solid fa-users"></i>
        </div>

        <div class="card-info">
            <h3>Total de Clientes</h3>
            <span class="card-number">{{ $totalClientes }}</span>
        </div>
    </div>

    <div class="summary-card">
        <div class="card-icon">
            <i class="fa-solid fa-user-check"></i>
        </div>

        <div class="card-info">
            <h3>Clientes Ativos</h3>
            <span class="card-number">{{ $totalClientes }}</span>
        </div>
    </div>

    <div class="summary-card">
        <div class="card-icon">
            <i class="fa-solid fa-user-plus"></i>
        </div>

        <div class="card-info">
            <h3>Novos no Mês</h3>

            <span class="card-number">
                {{
                    $clientes->filter(function ($cliente) {
                        return \Carbon\Carbon::parse($cliente->created_at)->month == now()->month
                        && \Carbon\Carbon::parse($cliente->created_at)->year == now()->year;
                    })->count()
                }}
            </span>
        </div>
    </div>

</section>

<section class="admin-card">

    <form action="{{ route('funcionario.clientes') }}" method="GET" class="action-bar-container">

        <div class="search-box">

            <i class="fa-solid fa-magnifying-glass"></i>

            <input
                type="text"
                name="busca"
                value="{{ $busca ?? '' }}"
                placeholder="Buscar cliente por nome ou e-mail..."
            >

        </div>

        <div class="action-buttons-bar">

            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-magnifying-glass"></i>
                Buscar
            </button>

            @if(!empty($busca))
                <a href="{{ route('funcionario.clientes') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-xmark"></i>
                    Limpar
                </a>
            @endif

        </div>

    </form>

</section>

<section class="admin-card">

    <div class="table-responsive">

        <table class="admin-table striped-table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Endereço</th>
                    <th>Cadastro</th>
                    <th>Status</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>

            <tbody>

                @forelse($clientes as $cliente)

                <tr>
                    <td><strong>#{{ $cliente->id }}</strong></td>
                    <td>{{ $cliente->nome }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->telefone }}</td>
                    <td>{{ $cliente->endereco }}</td>

                    <td>
                        {{ \Carbon\Carbon::parse($cliente->created_at)->format('d/m/Y') }}
                    </td>

                    <td>
                        <span class="badge-status ativo">Ativo</span>
                    </td>

                    <td class="action-buttons text-center">

                        <form
                            action="{{ route('funcionario.cliente.excluir', $cliente->id) }}"
                            method="POST"
                            onsubmit="return confirm('Deseja excluir este cliente?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn-action delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="8" style="text-align:center; padding:30px;">
                        Nenhum cliente cadastrado.
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</section>

@endsection