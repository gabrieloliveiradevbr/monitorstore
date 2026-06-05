@extends('layout_cliente')

@section('contentcliente')
    <link rel="stylesheet" href="{{ asset('/css/cliente/carrinho.css') }}">

    <main class="conteudo-principal cart-page">

        <header class="store-page-header">
            <h1>Finalizar Compra</h1>
            <p>Revise os itens e confirme o pagamento com segurança.</p>
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
                @if ($subtotal >= 500.0)
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

        <div class="cart-container">

            {{-- LISTA DE PRODUTOS (resumo) --}}
            <section class="cart-items-section">

                <form method="POST" action="{{ route('carrinho.confirmar') }}" class="cart-form store-card"
                    id="checkoutForm">
                    @csrf

                    <div class="table-responsive">
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Preço Unit.</th>
                                    <th>Quantidade</th>
                                    <th>Subtotal</th>
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
                                            <span class="cart-price">R$ {{ number_format($precoUnit, 2, ',', '.') }}</span>
                                        </td>
                                        <td data-label="Quantidade">
                                            <span style="font-weight:800;">{{ $item['quantidade'] }}</span>
                                        </td>
                                        <td data-label="Subtotal">
                                            <span class="cart-subtotal">R$
                                                {{ number_format($precoUnit * $item['quantidade'], 2, ',', '.') }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="cart-update-actions">
                        <a href="{{ route('loja.carrinho') }}" class="btn btn-ghost btn-sm">
                            <i class="fa-solid fa-arrow-left"></i> Voltar ao carrinho
                        </a>

                        <button type="submit" class="btn btn-primary btn-sm" onclick="return confirmarCheckout();">
                            <i class="fa-solid fa-lock"></i> Confirmar pagamento
                        </button>
                    </div>

                    <p class="summary-security" style="margin-top:14px;">
                        <i class="fa-solid fa-shield-halved"></i>
                        Compra 100% segura e protegida
                    </p>
                </form>

            </section>

            {{-- RESUMO DO PEDIDO --}}
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
                            <span class="total-value" id="summary-total">R$ {{ number_format($total, 2, ',', '.') }}</span>
                        </li>
                    </ul>

                    <div class="summary-actions">
                        <div class="checkout-note"
                            style="background:#fff7e6;border:1px solid #ffedd5;border-radius:10px;padding:14px 14px;margin-top:10px;">
                            <i class="fa-solid fa-circle-info" style="color:#d97706;"></i>
                            <strong style="display:block;margin-top:6px;">Pagamento em produção</strong>
                            <span style="color:#6b7280;display:block;margin-top:4px;">
                                Como o sistema não integra um gateway real, ao confirmar o pagamento o pedido será
                                registrado e o estoque atualizado.
                            </span>
                        </div>
                    </div>
                </div>
            </aside>

        </div>
    </main>

    <script>
        function confirmarCheckout() {
            return confirm('Confirmar compra agora?');
        }
    </script>

@endsection
