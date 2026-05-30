@extends('layout_funcionario')

@section('conteudo')

<link rel="stylesheet" href="{{ asset('/css/loja/admin.css') }}">

<div class="admin-page-header">

    <div class="page-title">

        <h1>Gerenciar Produtos</h1>

        <p>
            Adicione, edite ou remova produtos do catálogo da loja.
        </p>

    </div>

    <div class="page-actions">

        <a href="{{ route('funcionario.cadastro') }}"
           class="btn btn-primary">

            <i class="fa-solid fa-plus"></i>
            Novo Produto

        </a>

    </div>

</div>

@if(session('mensagem'))

<script>

window.onload = function () {

    alert("{{ session('mensagem') }}");

}

</script>

@endif

<section class="admin-card">

    <div class="table-responsive">

        <table class="admin-table">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Status</th>
                    <th>Ações</th>

                </tr>

            </thead>

            <tbody>

                @forelse($produtos as $produto)

                <tr>

                    <td>
                        #{{ $produto->id }}
                    </td>

                    <td>

                        <img
                            src="{{ asset('uploads/produtos/' . $produto->imagem) }}"
                            alt="{{ $produto->nome }}"
                            class="table-img"
                        >

                    </td>

                    <td>

                        <strong>
                            {{ $produto->nome }}
                        </strong>

                    </td>

                    <td>
                        {{ $produto->categoria }}
                    </td>

                    <td>

                        R$
                        {{ number_format($produto->preco, 2, ',', '.') }}

                    </td>

                    <td>

                        @if($produto->estoque > 10)

                            <span class="badge-stock success">
                                {{ $produto->estoque }} un.
                            </span>

                        @elseif($produto->estoque > 0)

                            <span class="badge-stock warning">
                                {{ $produto->estoque }} un.
                            </span>

                        @else

                            <span class="badge-stock danger">
                                Sem estoque
                            </span>

                        @endif

                    </td>

                    <td>

                        {{ ucfirst($produto->status) }}

                    </td>

                    <td>

                        <div class="action-buttons">

                            <a
                                href="{{ route('funcionario.produto.editar', $produto->id) }}"
                                class="btn-icon edit"
                                title="Editar"
                            >

                                <i class="fa-solid fa-pen"></i>

                            </a>

                            <form
                                action="{{ route('funcionario.produto.excluir', $produto->id) }}"
                                method="POST"
                            >

                                @csrf
                                @method('DELETE')

                                <a
                                    href="{{ route('funcionario.produto.excluir', $produto->id) }}"
                                    class="btn-icon delete"
                                    onclick="return confirm('Deseja excluir este produto?')"
                                >

                                    <i class="fa-solid fa-trash"></i>

                                </a>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="8" style="text-align:center; padding:30px;">

                        Nenhum produto cadastrado.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</section>

@endsection