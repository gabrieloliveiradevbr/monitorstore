@extends('layout_cliente')

@section('contentcliente')
<link rel="stylesheet" href="{{ asset('/css/cliente/template_produto.css') }}">

<main class="conteudo-principal">

    {{-- ===== HEADER ===== --}}
    <header class="store-page-header">
        <h1>Acessórios</h1>
        <p>Encontre os melhores acessórios para completar e turbinar o seu setup.</p>
    </header>

    {{-- ===== FILTROS ===== --}}
    <section class="store-filter-bar">
        <form action="" method="GET" class="filter-form">

            <div class="filter-group">
                <label for="tipo">Tipo</label>
                <select name="tipo" id="tipo" class="filter-select">
                    <option value="">Todos os Tipos</option>
                    <option value="teclado">Teclado</option>
                    <option value="mouse">Mouse</option>
                    <option value="headset">Headset</option>
                    <option value="suporte">Suporte</option>
                    <option value="cabos">Cabos</option>
                </select>
            </div>

            <div class="filter-group">
                <label for="marca">Marca</label>
                <select name="marca" id="marca" class="filter-select">
                    <option value="">Todas as Marcas</option>
                    <option value="logitech">Logitech</option>
                    <option value="redragon">Redragon</option>
                    <option value="razer">Razer</option>
                    <option value="hyperx">HyperX</option>
                </select>
            </div>

            <div class="filter-group">
                <label for="preco">Preço</label>
                <select name="preco" id="preco" class="filter-select">
                    <option value="">Qualquer Preço</option>
                    <option value="ate-150">Até R$ 150</option>
                    <option value="150-300">R$ 150 a R$ 300</option>
                    <option value="acima-300">Acima de R$ 300</option>
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
        <span class="results-count"><strong>1</strong> produto encontrado</span>
    </div>

    {{-- ===== GRID DE PRODUTOS ===== --}}
    <section class="store-product-grid">

        <article class="store-card">
            <div class="card-image-wrapper">
                <img src="https://via.placeholder.com/400x300?text=Suporte+Articulado" alt="Suporte Articulado ELG">
            </div>
            <div class="card-content">
                <span class="card-brand">ELG</span>
                <h2 class="card-title">Suporte Articulado de Mesa F80N</h2>
                <p class="card-desc">Pistão a gás para monitores de 17" a 35". Ajuste perfeito de altura e ângulo.</p>
                <div class="card-price">R$ 289,00</div>
            </div>
            <div class="card-actions">
                <button class="btn btn-primary js-add-cart" type="button">
                    <i class="fa-solid fa-cart-shopping"></i> Adicionar
                </button>
                <a href="{{ route('loja.produto', 13) }}" class="btn btn-outline">Ver detalhes</a>
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