@extends('layout_cliente')

@section('contentcliente')
<link rel="stylesheet" href="{{ asset('/css/cliente/template_produto.css') }}">

<main class="conteudo-principal">

    <header class="store-page-header">
        <h1>Resultados da Busca</h1>
        <p>
            @if(strlen(trim($termo)) >= 2)
                Mostrando resultados para <strong>"{{ $termo }}"</strong>
            @else
                Digite pelo menos 2 caracteres para buscar.
            @endif
        </p>
    </header>

    <div class="store-results-bar">
        <span class="results-count">
            <strong>{{ $produtos->count() }}</strong>
            {{ $produtos->count() == 1 ? 'produto encontrado' : 'produtos encontrados' }}
        </span>
        <a href="{{ route('inicio') }}" class="link-back">
            <i class="fa-solid fa-arrow-left"></i> Voltar à loja
        </a>
    </div>

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
                <i class="fa-solid fa-box-open" style="font-size:3rem; color:#d1d5db; margin-bottom:1rem;"></i>
                <h3>Nenhum produto encontrado para "{{ $termo }}"</h3>
                <p style="color:#6b7280; margin-top:0.5rem;">Tente termos diferentes ou navegue pelas categorias.</p>
                <div style="margin-top:1.5rem; display:flex; gap:12px; justify-content:center; flex-wrap:wrap;">
                    <a href="{{ route('loja.monitores') }}" class="btn btn-outline">Monitores</a>
                    <a href="{{ route('loja.perifericos') }}" class="btn btn-outline">Periféricos</a>
                    <a href="{{ route('loja.acessorios') }}" class="btn btn-outline">Acessórios</a>
                </div>
            </div>

        @endforelse

    </section>

</main>

@endsection
