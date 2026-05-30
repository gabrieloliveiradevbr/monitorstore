<link rel="stylesheet" href="{{ asset('/css/cliente/style.css') }}">

@extends('layout_cliente')

@section('contentcliente')

<main class="conteudo-principal home-page">

    {{-- ===== 1. HERO ===== --}}
    <section class="home-hero">

        <div class="hero-content">

            <h1>
                Os melhores monitores<br>
                <span>para o seu setup</span>
            </h1>

            <p>
                Trabalhe com precisão e jogue com máxima fluidez.
                Descubra telas de alta performance que transformam
                a sua experiência visual.
            </p>

            <div class="hero-actions">

                <a
                    href="{{ route('loja.monitores') }}"
                    class="btn btn-primary btn-large"
                >
                    <i class="fa-solid fa-display"></i>
                    Ver Monitores
                </a>

                <a
                    href="{{ route('inicio') }}#ofertas"
                    class="btn btn-outline-light btn-large"
                >
                    Ver Ofertas
                </a>

            </div>

        </div>

        <div class="hero-image">

            <img
                src="{{ asset('/images/hero_monitor.png') }}"
                alt="Setup Premium com Monitor"
            >

        </div>

    </section>

    {{-- ===== 2. CATEGORIAS ===== --}}
    <section class="home-categories">

        <div class="section-header">
            <h2>Categorias</h2>
        </div>

        <div class="category-grid">

            <a
                href="{{ route('loja.monitores') }}"
                class="category-card category-highlight"
            >
                <i class="fa-solid fa-display"></i>
                Monitores
            </a>

            <a
                href="{{ route('loja.perifericos') }}"
                class="category-card"
            >
                <i class="fa-solid fa-keyboard"></i>
                Periféricos
            </a>

            <a
                href="{{ route('loja.acessorios') }}"
                class="category-card"
            >
                <i class="fa-solid fa-plug"></i>
                Acessórios
            </a>

        </div>

    </section>

    {{-- ===== 3. DESTAQUES ===== --}}
    <section class="home-featured">

        <div class="section-header">

            <h2>Destaques da Semana</h2>

            <a
                href="{{ route('loja.monitores') }}"
                class="link-more"
            >
                Ver tudo
                <i class="fa-solid fa-arrow-right"></i>
            </a>

        </div>

        <div class="store-product-grid">

            @forelse($destaques as $produto)

                <article class="store-card">

                    <div class="card-image-wrapper">

                        @if($produto->imagem)

                            <img
                                src="{{ asset('uploads/produtos/' . $produto->imagem) }}"
                                alt="{{ $produto->nome }}"
                            >

                        @else

                            <img
                                src="https://via.placeholder.com/400x300?text=Produto"
                                alt="{{ $produto->nome }}"
                            >

                        @endif

                    </div>

                    <div class="card-content">

                        <span class="card-brand">
                            {{ $produto->categoria }}
                        </span>

                        <h3 class="card-title">
                            {{ $produto->nome }}
                        </h3>

                        {{-- PREÇO --}}
                        <div class="price-wrapper">

                            @if($produto->preco > $produto->preco_pix && $produto->preco_pix)

                                <span class="price-old">

                                    De R$
                                    {{
                                        number_format(
                                            $produto->preco,
                                            2,
                                            ',',
                                            '.'
                                        )
                                    }}

                                </span>

                                <div class="card-price">

                                    Por R$
                                    {{
                                        number_format(
                                            $produto->preco_pix,
                                            2,
                                            ',',
                                            '.'
                                        )
                                    }}

                                </div>

                            @else

                                <div class="card-price">

                                    R$
                                    {{
                                        number_format(
                                            $produto->preco,
                                            2,
                                            ',',
                                            '.'
                                        )
                                    }}

                                </div>

                            @endif

                        </div>

                        {{-- PARCELAMENTO --}}
                        @if($produto->preco_parcelado)

                            <div class="card-installments">

                                em
                                {{ $produto->parcelas ?? 12 }}x de

                                <strong>

                                    R$
                                    {{
                                        number_format(
                                            $produto->preco_parcelado /
                                            ($produto->parcelas ?? 12),
                                            2,
                                            ',',
                                            '.'
                                        )
                                    }}

                                </strong>

                            </div>

                        @endif

                    </div>

                    <div class="card-actions">

                        <a
                            href="{{ route('loja.produto', $produto->id) }}"
                            class="btn btn-outline"
                        >
                            Ver detalhes
                        </a>

                    </div>

                </article>

            @empty

                <div class="empty-products">

                    <p>
                        Nenhum produto em destaque no momento.
                    </p>

                </div>

            @endforelse

        </div>

    </section>

    {{-- ===== 4. OFERTAS ===== --}}
    <section id="ofertas" class="home-offers">

        <div class="offers-header">

            <h2>
                <i class="fa-solid fa-fire"></i>
                Ofertas da Semana
            </h2>

            <p>
                Aproveite descontos imperdíveis por tempo limitado.
            </p>

        </div>

        <div class="store-product-grid offers-grid">

            @forelse($ofertas as $produto)

                @php

                    $precoOriginal = $produto->preco;

                    $precoOferta = $produto->preco_pix
                        ? $produto->preco_pix
                        : $produto->preco;

                    $desconto = 0;

                    if($precoOriginal > 0 && $precoOferta < $precoOriginal){

                        $desconto = round(
                            (
                                ($precoOriginal - $precoOferta)
                                / $precoOriginal
                            ) * 100
                        );

                    }

                @endphp

                <article class="store-card offer-card">

                    {{-- BADGE --}}
                    <div class="card-badge">

                        @if($desconto > 0)

                            {{ $desconto }}% OFF

                        @else

                            OFERTA

                        @endif

                    </div>

                    {{-- IMAGEM --}}
                    <div class="card-image-wrapper">

                        @if($produto->imagem)

                            <img
                                src="{{ asset('uploads/produtos/' . $produto->imagem) }}"
                                alt="{{ $produto->nome }}"
                            >

                        @else

                            <img
                                src="https://via.placeholder.com/400x300?text=Produto+Oferta"
                                alt="{{ $produto->nome }}"
                            >

                        @endif

                    </div>

                    {{-- CONTEÚDO --}}
                    <div class="card-content">

                        <span class="card-brand">
                            {{ $produto->categoria }}
                        </span>

                        <h3 class="card-title">
                            {{ $produto->nome }}
                        </h3>

                        <div class="price-wrapper">

                            {{-- PREÇO ANTIGO --}}
                            @if($precoOferta < $precoOriginal)

                                <span class="price-old">

                                    De R$
                                    {{
                                        number_format(
                                            $precoOriginal,
                                            2,
                                            ',',
                                            '.'
                                        )
                                    }}

                                </span>

                            @endif

                            {{-- PREÇO PROMOCIONAL --}}
                            <div class="card-price">

                                Por R$
                                {{
                                    number_format(
                                        $precoOferta,
                                        2,
                                        ',',
                                        '.'
                                    )
                                }}

                            </div>

                        </div>

                        {{-- PREÇO PARCELADO --}}
                        @if($produto->preco_parcelado)

                            <div class="card-installments">

                                ou em
                                {{ $produto->parcelas ?? 12 }}x de

                                <strong>

                                    R$
                                    {{
                                        number_format(
                                            $produto->preco_parcelado /
                                            ($produto->parcelas ?? 12),
                                            2,
                                            ',',
                                            '.'
                                        )
                                    }}

                                </strong>

                            </div>

                        @endif

                    </div>

                    {{-- BOTÃO --}}
                    <div class="card-actions">

                        <a
                            href="{{ route('loja.produto', $produto->id) }}"
                            class="btn btn-primary"
                        >
                            <i class="fa-solid fa-cart-shopping"></i>
                            Comprar
                        </a>

                    </div>

                </article>

            @empty

                <div class="empty-products">

                    <p>
                        Nenhuma oferta disponível no momento.
                    </p>

                </div>

            @endforelse

        </div>

    </section>

    {{-- ===== 5. DIFERENCIAIS ===== --}}
    <section class="home-features">

        <div class="feature-item">

            <i class="fa-solid fa-truck-fast feature-icon"></i>

            <h4>Frete Rápido</h4>

            <p>
                Entregas para todo o Brasil.
            </p>

        </div>

        <div class="feature-item">

            <i class="fa-solid fa-shield-halved feature-icon"></i>

            <h4>Pagamento Seguro</h4>

            <p>
                Em até 12x sem juros no cartão.
            </p>

        </div>

        <div class="feature-item">

            <i class="fa-solid fa-award feature-icon"></i>

            <h4>Garantia</h4>

            <p>
                Produtos originais e com nota fiscal.
            </p>

        </div>

        <div class="feature-item">

            <i class="fa-solid fa-headset feature-icon"></i>

            <h4>Suporte</h4>

            <p>
                Atendimento especializado.
            </p>

        </div>

    </section>

    {{-- ===== 6. CTA FINAL ===== --}}
    <section class="home-cta">

        <div class="cta-content">

            <h2>
                Pronto para elevar seu nível?
            </h2>

            <p>
                Explore nosso catálogo completo e encontre
                a peça que falta no seu setup.
            </p>

            <a
                href="{{ route('loja.monitores') }}"
                class="btn btn-primary btn-large"
            >
                Ver Todos os Produtos
            </a>

        </div>

    </section>

</main>

@endsection