@extends('layout_cliente')

@section('contentcliente')
<link rel="stylesheet" href="{{ asset('/css/cliente/template_produto.css') }}">

@php $filtros = $filtros ?? []; @endphp

<main class="conteudo-principal">

    {{-- ===== HEADER ===== --}}
    <header class="store-page-header">
        <h1>Monitores</h1>
        <p>Encontre a tela perfeita para elevar seu setup de trabalho, estudo ou gameplay.</p>
    </header>

    {{-- ===== FILTROS ===== --}}
    <section class="store-filter-bar">
        <form action="{{ route('loja.monitores') }}" method="GET" class="filter-form">

            <div class="filter-group">
                <label for="marca">Marca</label>
                <select name="marca" id="marca" class="filter-select">
                    <option value="">Todas as Marcas</option>
                    @foreach(['LG','Samsung','Dell','AOC','Asus','BenQ','Philips','ViewSonic'] as $m)
                        <option value="{{ $m }}" {{ ($filtros['marca'] ?? '') == $m ? 'selected' : '' }}>{{ $m }}</option>
                    @endforeach
                </select>
            </div>

            <div class="filter-group">
                <label for="preco">Preço</label>
                <select name="preco" id="preco" class="filter-select">
                    <option value="">Qualquer Preço</option>
                    <option value="ate-1000"  {{ ($filtros['preco'] ?? '') == 'ate-1000'  ? 'selected' : '' }}>Até R$ 1.000</option>
                    <option value="1000-2000" {{ ($filtros['preco'] ?? '') == '1000-2000' ? 'selected' : '' }}>R$ 1.000 a R$ 2.000</option>
                    <option value="acima-2000"{{ ($filtros['preco'] ?? '') == 'acima-2000'? 'selected' : '' }}>Acima de R$ 2.000</option>
                </select>
            </div>

            <div class="filter-group">
                <label for="ordenar">Ordenar por</label>
                <select name="ordenar" id="ordenar" class="filter-select">
                    <option value="relevancia"  {{ ($filtros['ordenar'] ?? '') == 'relevancia'   ? 'selected' : '' }}>Relevância</option>
                    <option value="menor-preco" {{ ($filtros['ordenar'] ?? '') == 'menor-preco'  ? 'selected' : '' }}>Menor Preço</option>
                    <option value="maior-preco" {{ ($filtros['ordenar'] ?? '') == 'maior-preco'  ? 'selected' : '' }}>Maior Preço</option>
                    <option value="lancamentos" {{ ($filtros['ordenar'] ?? '') == 'lancamentos'  ? 'selected' : '' }}>Lançamentos</option>
                </select>
            </div>

            <div class="filter-action">
                <button type="submit" class="btn-filter">
                    <i class="fa-solid fa-sliders"></i> Filtrar
                </button>
                @if(array_filter($filtros))
                    <a href="{{ route('loja.monitores') }}" class="btn-filter-clear" title="Limpar filtros">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                @endif
            </div>

        </form>
    </section>

    {{-- ===== CONTAGEM DE RESULTADOS ===== --}}
    <div class="store-results-bar">
        <span class="results-count">
            <strong>{{ $produtos->count() }}</strong>
            {{ $produtos->count() == 1 ? 'produto encontrado' : 'produtos encontrados' }}
        </span>
        @if(session('mensagem'))
            <div class="flash-inline flash-success">
                <i class="fa-solid fa-circle-check"></i> {{ session('mensagem') }}
            </div>
        @endif
    </div>

    {{-- ===== GRID DE PRODUTOS ===== --}}
    <section class="store-product-grid">

        @forelse($produtos as $produto)

            <article class="store-card">

                <div class="card-image-wrapper">
                    @if($produto->imagem)
                        <img src="{{ asset('uploads/produtos/' . $produto->imagem) }}" alt="{{ $produto->nome }}">
                    @else
                        <img src="https://via.placeholder.com/400x300?text=Sem+Imagem" alt="Sem imagem">
                    @endif

                    @if($produto->oferta)
                        <span class="card-badge-img">OFERTA</span>
                    @endif
                </div>

                <div class="card-content">
                    <span class="card-brand">{{ $produto->categoria }}</span>
                    <h2 class="card-title">{{ $produto->nome }}</h2>
                    <p class="card-desc">{{ \Illuminate\Support\Str::limit($produto->descricao, 80, '...') }}</p>

                    <div class="card-pricing">
                        @if($produto->preco && $produto->preco_pix && $produto->preco > $produto->preco_pix)
                            <span class="card-price-old">R$ {{ number_format($produto->preco, 2, ',', '.') }}</span>
                        @endif
                        <div class="card-price">R$ {{ number_format($produto->preco_pix ?? $produto->preco, 2, ',', '.') }}</div>
                        @if($produto->preco_parcelado && $produto->parcelas)
                            <span class="card-installments">em {{ $produto->parcelas }}x de R$ {{ number_format($produto->preco_parcelado / $produto->parcelas, 2, ',', '.') }}</span>
                        @endif
                    </div>
                </div>

                <div class="card-actions">
                    {{-- Form POST para adicionar ao carrinho --}}
                    <form method="POST" action="{{ route('carrinho.adicionar') }}" class="form-add-cart">
                        @csrf
                        <input type="hidden" name="produto_id" value="{{ $produto->id }}">
                        <input type="hidden" name="quantidade" value="1">
                        <input type="hidden" name="acao" value="adicionar">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-cart-shopping"></i> Adicionar
                        </button>
                    </form>

                    <a href="{{ route('loja.produto', $produto->id) }}" class="btn btn-outline">
                        Ver detalhes
                    </a>
                </div>

            </article>

        @empty

            <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
                <i class="fa-solid fa-magnifying-glass" style="font-size:3rem; color:#d1d5db; margin-bottom:1rem;"></i>
                <h3>Nenhum monitor encontrado.</h3>
                <p style="color:#6b7280; margin-top:0.5rem;">Tente outros filtros ou <a href="{{ route('loja.monitores') }}">limpe os filtros</a>.</p>
            </div>

        @endforelse

    </section>

</main>

@endsection