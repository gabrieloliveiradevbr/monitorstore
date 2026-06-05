@extends('layout_cliente')

@section('contentcliente')

<link rel="stylesheet" href="{{ asset('/css/cliente/produto.css') }}">

<main class="conteudo-principal product-page">

    {{-- ============================= --}}
    {{-- TOPO DO PRODUTO --}}
    {{-- ============================= --}}
    <div class="product-top-grid">

        {{-- GALERIA --}}
        <div class="product-gallery">

            <div class="main-image store-card">

                <img
                    id="main-img"
                    src="{{ asset('uploads/produtos/' . $produto->imagem) }}"
                    alt="{{ $produto->nome }}"
                >

            </div>

            <div class="thumbnails">

                {{-- IMAGEM PRINCIPAL --}}
                @if($produto->imagem)

                    <div
                        class="thumb store-card active"
                        onclick="trocarImagem(this, '{{ asset('uploads/produtos/' . $produto->imagem) }}')"
                    >

                        <img
                            src="{{ asset('uploads/produtos/' . $produto->imagem) }}"
                            alt="{{ $produto->nome }}"
                        >

                    </div>

                @endif

                {{-- IMAGEM 2 --}}
                @if($produto->imagem2)

                    <div
                        class="thumb store-card"
                        onclick="trocarImagem(this, '{{ asset('uploads/produtos/' . $produto->imagem2) }}')"
                    >

                        <img
                            src="{{ asset('uploads/produtos/' . $produto->imagem2) }}"
                            alt="{{ $produto->nome }}"
                        >

                    </div>

                @endif

                {{-- IMAGEM 3 --}}
                @if($produto->imagem3)

                    <div
                        class="thumb store-card"
                        onclick="trocarImagem(this, '{{ asset('uploads/produtos/' . $produto->imagem3) }}')"
                    >

                        <img
                            src="{{ asset('uploads/produtos/' . $produto->imagem3) }}"
                            alt="{{ $produto->nome }}"
                        >

                    </div>

                @endif

                {{-- IMAGEM 4 --}}
                @if($produto->imagem4)

                    <div
                        class="thumb store-card"
                        onclick="trocarImagem(this, '{{ asset('uploads/produtos/' . $produto->imagem4) }}')"
                    >

                        <img
                            src="{{ asset('uploads/produtos/' . $produto->imagem4) }}"
                            alt="{{ $produto->nome }}"
                        >

                    </div>

                @endif

                {{-- IMAGEM 5 --}}
                @if($produto->imagem5)

                    <div
                        class="thumb store-card"
                        onclick="trocarImagem(this, '{{ asset('uploads/produtos/' . $produto->imagem5) }}')"
                    >

                        <img
                            src="{{ asset('uploads/produtos/' . $produto->imagem5) }}"
                            alt="{{ $produto->nome }}"
                        >

                    </div>

                @endif

            </div>

        </div>

        {{-- INFORMAÇÕES --}}
        <div class="product-info-container">

            <div class="product-header">

                <span class="product-brand">
                    {{ $produto->categoria }}
                </span>

                <h1 class="product-title">
                    {{ $produto->nome }}
                </h1>
                <div class="product-rating-summary">
                    <div class="stars">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fa-solid fa-star {{ $i <= round($mediaNota) ? 'active' : 'inactive' }}"></i>
                        @endfor
                    </div>
                    <span class="rating-text">
                        {{ number_format($mediaNota, 1) }} ({{ $produto->avaliacoes->count() }} avaliações)
                    </span>
                </div>

            </div>

            {{-- BADGES --}}
            <div class="product-badges">

                @if($produto->estoque > 0)

                    <span class="badge-item badge-stock">

                        <i class="fa-solid fa-circle-check"></i>

                        Em estoque

                    </span>

                @else

                    <span class="badge-item badge-danger">

                        <i class="fa-solid fa-circle-xmark"></i>

                        Produto indisponível

                    </span>

                @endif

                @if($produto->oferta == 1)

                    <span class="badge-item badge-offer">

                        <i class="fa-solid fa-fire"></i>

                        Em Oferta

                    </span>

                @endif

            </div>

            {{-- DESCRIÇÃO --}}
            <p class="product-short-desc" >

                {{ $produto->descricao }}

            </p>

            {{-- PREÇOS --}}
            <div class="product-pricing">

                @if($produto->preco > $produto->preco_pix)

                    <span class="old-price">

                        De
                        <s>
                            R$
                            {{ number_format($produto->preco, 2, ',', '.') }}
                        </s>

                    </span>

                @endif

                <div class="pricing-row">

                    <span class="current-price">

                        R$
                        {{ number_format($produto->preco_pix, 2, ',', '.') }}

                    </span>

                    @if($produto->oferta == 1 && $produto->preco > $produto->preco_pix)

                        <span class="discount-badge">

                            -{{
                                round(
                                    (
                                        ($produto->preco - $produto->preco_pix)
                                        / $produto->preco
                                    ) * 100
                                )
                            }}%

                        </span>

                    @endif

                </div>

                @if($produto->preco_parcelado)

                    <span class="installments">

                        ou em até

                        <strong>

                            {{ $produto->parcelas }}x de
                            R$
                            {{
                                number_format(
                                    $produto->preco_parcelado /
                                    $produto->parcelas,
                                    2,
                                    ',',
                                    '.'
                                )
                            }}

                        </strong>

                        sem juros

                    </span>

                @endif

            </div>

            {{-- FORMULÁRIO --}}
            <form
                method="POST"
                action="{{ route('carrinho.adicionar') }}"
                class="product-buy-form"
            >

                @csrf

                <input
                    type="hidden"
                    name="produto_id"
                    value="{{ $produto->id }}"
                >

                {{-- QUANTIDADE --}}
                <div class="quantity-selector">

                    <label for="quantidade">
                        Quantidade
                    </label>

                    <div class="qty-control">

                        <button
                            type="button"
                            class="qty-btn"
                            onclick="alterarQtd(-1)"
                        >
                            &minus;</button>

                        <input
                            type="number"
                            id="quantidade"
                            name="quantidade"
                            value="1"
                            min="1"
                            max="{{ $produto->estoque }}"
                            class="qty-input"
                        >

                        <button
                            type="button"
                            class="qty-btn"
                            onclick="alterarQtd(1)"
                        >
                            +
                        </button>

                    </div>

                    <span class="stock-hint">

                        {{ $produto->estoque }}
                        unidades disponíveis

                    </span>

                </div>

                {{-- BOTÕES --}}
                <div class="action-buttons">

                    <button
                        type="submit"
                        name="acao"
                        value="adicionar"
                        class="btn btn-outline btn-cart"
                        id="btn-add-cart"
                    >

                        <i class="fa-solid fa-cart-plus"></i>

                        Adicionar ao Carrinho

                    </button>

                    <button
                        type="submit"
                        name="acao"
                        value="comprar"
                        class="btn btn-primary btn-buy"
                    >

                        <i class="fa-solid fa-bolt"></i>

                        Comprar Agora

                    </button>

                </div>

            </form>

            {{-- GARANTIAS --}}
            <ul class="product-guarantees">

                <li>

                    <i class="fa-solid fa-shield-halved"></i>

                    Garantia de 12 meses

                </li>

                <li>

                    <i class="fa-solid fa-rotate-left"></i>

                    Devolução em até 30 dias

                </li>

                <li>

                    <i class="fa-solid fa-lock"></i>

                    Pagamento 100% seguro

                </li>

            </ul>

        </div>

    </div>

    {{-- ============================= --}}
    {{-- DETALHES --}}
    {{-- ============================= --}}
    <section class="product-details-section store-card">

    <button
        type="button"
        id="btnDescricao"
        class="btn btn-outline btn-toggle-description"
        onclick="toggleDescricao()"
    >
        Ler descrição completa
    </button>

    <div
        id="descricaoProduto"
        class="product-description-preview collapsed"
    >

        @php
            $descricaoLinhas = collect(preg_split('/\R+/', trim($produto->descricao)))
                ->map(fn ($linha) => trim($linha))
                ->filter();
        @endphp

        <div class="product-description">
            @foreach($descricaoLinhas as $linha)
                @if(preg_match('/:\s*$/', $linha))
                    <h3 class="description-subtitle">{{ $linha }}</h3>
                @elseif(preg_match('/^-\s*/', $linha))
                    <p class="description-line description-bullet">
                        <i class="fa-solid fa-check"></i>
                        <span>{{ preg_replace('/^-\s*/', '', $linha) }}</span>
                    </p>
                @else
                    <p class="description-line">{{ $linha }}</p>
                @endif
            @endforeach
        </div>

    </div>

    </section>

    {{-- ============================= --}}
    {{-- AVALIAÇÕES --}}
    {{-- ============================= --}}
    <section class="product-reviews-section store-card">
        <h2>
            <i class="fa-solid fa-star"></i>
            Avaliações dos Clientes
        </h2>

        <div class="reviews-container">
            {{-- LISTA DE AVALIAÇÕES --}}
            <div class="reviews-list">
                @forelse($produto->avaliacoes as $av)
                    <div class="review-item">
                        <div class="review-header">
                            <div class="reviewer-info">
                                <strong class="reviewer-name">{{ $av->cliente->nome }}</strong>
                                <div class="review-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa-solid fa-star {{ $i <= intval($av->nota) ? 'active' : 'inactive' }}"></i>
                                    @endfor
                                </div>
                            </div>
                            <span class="review-date">{{ $av->created_at->format('d/m/Y') }}</span>
                        </div>
                        <p class="review-comment">{{ $av->comentario }}</p>
                    </div>
                @empty
                    <p class="no-reviews">Ainda não há avaliações. Seja o primeiro a avaliar este produto.</p>
                @endforelse
            </div>

            {{-- FORMULARIO DE AVALIACAO --}}
            <div class="review-form-container">
                <h3>Deixe sua avaliação</h3>
                <div class="review-rules">
                    <h4>
                        <i class="fa-solid fa-circle-info"></i>
                        Regras para avaliação
                    </h4>

                    <ul>
                        <li>Atribua uma nota de 1 a 5 estrelas.</li>
                        <li>O comentário deve ter no mínimo 5 caracteres.</li>
                        <li>Cada cliente pode avaliar o produto apenas uma vez.</li>
                        <li>Sua opinião ajuda outros compradores.</li>
                    </ul>
                </div>
                @if(session()->has('cliente_id'))
                    <form action="{{ route('avaliacao.store') }}" method="POST" class="review-form">
                        @csrf
                        <input type="hidden" name="produto_id" value="{{ $produto->id }}">

                        <div class="form-group">
                            <label>Sua Nota:</label>
                            <div class="star-rating-input">
                                @for($i = 1; $i <= 5; $i++)
                                    <label class="star-label">
                                        <input type="radio" name="nota" value="{{ $i }}" required>
                                        <i class="fa-solid fa-star"></i>
                                    </label>
                                @endfor
                            </div>
                            <small class="rating-help">
                                <i class="fa-solid fa-circle-info"></i>
                                Clique na quantidade de estrelas para definir sua nota.
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="comentario">Comentário:</label>
                            <textarea
                                name="comentario"
                                id="comentario"
                                rows="4"
                                required
                                minlength="5"
                                placeholder="Conte sua experiência com o produto (mínimo 5 caracteres)"
                            ></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Enviar Avaliação</button>
                    </form>
                @else
                    <div class="login-alert">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        Você precisa estar <a href="{{ route('login') }}">logado</a> para avaliar este produto.
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- ============================= --}}
    {{-- PRODUTOS RELACIONADOS --}}
    {{-- ============================= --}}
    @if($relacionados->count() > 0)
    <section class="product-related-section">
        <div class="section-header">
            <h2>
                <i class="fa-solid fa-layer-group"></i> Produtos Relacionados
            </h2>
        </div>
        <div class="store-product-grid related-grid">
            @foreach($relacionados as $rel)
            <article class="store-card">
                <div class="card-image-wrapper">
                    @if($rel->imagem)
                        <img src="{{ asset('uploads/produtos/' . $rel->imagem) }}" alt="{{ $rel->nome }}">
                    @else
                        <img src="https://via.placeholder.com/400x300?text=Sem+Imagem" alt="{{ $rel->nome }}">
                    @endif
                </div>
                <div class="card-content">
                    <span class="card-brand">{{ $rel->categoria }}</span>
                    <h3 class="card-title">{{ $rel->nome }}</h3>

                    <div class="card-pricing">
                        @php
                            $precoOriginal = (float) ($rel->preco ?? 0);
                            $precoOferta = (float) ($rel->preco_pix ?? $rel->preco ?? 0);
                            $descontoPct = 0;
                            if ($precoOriginal > 0 && $precoOferta > 0 && $precoOriginal > $precoOferta) {
                                $descontoPct = (($precoOriginal - $precoOferta) / $precoOriginal) * 100;
                            }
                        @endphp

                        @if($descontoPct > 0)
                            <div class="price-wrapper">
                                <span class="price-old">
                                    De R$ {{ number_format($precoOriginal, 2, ',', '.') }}
                                </span>
                                <div class="card-price">R$ {{ number_format($precoOferta, 2, ',', '.') }}</div>
                                <span class="discount-badge">
                                    -{{ round($descontoPct) }}%
                                </span>
                            </div>
                        @else
                            <div class="card-price">R$ {{ number_format($precoOferta, 2, ',', '.') }}</div>
                        @endif

                        @if($rel->preco_parcelado && $rel->parcelas)
                            <span class="card-installments">
                                em {{ $rel->parcelas }}x de R$ {{ number_format($rel->preco_parcelado / $rel->parcelas, 2, ',', '.') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="card-actions">
                    <form method="POST" action="{{ route('carrinho.adicionar') }}" class="form-add-cart">
                        @csrf
                        <input type="hidden" name="produto_id" value="{{ $rel->id }}">
                        <input type="hidden" name="quantidade" value="1">
                        <input type="hidden" name="acao" value="adicionar">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-cart-shopping"></i> Adicionar
                        </button>
                    </form>
                    <a href="{{ route('loja.produto', $rel->id) }}" class="btn btn-outline">Ver detalhes</a>
                </div>
            </article>
            @endforeach
        </div>
    </section>
    @endif

</main>

<script>

/* ============================= */
/* TROCAR IMAGEM */
/* ============================= */

function trocarImagem(thumb, src)
{

    var mainImg =
        document.getElementById('main-img');

    mainImg.style.opacity = '0';

    setTimeout(function ()
    {

        mainImg.src = src;

        mainImg.style.opacity = '1';

    }, 150);

    document.querySelectorAll('.thumb')
        .forEach(function (t)
    {

        t.classList.remove('active');

    });

    thumb.classList.add('active');

}

/* ============================= */
/* QUANTIDADE */
/* ============================= */

function alterarQtd(delta)
{

    var input =
        document.getElementById('quantidade');

    var atual =
        parseInt(input.value);

    var max =
        parseInt(input.max);

    var novo =
        atual + delta;

    if (novo < 1)
    {
        novo = 1;
    }

    if (novo > max)
    {
        novo = max;
    }

    input.value = novo;

}

/* ============================= */
/* FEEDBACK CARRINHO */
/* ============================= */

document.getElementById('btn-add-cart')
.addEventListener('click', function ()
{

    var btn = this;

    btn.innerHTML =
        '<i class="fa-solid fa-check"></i> Adicionado!';

    btn.classList.add('btn-added');

    setTimeout(function ()
    {

        btn.innerHTML =
            '<i class="fa-solid fa-cart-plus"></i> Adicionar ao Carrinho';

        btn.classList.remove('btn-added');

    }, 2000);

});

function toggleDescricao()
{
    const descricao =
        document.getElementById('descricaoProduto');

    const botao =
        document.getElementById('btnDescricao');

    if (descricao.classList.contains('collapsed'))
    {
        descricao.classList.remove('collapsed');
        descricao.classList.add('expanded');

        botao.innerHTML =
            'Ocultar descrição';
    }
    else
    {
        descricao.classList.remove('expanded');
        descricao.classList.add('collapsed');

        botao.innerHTML =
            'Ler descrição completa';
    }
}

</script>

@endsection





