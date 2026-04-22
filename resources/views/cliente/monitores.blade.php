@extends('layout_cliente')

@section('contentcliente')
<link rel="stylesheet" href="{{ asset('/css/cliente/template_produto.css') }}">

<main class="conteudo-principal">

    {{-- ===== HEADER ===== --}}
    <header class="store-page-header">
        <h1>Monitores</h1>
        <p>Encontre a tela perfeita para elevar seu setup de trabalho, estudo ou gameplay.</p>
    </header>

    {{-- ===== FILTROS ===== --}}
    <section class="store-filter-bar">
        <form action="" method="GET" class="filter-form">

            <div class="filter-group">
                <label for="categoria">Categoria</label>
                <select name="categoria" id="categoria" class="filter-select">
                    <option value="">Todas as Categorias</option>
                    <option value="gamer">Gamer</option>
                    <option value="profissional">Profissional</option>
                    <option value="ultrawide">Ultrawide</option>
                    <option value="portatil">Portátil</option>
                </select>
            </div>

            <div class="filter-group">
                <label for="marca">Marca</label>
                <select name="marca" id="marca" class="filter-select">
                    <option value="">Todas as Marcas</option>
                    <option value="lg">LG</option>
                    <option value="samsung">Samsung</option>
                    <option value="dell">Dell</option>
                    <option value="aoc">AOC</option>
                </select>
            </div>

            <div class="filter-group">
                <label for="preco">Preço</label>
                <select name="preco" id="preco" class="filter-select">
                    <option value="">Qualquer Preço</option>
                    <option value="ate-1000">Até R$ 1.000</option>
                    <option value="1000-2000">R$ 1.000 a R$ 2.000</option>
                    <option value="acima-2000">Acima de R$ 2.000</option>
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

    {{-- ===== CONTAGEM DE RESULTADOS ===== --}}
    <div class="store-results-bar">
        <span class="results-count"><strong>5</strong> produtos encontrados</span>
    </div>

    {{-- ===== GRID DE PRODUTOS ===== --}}
    <section class="store-product-grid">

        <article class="store-card">
            <div class="card-image-wrapper">
                <img src="https://via.placeholder.com/400x300?text=Monitor+LG+Gamer" alt="Monitor Gamer LG">
            </div>
            <div class="card-content">
                <span class="card-brand">LG</span>
                <h2 class="card-title">Monitor Gamer LG UltraGear 24" 144Hz IPS</h2>
                <p class="card-desc">Tempo de resposta de 1ms e tecnologia FreeSync para máxima fluidez.</p>
                <div class="card-price">R$ 1.299,00</div>
            </div>
            <div class="card-actions">
                <button class="btn btn-primary js-add-cart" type="button">
                    <i class="fa-solid fa-cart-shopping"></i> Adicionar
                </button>
                <a href="{{ route('loja.produto', 1) }}" class="btn btn-outline">Ver detalhes</a>
            </div>
        </article>

        <article class="store-card">
            <div class="card-image-wrapper">
                <img src="https://via.placeholder.com/400x300?text=Monitor+Dell+4K" alt="Monitor Dell 4K">
            </div>
            <div class="card-content">
                <span class="card-brand">Dell</span>
                <h2 class="card-title">Monitor Profissional Dell 27" 4K USB-C</h2>
                <p class="card-desc">Cores precisas com 99% sRGB, ideal para designers e editores.</p>
                <div class="card-price">R$ 3.450,00</div>
            </div>
            <div class="card-actions">
                <button class="btn btn-primary js-add-cart" type="button">
                    <i class="fa-solid fa-cart-shopping"></i> Adicionar
                </button>
                <a href="{{ route('loja.produto', 2) }}" class="btn btn-outline">Ver detalhes</a>
            </div>
        </article>

        <article class="store-card">
            <div class="card-image-wrapper">
                <img src="https://via.placeholder.com/400x300?text=Monitor+Samsung+Odyssey" alt="Monitor Samsung Odyssey">
            </div>
            <div class="card-content">
                <span class="card-brand">Samsung</span>
                <h2 class="card-title">Monitor Curvo Samsung Odyssey G5 27"</h2>
                <p class="card-desc">Curvatura 1000R para imersão total e resolução WQHD incrível.</p>
                <div class="card-price">R$ 2.199,00</div>
            </div>
            <div class="card-actions">
                <button class="btn btn-primary js-add-cart" type="button">
                    <i class="fa-solid fa-cart-shopping"></i> Adicionar
                </button>
                <a href="{{ route('loja.produto', 3) }}" class="btn btn-outline">Ver detalhes</a>
            </div>
        </article>

        <article class="store-card">
            <div class="card-image-wrapper">
                <img src="https://via.placeholder.com/400x300?text=Monitor+AOC+Hero" alt="Monitor AOC Hero">
            </div>
            <div class="card-content">
                <span class="card-brand">AOC</span>
                <h2 class="card-title">Monitor AOC Hero 24" Full HD 165Hz</h2>
                <p class="card-desc">A melhor taxa de atualização para esports competitivos.</p>
                <div class="card-price">R$ 1.099,00</div>
            </div>
            <div class="card-actions">
                <button class="btn btn-primary js-add-cart" type="button">
                    <i class="fa-solid fa-cart-shopping"></i> Adicionar
                </button>
                <a href="{{ route('loja.produto', 4) }}" class="btn btn-outline">Ver detalhes</a>
            </div>
        </article>

        <article class="store-card">
            <div class="card-image-wrapper">
                <img src="https://via.placeholder.com/400x300?text=Monitor+Ultrawide" alt="Monitor Ultrawide LG">
            </div>
            <div class="card-content">
                <span class="card-brand">LG</span>
                <h2 class="card-title">Monitor LG Ultrawide 34" WQHD IPS</h2>
                <p class="card-desc">Mais espaço de tela para produtividade multitarefa extrema.</p>
                <div class="card-price">R$ 2.899,00</div>
            </div>
            <div class="card-actions">
                <button class="btn btn-primary js-add-cart" type="button">
                    <i class="fa-solid fa-cart-shopping"></i> Adicionar
                </button>
                <a href="{{ route('loja.produto', 5) }}" class="btn btn-outline">Ver detalhes</a>
            </div>
        </article>

    </section>

</main>

{{-- ===== JS: Feedback visual nos botões de adicionar ===== --}}
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