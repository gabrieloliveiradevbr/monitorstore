@extends('layout_cliente')

@section('contentcliente')
    <link rel="stylesheet" href="{{ asset('/css/cliente/carrinho.css') }}">

    @php
        $subtotal = 0;
        $totalItens = 0;
        foreach ($carrinho as $item) {
            $subtotal += ($item['preco_pix'] ?? $item['preco']) * $item['quantidade'];
            $totalItens += $item['quantidade'];
        }
        $limiteFreteGratis = 500.0;
        $frete = $subtotal >= $limiteFreteGratis || $totalItens == 0 ? 0.0 : 35.0;
        $total = $subtotal + $frete;
        $progresso = $subtotal >= $limiteFreteGratis ? 100 : round(($subtotal / $limiteFreteGratis) * 100);
        $faltaFrete = max(0, $limiteFreteGratis - $subtotal);
    @endphp

    <main class="conteudo-principal cart-page">

        <header class="store-page-header">
            <h1>Seu Carrinho</h1>
            <p>Revise seus produtos antes de finalizar a compra.</p>
        </header>

        @if (session('mensagem'))
            <div
                style="background-color:#d4edda;color:#155724;border:1px solid #c3e6cb;padding:14px 20px;border-radius:8px;margin-bottom:20px;display:flex;align-items:center;gap:10px;font-weight:500;">
                <i class="fa-solid fa-circle-check"></i> {{ session('mensagem') }}
            </div>
        @endif

        {{-- Barra de progresso para frete grátis --}}
        @if ($totalItens > 0)
            <div
                style="background:#fff;border-radius:10px;padding:16px 20px;margin-bottom:20px;box-shadow:0 2px 12px rgba(0,0,0,.06);">
                @if ($subtotal >= $limiteFreteGratis)
                    <p style="color:#155724;font-weight:600;display:flex;align-items:center;gap:8px;">
                        <i class="fa-solid fa-truck-fast" style="color:#28a745;"></i>
                        Parabéns! Você ganhou <strong>frete grátis</strong>!
                    </p>
                @else
                    <p style="color:#374151;font-size:0.9rem;margin-bottom:8px;">
                        <i class="fa-solid fa-truck" style="color:#FFD700;"></i>
                        Falta <strong>R$ {{ number_format($faltaFrete, 2, ',', '.') }}</strong> para frete grátis!
                    </p>
                @endif
                <div style="background:#e9ecef;border-radius:20px;height:8px;overflow:hidden;">
                    <div id="progress-frete"
                        style="background:linear-gradient(90deg,#FFD700,#e6c200);height:100%;border-radius:20px;width:{{ $progresso }}%;transition:width .4s;">
                    </div>
                </div>
            </div>
        @endif

        @if (count($carrinho) == 0)
            <div class="empty-cart store-card"
                style="text-align:center;padding:4rem 2rem;background:#fff;border-radius:10px;box-shadow:0 2px 12px rgba(0,0,0,.06);">
                <i class="fa-solid fa-cart-shopping"
                    style="font-size:5rem;color:#d1d5db;margin-bottom:1.5rem;display:block;"></i>
                <h2 style="font-size:1.8rem;margin-bottom:0.5rem;font-weight:700;">Seu carrinho está vazio</h2>
                <p style="color:#6b7280;margin-bottom:2rem;">Adicione produtos para começar a comprar!</p>
                <a href="{{ route('loja.monitores') }}" class="btn btn-primary"
                    style="display:inline-block;padding:12px 28px;font-weight:600;border-radius:10px;">
                    <i class="fa-solid fa-display"></i> Ver Produtos
                </a>
            </div>
        @else
            <div class="cart-container">

                <!-- ── LISTA DE PRODUTOS ─────────────────── -->
                <section class="cart-items-section">
                    <form method="POST" action="{{ route('carrinho.atualizar') }}" class="cart-form store-card"
                        id="cartForm">
                        @csrf

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
                                    @foreach ($carrinho as $id => $item)
                                        @php $precoUnit = $item['preco_pix'] ?? $item['preco']; @endphp
                                        <tr class="cart-row" data-price="{{ $precoUnit }}">
                                            <td data-label="Produto">
                                                <div class="cart-product-info">
                                                    <div class="cart-img-wrapper">
                                                        <img src="{{ asset('uploads/produtos/' . $item['imagem']) }}"
                                                            alt="{{ $item['nome'] }}">
                                                    </div>
                                                    <div class="cart-product-details">
                                                        <a href="{{ route('loja.produto', $id) }}"
                                                            class="cart-product-title">{{ $item['nome'] }}</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td data-label="Preço Unit.">
                                                <span class="cart-price">R$
                                                    {{ number_format($precoUnit, 2, ',', '.') }}</span>
                                            </td>
                                            <td data-label="Quantidade">
                                                <input type="hidden" name="produto_id[]" value="{{ $id }}">
                                                <div class="qty-control">
                                                    <button type="button" class="qty-btn" onclick="alterarQtd(this, -1)"
                                                        aria-label="Diminuir">−</button>
                                                    <input type="number" name="quantidade[]"
                                                        value="{{ $item['quantidade'] }}" min="1"
                                                        class="cart-qty-input" aria-label="Quantidade"
                                                        onchange="recalcularTotais()">
                                                    <button type="button" class="qty-btn" onclick="alterarQtd(this, 1)"
                                                        aria-label="Aumentar">+</button>
                                                </div>
                                            </td>
                                            <td data-label="Subtotal">
                                                <span class="cart-subtotal">R$
                                                    {{ number_format($precoUnit * $item['quantidade'], 2, ',', '.') }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('carrinho.remover', $id) }}" class="btn-remove"
                                                    onclick="confirmarRemocao(event, this)" aria-label="Remover produto">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                    <span class="btn-remove-label">Remover</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="cart-update-actions">
                            <a href="{{ route('loja.monitores') }}" class="btn btn-ghost btn-sm"><i
                                    class="fa-solid fa-arrow-left"></i> Continuar comprando</a>
                            <button type="submit" class="btn btn-outline btn-sm"><i class="fa-solid fa-rotate"></i>
                                Atualizar quantidades</button>
                        </div>
                    </form>
                </section>

                <!-- ── RESUMO DO PEDIDO ───────────────────── -->
                <aside class="cart-summary-section">
                    <div class="store-card summary-card">
                        <h2>Resumo do Pedido</h2>

                        <ul class="summary-totals">
                            <li>
                                <span>Subtotal <em class="item-count" id="summary-count">({{ $totalItens }}
                                        {{ $totalItens == 1 ? 'item' : 'itens' }})</em></span>
                                <span id="summary-subtotal">R$ {{ number_format($subtotal, 2, ',', '.') }}</span>
                            </li>
                            <li>
                                <span>Frete</span>
                                <span id="summary-frete" class="freight-value">
                                    @if ($frete == 0)
                                        <span style="color:#28a745;font-weight:600;">Grátis</span>
                                    @else
                                        R$ {{ number_format($frete, 2, ',', '.') }}
                                    @endif
                                </span>
                            </li>
                            <li class="summary-total-final">
                                <span>Total</span>
                                <span class="total-value" id="summary-total">R$
                                    {{ number_format($total, 2, ',', '.') }}</span>
                            </li>
                        </ul>

                        <div class="summary-actions">
                            <a href="{{ route('carrinho.checkout') }}" class="btn btn-primary btn-checkout">
                                <i class="fa-solid fa-lock"></i> Ir para Pagamento
                            </a>
                            <p class="summary-security">
                                <i class="fa-solid fa-shield-halved"></i>
                                Compra 100% segura e protegida
                            </p>
                        </div>
                    </div>
                </aside>

            </div>
        @endif
    </main>

    <script>
        const LIMITE_FRETE_GRATIS = 500;
        const VALOR_FRETE = 35;

        function formatarBRL(valor) {
            return 'R$ ' + valor.toLocaleString('pt-BR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        function recalcularTotais() {
            let subtotal = 0;
            let totalItens = 0;

            document.querySelectorAll('.cart-row').forEach(row => {
                const preco = parseFloat(row.dataset.price);
                const qtdInput = row.querySelector('.cart-qty-input');
                const qtd = parseInt(qtdInput.value) || 1;
                const sub = preco * qtd;
                row.querySelector('.cart-subtotal').textContent = formatarBRL(sub);
                subtotal += sub;
                totalItens += qtd;
            });

            const frete = subtotal >= LIMITE_FRETE_GRATIS ? 0 : VALOR_FRETE;
            const total = subtotal + frete;

            document.getElementById('summary-subtotal').textContent = formatarBRL(subtotal);
            document.getElementById('summary-frete').innerHTML = frete === 0 ?
                '<span style="color:#28a745;font-weight:600;">Grátis</span>' :
                formatarBRL(frete);
            document.getElementById('summary-total').textContent = formatarBRL(total);
            document.getElementById('summary-count').textContent = '(' + totalItens + (totalItens === 1 ? ' item)' :
                ' itens)');

            // Barra de progresso
            const barra = document.getElementById('progress-frete');
            if (barra) {
                const prog = Math.min(100, Math.round((subtotal / LIMITE_FRETE_GRATIS) * 100));
                barra.style.width = prog + '%';
            }
        }

        /* ── Controle de quantidade + / − ── */
        function alterarQtd(btn, delta) {
            const input = btn.parentElement.querySelector('.cart-qty-input');
            input.value = Math.max(1, parseInt(input.value) + delta);
            input.classList.add('qty-updated');
            setTimeout(() => input.classList.remove('qty-updated'), 300);
            recalcularTotais();
        }

        /* ── Confirmação ao remover ── */
        function confirmarRemocao(e, link) {
            e.preventDefault();
            const row = link.closest('tr');
            row.classList.add('row-removing');
            setTimeout(() => {
                window.location.href = link.href;
            }, 350);
        }
    </script>

@endsection
