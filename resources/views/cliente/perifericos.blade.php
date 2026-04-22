@extends('layout_cliente')

@section('contentcliente')
<link rel="stylesheet" href="{{ asset('/css/cliente/template_produto.css') }}">

<main class="conteudo-principal">

    {{-- ===== HEADER ===== --}}
    <header class="store-page-header">
        <h1>Periféricos</h1>
        <p>Complete seu setup com os melhores periféricos para desempenho, conforto e estilo.</p>
    </header>

    {{-- ===== FILTROS ===== --}}
    <section class="store-filter-bar">
        <form action="" method="GET" class="filter-form">

            <div class="filter-group">
                <label for="categoria">Categoria</label>
                <select name="categoria" id="categoria" class="filter-select">
                    <option value="">Todas</option>
                    <option value="mouse">Mouse</option>
                    <option value="teclado">Teclado</option>
                    <option value="headset">Headset</option>
                    <option value="webcam">Webcam</option>
                </select>
            </div>

            <div class="filter-group">
                <label for="marca">Marca</label>
                <select name="marca" id="marca" class="filter-select">
                    <option value="">Todas</option>
                    <option value="logitech">Logitech</option>
                    <option value="razer">Razer</option>
                    <option value="hyperx">HyperX</option>
                    <option value="redragon">Redragon</option>
                </select>
            </div>

            <div class="filter-group">
                <label for="preco">Preço</label>
                <select name="preco" id="preco" class="filter-select">
                    <option value="">Qualquer</option>
                    <option value="ate-200">Até R$ 200</option>
                    <option value="200-500">R$ 200 a R$ 500</option>
                    <option value="acima-500">Acima de R$ 500</option>
                </select>
            </div>

            <div class="filter-group">
                <label for="ordenar">Ordenar por</label>
                <select name="ordenar" id="ordenar" class="filter-select">
                    <option value="relevancia">Relevância</option>
                    <option value="menor-preco">Menor Preço</option>
                    <option value="maior-preco">Maior Preço</option>
                    <option value="lancamentos">Lançamentos</option>
                </select>
            </div>

            <div class="filter-action">
                <button type="submit" class="btn-filter">
                    <i class="fa-solid fa-sliders"></i> Filtrar
                </button>
            </div>

        </form>
    </section>

    {{-- ===== CONTAGEM ===== --}}
    <div class="store-results-bar">
        <span class="results-count"><strong>5</strong> produtos encontrados</span>
    </div>

    {{-- ===== PRODUTOS ===== --}}
    <section class="store-product-grid">

        {{-- Mouse --}}
        <article class="store-card">
            <div class="card-image-wrapper">
                <img src="https://via.placeholder.com/400x300?text=Mouse+Gamer" alt="Mouse Gamer">
            </div>
            <div class="card-content">
                <span class="card-brand">Logitech</span>
                <h2 class="card-title">Mouse Gamer Logitech G502 Hero</h2>
                <p class="card-desc">Sensor de alta precisão e peso ajustável para máxima performance.</p>
                <div class="card-price">R$ 299,00</div>
            </div>
            <div class="card-actions">
                <button class="btn btn-primary js-add-cart" type="button">
                    <i class="fa-solid fa-cart-shopping"></i> Adicionar
                </button>
                <a href="{{ route('loja.produto', 6) }}" class="btn btn-outline">Ver detalhes</a>
            </div>
        </article>

        {{-- Teclado --}}
        <article class="store-card">
            <div class="card-image-wrapper">
                <img src="https://via.placeholder.com/400x300?text=Teclado+Mecanico" alt="Teclado Mecânico">
            </div>
            <div class="card-content">
                <span class="card-brand">Redragon</span>
                <h2 class="card-title">Teclado Mecânico RGB Kumara</h2>
                <p class="card-desc">Switches mecânicos e iluminação RGB para gamers exigentes.</p>
                <div class="card-price">R$ 249,00</div>
            </div>
            <div class="card-actions">
                <button class="btn btn-primary js-add-cart" type="button">
                    <i class="fa-solid fa-cart-shopping"></i> Adicionar
                </button>
                <a href="{{ route('loja.produto', 7) }}" class="btn btn-outline">Ver detalhes</a>
            </div>
        </article>

        {{-- Headset --}}
        <article class="store-card">
            <div class="card-image-wrapper">
                <img src="https://via.placeholder.com/400x300?text=Headset+Gamer" alt="Headset Gamer">
            </div>
            <div class="card-content">
                <span class="card-brand">HyperX</span>
                <h2 class="card-title">Headset HyperX Cloud Stinger</h2>
                <p class="card-desc">Som imersivo e conforto prolongado para longas sessões.</p>
                <div class="card-price">R$ 199,00</div>
            </div>
            <div class="card-actions">
                <button class="btn btn-primary js-add-cart" type="button">
                    <i class="fa-solid fa-cart-shopping"></i> Adicionar
                </button>
                <a href="{{ route('loja.produto', 8) }}" class="btn btn-outline">Ver detalhes</a>
            </div>
        </article>

        {{-- Webcam --}}
        <article class="store-card">
            <div class="card-image-wrapper">
                <img src="https://via.placeholder.com/400x300?text=Webcam+HD" alt="Webcam HD">
            </div>
            <div class="card-content">
                <span class="card-brand">Logitech</span>
                <h2 class="card-title">Webcam Logitech C920 Full HD</h2>
                <p class="card-desc">Qualidade profissional para reuniões e streams.</p>
                <div class="card-price">R$ 399,00</div>
            </div>
            <div class="card-actions">
                <button class="btn btn-primary js-add-cart" type="button">
                    <i class="fa-solid fa-cart-shopping"></i> Adicionar
                </button>
                <a href="{{ route('loja.produto', 9) }}" class="btn btn-outline">Ver detalhes</a>
            </div>
        </article>

        {{-- Mousepad --}}
        <article class="store-card">
            <div class="card-image-wrapper">
                <img src="https://via.placeholder.com/400x300?text=Mousepad+Gamer" alt="Mousepad Gamer">
            </div>
            <div class="card-content">
                <span class="card-brand">Razer</span>
                <h2 class="card-title">Mousepad Razer Gigantus V2</h2>
                <p class="card-desc">Superfície otimizada para precisão e velocidade.</p>
                <div class="card-price">R$ 129,00</div>
            </div>
            <div class="card-actions">
                <button class="btn btn-primary js-add-cart" type="button">
                    <i class="fa-solid fa-cart-shopping"></i> Adicionar
                </button>
                <a href="{{ route('loja.produto', 10) }}" class="btn btn-outline">Ver detalhes</a>
            </div>
        </article>

    </section>

</main>

{{-- JS mantido --}}
<script>
document.querySelectorAll('.js-add-cart').forEach(btn => {
    btn.addEventListener('click', function () {
        if (this.disabled) return;
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
</script>

@endsection