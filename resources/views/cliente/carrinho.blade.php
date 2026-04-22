@extends('layout_cliente')

@section('contentcliente')
<link rel="stylesheet" href="{{ asset('/css/cliente/carrinho.css') }}">

<main class="conteudo-principal cart-page">

    <header class="store-page-header">
        <h1>Seu Carrinho</h1>
        <p>Revise seus produtos antes de finalizar a compra.</p>
    </header>

    <div class="cart-container">

        <!-- ── LISTA DE PRODUTOS ─────────────────── -->
        <section class="cart-items-section">
            <form method="POST" action="atualiza_carrinho.php" class="cart-form store-card">

                <div class="table-responsive">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Preço Unit.</th>
                                <th>Quantidade</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td data-label="Produto">
                                    <div class="cart-product-info">
                                        <div class="cart-img-wrapper">
                                            <img src="https://via.placeholder.com/150x150?text=Monitor" alt="Monitor Gamer UltraGear 24">
                                        </div>
                                        <div class="cart-product-details">
                                            <span class="card-brand">LG</span>
                                            <a href="{{ route('loja.produto', 1) }}" class="cart-product-title">Monitor Gamer UltraGear 24" 144Hz</a>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Preço Unit."><span class="cart-price">R$ 1.299,00</span></td>
                                <td data-label="Quantidade">
                                    <input type="hidden" name="produto_id[]" value="1">
                                    <div class="qty-control">
                                        <button type="button" class="qty-btn" onclick="alterarQtd(this, -1)" aria-label="Diminuir">−</button>
                                        <input type="number" name="quantidade[]" value="1" min="1" class="cart-qty-input" aria-label="Quantidade">
                                        <button type="button" class="qty-btn" onclick="alterarQtd(this, 1)"  aria-label="Aumentar">+</button>
                                    </div>
                                </td>
                                <td data-label="Subtotal"><span class="cart-subtotal">R$ 1.299,00</span></td>
                                <td>
                                    <a href="#" class="btn-remove" onclick="confirmarRemocao(event, this)" aria-label="Remover produto">
                                        <i class="fa-regular fa-trash-can"></i>
                                        <span class="btn-remove-label">Remover</span>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td data-label="Produto">
                                    <div class="cart-product-info">
                                        <div class="cart-img-wrapper">
                                            <img src="https://via.placeholder.com/150x150?text=Teclado" alt="Teclado Mecânico Kumara">
                                        </div>
                                        <div class="cart-product-details">
                                            <span class="card-brand">Redragon</span>
                                            <a href="{{ route('loja.produto', 11) }}" class="cart-product-title">Teclado Mecânico Kumara RGB</a>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Preço Unit."><span class="cart-price">R$ 249,00</span></td>
                                <td data-label="Quantidade">
                                    <input type="hidden" name="produto_id[]" value="11">
                                    <div class="qty-control">
                                        <button type="button" class="qty-btn" onclick="alterarQtd(this, -1)" aria-label="Diminuir">−</button>
                                        <input type="number" name="quantidade[]" value="2" min="1" class="cart-qty-input" aria-label="Quantidade">
                                        <button type="button" class="qty-btn" onclick="alterarQtd(this, 1)"  aria-label="Aumentar">+</button>
                                    </div>
                                </td>
                                <td data-label="Subtotal"><span class="cart-subtotal">R$ 498,00</span></td>
                                <td>
                                    <a href="#" class="btn-remove" onclick="confirmarRemocao(event, this)" aria-label="Remover produto">
                                        <i class="fa-regular fa-trash-can"></i>
                                        <span class="btn-remove-label">Remover</span>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="cart-update-actions">
                    <a href="{{ route('loja.monitores') }}" class="btn btn-ghost btn-sm"><i class="fa-solid fa-arrow-left"></i> Continuar comprando</a>
                    <button type="submit" class="btn btn-outline btn-sm"><i class="fa-solid fa-rotate"></i> Atualizar quantidades</button>
                </div>
            </form>
        </section>

        <!-- ── RESUMO DO PEDIDO ───────────────────── -->
        <aside class="cart-summary-section">
            <div class="store-card summary-card">
                <h2>Resumo do Pedido</h2>

                <ul class="summary-totals">
                    <li>
                        <span>Subtotal <em class="item-count">(3 itens)</em></span>
                        <span>R$ 1.797,00</span>
                    </li>
                    <li>
                        <span>Frete</span>
                        <span class="freight-value">R$ 35,00</span>
                    </li>
                    <li class="summary-total-final">
                        <span>Total</span>
                        <span class="total-value">R$ 1.832,00</span>
                    </li>
                </ul>

                <div class="summary-actions">
                    <a href="#" class="btn btn-primary btn-checkout">
                        <i class="fa-solid fa-lock"></i> Finalizar Compra
                    </a>
                    <p class="summary-security">
                        <i class="fa-solid fa-shield-halved"></i>
                        Compra 100% segura e protegida
                    </p>
                </div>
            </div>
        </aside>

    </div>
</main>

<script>
/* ── Controle de quantidade + / − ── */
function alterarQtd(btn, delta) {
    var input = btn.parentElement.querySelector('.cart-qty-input');
    var novoValor = Math.max(1, parseInt(input.value) + delta);
    input.value = novoValor;

    /* Animação leve de feedback */
    input.classList.add('qty-updated');
    setTimeout(function() { input.classList.remove('qty-updated'); }, 300);
}

/* ── Confirmação discreta ao remover item ── */
function confirmarRemocao(e, link) {
    e.preventDefault();
    var row = link.closest('tr');
    row.classList.add('row-removing');
    setTimeout(function() {
        window.location.href = link.href;
    }, 350);
}
</script>

@endsection