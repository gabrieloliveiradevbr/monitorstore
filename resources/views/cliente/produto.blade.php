@extends('layout_cliente')

@section('contentcliente')
<link rel="stylesheet" href="{{ asset('/css/cliente/produto.css') }}">

<main class="conteudo-principal product-page">

    <!-- ── TOPO: GALERIA + INFORMAÇÕES ─────────────── -->
    <div class="product-top-grid">

        <!-- Galeria -->
        <div class="product-gallery">
            <div class="main-image store-card" id="main-image-wrapper">
                <img id="main-img"
                     src="https://via.placeholder.com/600x600?text=Monitor+Gamer+UltraGear"
                     alt="Monitor Gamer UltraGear 24 polegadas">
            </div>
            <div class="thumbnails">
                <div class="thumb store-card active" onclick="trocarImagem(this, 'https://via.placeholder.com/600x600?text=Img+1')">
                    <img src="https://via.placeholder.com/150x150?text=Img+1" alt="Miniatura 1">
                </div>
                <div class="thumb store-card" onclick="trocarImagem(this, 'https://via.placeholder.com/600x600?text=Img+2')">
                    <img src="https://via.placeholder.com/150x150?text=Img+2" alt="Miniatura 2">
                </div>
                <div class="thumb store-card" onclick="trocarImagem(this, 'https://via.placeholder.com/600x600?text=Img+3')">
                    <img src="https://via.placeholder.com/150x150?text=Img+3" alt="Miniatura 3">
                </div>
                <div class="thumb store-card" onclick="trocarImagem(this, 'https://via.placeholder.com/600x600?text=Img+4')">
                    <img src="https://via.placeholder.com/150x150?text=Img+4" alt="Miniatura 4">
                </div>
            </div>
        </div>

        <!-- Informações -->
        <div class="product-info-container">

            <div class="product-header">
                <span class="product-brand">LG</span>
                <h1 class="product-title">Monitor Gamer UltraGear 24" 144Hz 1ms IPS FreeSync</h1>

                <div class="product-rating">
                    <div class="stars" aria-label="5 de 5 estrelas">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <span class="rating-count">47 avaliações</span>
                </div>
            </div>

            <div class="product-badges">
                <span class="badge-item badge-stock"><i class="fa-solid fa-circle-check"></i> Em estoque</span>
                <span class="badge-item badge-shipping"><i class="fa-solid fa-truck-fast"></i> Frete grátis Sul e Sudeste</span>
            </div>

            <p class="product-short-desc">
                Eleve seu nível de jogo com o monitor LG UltraGear. Cores vibrantes com painel IPS, tempo de resposta ultrarrápido de 1ms e taxa de atualização de 144Hz para uma jogabilidade fluida e sem rastros.
            </p>

            <!-- Preço -->
            <div class="product-pricing">
                <span class="old-price">De <s>R$ 1.699,00</s></span>
                <div class="pricing-row">
                    <span class="current-price">R$ 1.299,00</span>
                    <span class="discount-badge">−24%</span>
                </div>
                <span class="installments">ou em até <strong>10× de R$ 129,90</strong> sem juros</span>
            </div>

            <!-- Formulário -->
            <form method="POST" action="processa_carrinho.php" class="product-buy-form">
                <input type="hidden" name="produto_id" value="105">

                <div class="quantity-selector">
                    <label for="quantidade">Quantidade</label>
                    <div class="qty-control">
                        <button type="button" class="qty-btn" onclick="alterarQtd(-1)" aria-label="Diminuir">−</button>
                        <input type="number" id="quantidade" name="quantidade"
                               value="1" min="1" max="10" class="qty-input" aria-label="Quantidade">
                        <button type="button" class="qty-btn" onclick="alterarQtd(1)"  aria-label="Aumentar">+</button>
                    </div>
                    <span class="stock-hint">Máx. 10 por pedido</span>
                </div>

                <div class="action-buttons">
                    <button type="submit" name="acao" value="adicionar" class="btn btn-outline btn-cart" id="btn-add-cart">
                        <i class="fa-solid fa-cart-plus"></i> Adicionar ao Carrinho
                    </button>
                    <button type="submit" name="acao" value="comprar" class="btn btn-primary btn-buy">
                        <i class="fa-solid fa-bolt"></i> Comprar Agora
                    </button>
                </div>
            </form>

            <!-- Garantias -->
            <ul class="product-guarantees">
                <li><i class="fa-solid fa-shield-halved"></i> Garantia de 12 meses</li>
                <li><i class="fa-solid fa-rotate-left"></i>  Devolução em até 30 dias</li>
                <li><i class="fa-solid fa-lock"></i>          Pagamento 100% seguro</li>
            </ul>

        </div>
    </div>

    <!-- ── ESPECIFICAÇÕES ────────────────────────── -->
    <section class="product-details-section store-card">
        <h2><i class="fa-solid fa-list-check"></i> Especificações Técnicas</h2>
        <p class="specs-intro">O monitor perfeito para o seu setup gamer. Construído com materiais de alta durabilidade e um design sem bordas, garantindo imersão total.</p>

        <table class="specs-table">
            <tbody>
                <tr>
                    <th>Tamanho da Tela</th>
                    <td>24 Polegadas</td>
                </tr>
                <tr>
                    <th>Tipo de Painel</th>
                    <td>IPS</td>
                </tr>
                <tr>
                    <th>Resolução Máxima</th>
                    <td>1920 × 1080 (Full HD)</td>
                </tr>
                <tr>
                    <th>Taxa de Atualização</th>
                    <td>144Hz</td>
                </tr>
                <tr>
                    <th>Tempo de Resposta</th>
                    <td>1ms (GtG)</td>
                </tr>
                <tr>
                    <th>Conexões</th>
                    <td>2× HDMI · 1× DisplayPort · 1× Saída de Fone</td>
                </tr>
            </tbody>
        </table>
    </section>

    <!-- ── AVALIAÇÕES ────────────────────────────── -->
    <section class="product-reviews-section store-card">
        <div class="reviews-header">
            <h2><i class="fa-solid fa-star"></i> Avaliações de Clientes</h2>
            <div class="reviews-summary">
                <span class="reviews-score">5,0</span>
                <div>
                    <div class="stars">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <span class="rating-count">47 avaliações</span>
                </div>
            </div>
        </div>

        <div class="reviews-list">
            <article class="review-card">
                <div class="review-header">
                    <div class="reviewer-meta">
                        <div class="reviewer-avatar" aria-hidden="true">CO</div>
                        <div>
                            <strong class="reviewer-name">Carlos Oliveira</strong>
                            <span class="verified-purchase"><i class="fa-solid fa-circle-check"></i> Compra verificada</span>
                        </div>
                    </div>
                    <div class="review-right">
                        <div class="stars" aria-label="5 estrelas">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <span class="review-date">12 de Novembro de 2023</span>
                    </div>
                </div>
                <h3 class="review-title">Excelente custo-benefício!</h3>
                <p class="review-text">O monitor chegou perfeito, sem dead pixels. A diferença de 60Hz para 144Hz é absurda, melhorou muito meu desempenho no CS:GO. Recomendo muito!</p>
            </article>

            <article class="review-card">
                <div class="review-header">
                    <div class="reviewer-meta">
                        <div class="reviewer-avatar" aria-hidden="true">MS</div>
                        <div>
                            <strong class="reviewer-name">Mariana Souza</strong>
                            <span class="verified-purchase"><i class="fa-solid fa-circle-check"></i> Compra verificada</span>
                        </div>
                    </div>
                    <div class="review-right">
                        <div class="stars" aria-label="4 estrelas">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                        <span class="review-date">05 de Outubro de 2023</span>
                    </div>
                </div>
                <h3 class="review-title">Muito bom, mas a base é grande</h3>
                <p class="review-text">Cores muito vivas e ótimo para jogar e trabalhar. Minha única crítica é que a base dele ocupa um bom espaço na mesa, então tive que comprar um suporte articulado. No mais, perfeito.</p>
            </article>
        </div>
    </section>

