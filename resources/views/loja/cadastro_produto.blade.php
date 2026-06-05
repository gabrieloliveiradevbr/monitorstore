@extends('layout_funcionario')

@section('conteudo')

<link rel="stylesheet" href="{{ asset('/css/loja/cadastro_produto.css') }}">

<main class="admin-conteudo">

    @if(session('mensagem'))

        <script>
            window.onload = function () {
                alert("{{ session('mensagem') }}");
            }
        </script>

    @endif

    <div class="page-header">

        <h2>
            {{ isset($produto) ? 'Editar Produto' : 'Cadastrar Produto' }}
        </h2>

        <p>
            {{ isset($produto)
                ? 'Atualize as informações do produto.'
                : 'Preencha as informações abaixo para adicionar um novo produto ao catálogo da loja.' }}
        </p>

    </div>

    <section class="admin-card">

        <form
            action="{{ isset($produto)
                ? route('funcionario.produto.atualizar', $produto->id)
                : route('funcionario.produto.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="admin-form"
        >

            @csrf

            <div class="form-grid">

                {{-- NOME --}}
                <div class="form-group span-2">

                    <label for="nome">
                        Nome do Produto *
                    </label>

                    <input
                        type="text"
                        id="nome"
                        name="nome"
                        class="form-control"
                        value="{{ old('nome', $produto->nome ?? '') }}"
                        placeholder="Ex: Monitor Gamer 27 IPS 144Hz"
                        required
                    >

                </div>

                {{-- CATEGORIA --}}
                <div class="form-group">

                    <label for="categoria">
                        Categoria *
                    </label>

                    <select
                        id="categoria"
                        name="categoria"
                        class="form-control"
                        required
                    >

                        <option value="">
                            Selecione...
                        </option>

                        <option
                            value="Monitores Home-Office"
                            {{ old('categoria', $produto->categoria ?? '') == 'Monitores Home-Office' ? 'selected' : '' }}
                        >
                            Monitores Home-Office
                        </option>

                        <option
                            value="Monitores Smart"
                            {{ old('categoria', $produto->categoria ?? '') == 'Monitores Smart' ? 'selected' : '' }}
                        >
                            Monitores Smart
                        </option>

                        <option
                            value="Monitores Portateis"
                            {{ old('categoria', $produto->categoria ?? '') == 'Monitores Portateis' ? 'selected' : '' }}
                        >
                            Monitores Portateis
                        </option>

                        <option
                            value="Monitores Gamer"
                            {{ old('categoria', $produto->categoria ?? '') == 'Monitores Gamer' ? 'selected' : '' }}
                        >
                            Monitores Gamer
                        </option>

                        <option
                            value="Monitores Profissionais"
                            {{ old('categoria', $produto->categoria ?? '') == 'Monitores Profissionais' ? 'selected' : '' }}
                        >
                            Monitores Profissionais
                        </option>

                        <option
                            value="Acessórios"
                            {{ old('categoria', $produto->categoria ?? '') == 'Acessórios' ? 'selected' : '' }}
                        >
                            Acessórios
                        </option>

                        <option
                            value="Periféricos"
                            {{ old('categoria', $produto->categoria ?? '') == 'Periféricos' ? 'selected' : '' }}
                        >
                            Periféricos
                        </option>

                    </select>

                </div>

                {{-- STATUS --}}
                <div class="form-group">

                    <label for="status">
                        Status do Produto *
                    </label>

                    <select
                        id="status"
                        name="status"
                        class="form-control"
                        required
                    >

                        <option
                            value="ativo"
                            {{ old('status', $produto->status ?? '') == 'ativo' ? 'selected' : '' }}
                        >
                            Ativo
                        </option>

                        <option
                            value="inativo"
                            {{ old('status', $produto->status ?? '') == 'inativo' ? 'selected' : '' }}
                        >
                            Inativo
                        </option>

                    </select>

                </div>

                {{-- DESTAQUE --}}
                <div class="form-group">

                    <label for="destaque">
                        Produto em Destaque?
                    </label>

                    <select
                        id="destaque"
                        name="destaque"
                        class="form-control"
                    >

                        <option
                            value="0"
                            {{ old('destaque', $produto->destaque ?? 0) == 0 ? 'selected' : '' }}
                        >
                            Não
                        </option>

                        <option
                            value="1"
                            {{ old('destaque', $produto->destaque ?? 0) == 1 ? 'selected' : '' }}
                        >
                            Sim
                        </option>

                    </select>

                </div>

                {{-- OFERTA --}}
                <div class="form-group">

                    <label for="oferta">
                        Produto em Oferta?
                    </label>

                    <select
                        id="oferta"
                        name="oferta"
                        class="form-control"
                    >

                        <option
                            value="0"
                            {{ old('oferta', $produto->oferta ?? 0) == 0 ? 'selected' : '' }}
                        >
                            Não
                        </option>

                        <option
                            value="1"
                            {{ old('oferta', $produto->oferta ?? 0) == 1 ? 'selected' : '' }}
                        >
                            Sim
                        </option>

                    </select>

                </div>

                {{-- PREÇO NORMAL --}}
                <div class="form-group">

                    <label for="preco">
                        Preço Normal (R$) *
                    </label>

                    <input
                        type="number"
                        id="preco"
                        name="preco"
                        class="form-control"
                        step="0.01"
                        min="0"
                        value="{{ old('preco', $produto->preco ?? '') }}"
                        placeholder="0.00"
                        required
                    >

                </div>

                {{-- PREÇO PIX --}}
                <div class="form-group">

                    <label for="preco_pix">
                        Preço à Vista / Pix (R$)
                    </label>

                    <input
                        type="number"
                        id="preco_pix"
                        name="preco_pix"
                        class="form-control"
                        step="0.01"
                        min="0"
                        value="{{ old('preco_pix', $produto->preco_pix ?? '') }}"
                        placeholder="0.00"
                    >

                </div>

                {{-- PREÇO PARCELADO --}}
                <div class="form-group">

                    <label for="preco_parcelado">
                        Preço Parcelado (R$)
                    </label>

                    <input
                        type="number"
                        id="preco_parcelado"
                        name="preco_parcelado"
                        class="form-control"
                        step="0.01"
                        min="0"
                        value="{{ old('preco_parcelado', $produto->preco_parcelado ?? '') }}"
                        placeholder="0.00"
                    >

                </div>

                {{-- PARCELAS --}}
                <div class="form-group">

                    <label for="parcelas">
                        Quantidade de Parcelas
                    </label>

                    <input
                        type="number"
                        id="parcelas"
                        name="parcelas"
                        class="form-control"
                        min="1"
                        value="{{ old('parcelas', $produto->parcelas ?? 12) }}"
                        placeholder="12"
                    >

                </div>

                {{-- ESTOQUE --}}
                <div class="form-group">

                    <label for="estoque">
                        Quantidade em Estoque *
                    </label>

                    <input
                        type="number"
                        id="estoque"
                        name="estoque"
                        class="form-control"
                        min="0"
                        value="{{ old('estoque', $produto->estoque ?? '') }}"
                        placeholder="0"
                        required
                    >

                </div>

                {{-- IMAGEM PRINCIPAL --}}
                <div class="form-group span-2">

                    <label for="imagem">
                        Imagem Principal
                    </label>

                    <input
                        type="file"
                        id="imagem"
                        name="imagem"
                        class="form-control file-input"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <small class="text-muted">
                        Esta será a imagem de capa do produto.
                    </small>

                </div>

                {{-- IMAGEM 2 --}}
                <div class="form-group">

                    <label for="imagem2">
                        Imagem 2
                    </label>

                    <input
                        type="file"
                        id="imagem2"
                        name="imagem2"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                </div>

                {{-- IMAGEM 3 --}}
                <div class="form-group">

                    <label for="imagem3">
                        Imagem 3
                    </label>

                    <input
                        type="file"
                        id="imagem3"
                        name="imagem3"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                </div>

                {{-- IMAGEM 4 --}}
                <div class="form-group">

                    <label for="imagem4">
                        Imagem 4
                    </label>

                    <input
                        type="file"
                        id="imagem4"
                        name="imagem4"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                </div>

                {{-- IMAGEM 5 --}}
                <div class="form-group">

                    <label for="imagem5">
                        Imagem 5
                    </label>

                    <input
                        type="file"
                        id="imagem5"
                        name="imagem5"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                </div>

                {{-- IMAGENS ATUAIS --}}
                @if(isset($produto))

                    <div class="form-group span-2">

                        <h3 style="margin-bottom:20px;">
                            Imagens Atuais
                        </h3>

                        <div style="
                            display:flex;
                            gap:15px;
                            flex-wrap:wrap;
                        ">

                            @if($produto->imagem)

                                <img
                                    src="{{ asset('uploads/produtos/' . $produto->imagem) }}"
                                    style="
                                        width:120px;
                                        border-radius:10px;
                                        border:1px solid #ddd;
                                        padding:5px;
                                    "
                                >

                            @endif

                            @if($produto->imagem2)

                                <img
                                    src="{{ asset('uploads/produtos/' . $produto->imagem2) }}"
                                    style="
                                        width:120px;
                                        border-radius:10px;
                                        border:1px solid #ddd;
                                        padding:5px;
                                    "
                                >

                            @endif

                            @if($produto->imagem3)

                                <img
                                    src="{{ asset('uploads/produtos/' . $produto->imagem3) }}"
                                    style="
                                        width:120px;
                                        border-radius:10px;
                                        border:1px solid #ddd;
                                        padding:5px;
                                    "
                                >

                            @endif

                            @if($produto->imagem4)

                                <img
                                    src="{{ asset('uploads/produtos/' . $produto->imagem4) }}"
                                    style="
                                        width:120px;
                                        border-radius:10px;
                                        border:1px solid #ddd;
                                        padding:5px;
                                    "
                                >

                            @endif

                            @if($produto->imagem5)

                                <img
                                    src="{{ asset('uploads/produtos/' . $produto->imagem5) }}"
                                    style="
                                        width:120px;
                                        border-radius:10px;
                                        border:1px solid #ddd;
                                        padding:5px;
                                    "
                                >

                            @endif

                        </div>

                    </div>

                @endif

                {{-- DESCRIÇÃO --}}
                <div class="form-group span-2">

                    <label for="descricao">
                        Descrição Completa
                    </label>

                    <textarea
                        id="descricao"
                        name="descricao"
                        class="form-control textarea-large"
                        placeholder="Descreva os detalhes técnicos do produto..."
                    >{{ old('descricao', $produto->descricao ?? '') }}</textarea>

                </div>

            </div>

            <div class="form-actions">

                <a
                    href="{{ route('funcionario.admin') }}"
                    class="btn btn-secondary"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >

                    <i class="fa-solid fa-check"></i>

                    {{ isset($produto)
                        ? 'Atualizar Produto'
                        : 'Cadastrar Produto' }}

                </button>

            </div>

        </form>

    </section>

</main>

@endsection
