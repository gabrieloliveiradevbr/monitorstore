<link rel="stylesheet" href="{{ asset('/css/cliente/style.css') }}">

@extends('layout_cliente')

@section('contentcliente')

<main class="conteudo-principal home-page">

    {{-- ===== 1. HERO ===== --}}
    <section class="home-hero">
        <div class="hero-content">
            <h1>Os melhores monitores<br><span>para o seu setup</span></h1>
            <p>Trabalhe com precisão e jogue com máxima fluidez. Descubra telas de alta performance que transformam a sua experiência visual.</p>
            <div class="hero-actions">
                <a href="{{ route('loja.monitores') }}" class="btn btn-primary btn-large">
                    <i class="fa-solid fa-display"></i> Ver Monitores
                </a>
                <a href="#ofertas" class="btn btn-outline-light btn-large">
                    Ver Ofertas
                </a>
            </div>
        </div>
        <div class="hero-image">
            <img src="https://via.placeholder.com/600x400/1a1a1a/FFD700?text=Monitor+Premium+Setup" alt="Setup Premium com Monitor">
        </div>
    </section>

    {{-- ===== 2. CATEGORIAS ===== --}}
    <section class="home-categories">
        <div class="section-header">
            <h2>Categorias</h2>
        </div>
        <div class="category-grid">
            <a href="{{ route('loja.monitores') }}" class="category-card category-highlight">
                <i class="fa-solid fa-display"></i> Monitores
            </a>
            <a href="{{ route('loja.acessorios') }}" class="category-card">
                <i class="fa-solid fa-keyboard"></i> Periféricos
            </a>
            <a href="{{ route('loja.acessorios') }}" class="category-card">
                <i class="fa-solid fa-plug"></i> Acessórios
            </a>
        </div>
    </section>

    {{-- ===== 3. DESTAQUES ===== --}}
    <section class="home-featured">
        <div class="section-header">
            <h2>Destaques da Semana</h2>
            <a href="{{ route('loja.monitores') }}" class="link-more">
                Ver tudo <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div class="store-product-grid">
            <article class="store-card">
                <div class="card-image-wrapper">
                    <img src="https://via.placeholder.com/400x300?text=Monitor+Gamer" alt="Monitor Gamer">
                </div>
                <div class="card-content">
                    <span class="card-brand">LG</span>
                    <h3 class="card-title">Monitor Gamer UltraGear 24" 144Hz</h3>
                    <div class="card-price">R$ 1.299,00</div>
                </div>
                <div class="card-actions">
                    <a href="{{ route('loja.produto', 1) }}" class="btn btn-outline">Ver detalhes</a>
                </div>
            </article>

            <article class="store-card">
                <div class="card-image-wrapper">
                    <img src="https://via.placeholder.com/400x300?text=Monitor+Ultrawide" alt="Monitor Ultrawide">
                </div>
                <div class="card-content">
                    <span class="card-brand">LG</span>
                    <h3 class="card-title">Monitor Ultrawide 34" WQHD IPS</h3>
                    <div class="card-price">R$ 2.899,00</div>
                </div>
                <div class="card-actions">
                    <a href="{{ route('loja.produto', 5) }}" class="btn btn-outline">Ver detalhes</a>
                </div>
            </article>

            <article class="store-card">
                <div class="card-image-wrapper">
                    <img src="https://via.placeholder.com/400x300?text=Mouse+Sem+Fio" alt="Mouse Sem Fio">
                </div>
                <div class="card-content">
                    <span class="card-brand">Logitech</span>
                    <h3 class="card-title">Mouse Sem Fio MX Master 3S</h3>
                    <div class="card-price">R$ 599,00</div>
                </div>
                <div class="card-actions">
                    <a href="{{ route('loja.produto', 10) }}" class="btn btn-outline">Ver detalhes</a>
                </div>
            </article>

            <article class="store-card">
                <div class="card-image-wrapper">
                    <img src="https://via.placeholder.com/400x300?text=Teclado+Mec%C3%A2nico" alt="Teclado Mecânico">
                </div>
                <div class="card-content">
                    <span class="card-brand">Redragon</span>
                    <h3 class="card-title">Teclado Mecânico Kumara RGB</h3>
                    <div class="card-price">R$ 249,00</div>
                </div>
                <div class="card-actions">
                    <a href="{{ route('loja.produto', 11) }}" class="btn btn-outline">Ver detalhes</a>
                </div>
            </article>
        </div>
    </section>

    {{-- ===== 4. OFERTAS ===== --}}
    <section id="ofertas" class="home-offers">
        <div class="offers-header">
            <h2><i class="fa-solid fa-fire"></i> Ofertas da Semana</h2>
            <p>Aproveite descontos imperdíveis por tempo limitado.</p>
        </div>

        <div class="store-product-grid offers-grid">
            <article class="store-card offer-card">
                <div class="card-badge">20% OFF</div>
                <div class="card-image-wrapper">
                    <img src="https://via.placeholder.com/400x300?text=Monitor+Samsung" alt="Monitor Samsung Curvo">
                </div>
                <div class="card-content">
                    <span class="card-brand">Samsung</span>
                    <h3 class="card-title">Monitor Curvo Odyssey G5 27"</h3>
                    <div class="price-wrapper">
                        <span class="price-old">De R$ 2.499,00</span>
                        <div class="card-price">Por R$ 1.999,00</div>
                    </div>
                </div>
                <div class="card-actions">
                    <button class="btn btn-primary" type="button">
                        <i class="fa-solid fa-cart-shopping"></i> Comprar
                    </button>
                </div>
            </article>

            <article class="store-card offer-card">
                <div class="card-badge">15% OFF</div>
                <div class="card-image-wrapper">
                    <img src="https://via.placeholder.com/400x300?text=Headset+Gamer" alt="Headset HyperX">
                </div>
                <div class="card-content">
                    <span class="card-brand">HyperX</span>
                    <h3 class="card-title">Headset Gamer Cloud II 7.1</h3>
                    <div class="price-wrapper">
                        <span class="price-old">De R$ 589,00</span>
                        <div class="card-price">Por R$ 499,00</div>
                    </div>
                </div>
                <div class="card-actions">
                    <button class="btn btn-primary" type="button">
                        <i class="fa-solid fa-cart-shopping"></i> Comprar
                    </button>
                </div>
            </article>
        </div>
    </section>

    {{-- ===== 5. DIFERENCIAIS ===== --}}
    <section class="home-features">
        <div class="feature-item">
            <i class="fa-solid fa-truck-fast feature-icon"></i>
            <h4>Frete Rápido</h4>
            <p>Entregas para todo o Brasil.</p>
        </div>
        <div class="feature-item">
            <i class="fa-solid fa-shield-halved feature-icon"></i>
            <h4>Pagamento Seguro</h4>
            <p>Em até 12x sem juros no cartão.</p>
        </div>
        <div class="feature-item">
            <i class="fa-solid fa-award feature-icon"></i>
            <h4>Garantia</h4>
            <p>Produtos originais e com nota fiscal.</p>
        </div>
        <div class="feature-item">
            <i class="fa-solid fa-headset feature-icon"></i>
            <h4>Suporte</h4>
            <p>Atendimento especializado.</p>
        </div>
    </section>

    {{-- ===== 6. CTA FINAL ===== --}}
    <section class="home-cta">
        <div class="cta-content">
            <h2>Pronto para elevar seu nível?</h2>
            <p>Explore nosso catálogo completo e encontre a peça que falta no seu setup.</p>
            <a href="{{ route('loja.monitores') }}" class="btn btn-primary btn-large">
                Ver Todos os Produtos
            </a>
        </div>
    </section>

</main>

{{-- ===== JS: Feedback visual leve nos botões de compra ===== --}}
<script>
document.querySelectorAll('.btn-primary[type="button"]').forEach(btn => {
    btn.addEventListener('click', function () {
        const original = this.innerHTML;
        this.innerHTML = '<i class="fa-solid fa-check"></i> Adicionado!';
        this.style.backgroundColor = '#28a745';
        this.style.borderColor = '#28a745';
        this.disabled = true;
        setTimeout(() => {
            this.innerHTML = original;
            this.style.backgroundColor = '';
            this.style.borderColor = '';
            this.disabled = false;
        }, 1800);
    });
});

// Smooth scroll para links âncora internos
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});
</script>

@endsection