</main>

<script>
/* ── Troca de imagem principal ── */
function trocarImagem(thumb, src) {
    var mainImg = document.getElementById('main-img');
    mainImg.style.opacity = '0';
    setTimeout(function () {
        mainImg.src = src;
        mainImg.style.opacity = '1';
    }, 150);

    document.querySelectorAll('.thumb').forEach(function (t) { t.classList.remove('active'); });
    thumb.classList.add('active');
}

/* ── Controle + / − ── */
function alterarQtd(delta) {
    var input = document.getElementById('quantidade');
    var novo  = Math.min(10, Math.max(1, parseInt(input.value) + delta));
    input.value = novo;
    input.classList.add('qty-flash');
    setTimeout(function () { input.classList.remove('qty-flash'); }, 250);
}

/* ── Feedback no botão "Adicionar ao Carrinho" ── */
document.getElementById('btn-add-cart').addEventListener('click', function (e) {
    e.preventDefault();
    var btn = this;
    btn.innerHTML = '<i class="fa-solid fa-circle-check"></i> Adicionado!';
    btn.classList.add('btn-added');
    setTimeout(function () {
        btn.innerHTML = '<i class="fa-solid fa-cart-plus"></i> Adicionar ao Carrinho';
        btn.classList.remove('btn-added');
    }, 2000);
});
</script>

@endsection