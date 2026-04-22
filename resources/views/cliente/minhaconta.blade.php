@extends('layout_cliente')

@section('contentcliente')
<link rel="stylesheet" href="{{ asset('/css/cliente/minhaconta.css') }}">

<main class="conteudo-principal account-page">

    <header class="store-page-header">
        <h1>Minha Conta</h1>
        <p>Gerencie seus dados, endereços e acompanhe seus pedidos.</p>
    </header>

    <div class="account-container">

        <aside class="account-sidebar">
            <div class="user-profile-summary">
                <div class="user-avatar">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="user-info">
                    <span class="user-greeting">Olá,</span>
                    <strong class="user-name">João Silva</strong>
                </div>
            </div>

            <nav class="account-nav" aria-label="Menu da conta">
                <a href="#sec-meus-dados"     class="nav-link active" onclick="alternarCor(this)"><i class="fa-regular fa-id-card"></i>               <span>Meus Dados</span></a>
                <a href="#sec-meus-pedidos"   class="nav-link"        onclick="alternarCor(this)"><i class="fa-solid fa-box-open"></i>                <span>Meus Pedidos</span></a>
                <a href="#sec-enderecos"      class="nav-link"        onclick="alternarCor(this)"><i class="fa-solid fa-location-dot"></i>            <span>Endereços</span></a>
                <a href="#sec-alterar-senha"  class="nav-link"        onclick="alternarCor(this)"><i class="fa-solid fa-lock"></i>                    <span>Alterar Senha</span></a>
                <a href="#" class="nav-link nav-link-danger"><i class="fa-solid fa-arrow-right-from-bracket"></i> <span>Sair</span></a>
            </nav>
        </aside>

        <script>
        function alternarCor(elementoClicado) {
            document.querySelectorAll('.nav-link').forEach(function(link) {
                link.classList.remove('active');
            });
            elementoClicado.classList.add('active');
        }

        /* Feedback de salvamento nos formulários */
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.account-form').forEach(function (form) {
                form.addEventListener('submit', function (e) {
                    e.preventDefault(); /* remover em produção */
                    var btn = form.querySelector('.btn-primary');
                    var original = btn.textContent;
                    btn.textContent = '✓ Salvo!';
                    btn.classList.add('btn-saved');
                    setTimeout(function () {
                        btn.textContent = original;
                        btn.classList.remove('btn-saved');
                    }, 2500);
                });
            });
        });
        </script>

        <section class="account-content">

            <!-- ── MEUS DADOS ─────────────────────────── -->
            <div class="account-section store-card" id="sec-meus-dados">
                <h2><i class="fa-regular fa-id-card"></i> Meus Dados</h2>
                <hr class="section-divider">

                <form method="POST" action="atualiza_dados.php" class="account-form">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="nome">Nome Completo</label>
                            <input type="text"  id="nome"     name="nome"     class="form-control" value="João da Silva" required>
                        </div>
                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input type="text"  id="cpf"      name="cpf"      class="form-control" value="123.456.789-00" readonly>
                            <small class="form-hint"><i class="fa-solid fa-circle-info"></i> O CPF não pode ser alterado.</small>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" id="email"    name="email"    class="form-control" value="joao.silva@email.com" required>
                        </div>
                        <div class="form-group">
                            <label for="telefone">Telefone / WhatsApp</label>
                            <input type="tel"   id="telefone" name="telefone" class="form-control" value="(11) 98765-4321">
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Salvar alterações</button>
                    </div>
                </form>
            </div>

            <!-- ── MEUS PEDIDOS ───────────────────────── -->
            <div class="account-section store-card" id="sec-meus-pedidos">
                <h2><i class="fa-solid fa-box-open"></i> Meus Pedidos</h2>
                <hr class="section-divider">

                <div class="orders-list">
                    <article class="order-card">
                        <div class="order-header">
                            <div class="order-info-group">
                                <span class="order-label">Pedido</span>
                                <strong class="order-value">#10548</strong>
                            </div>
                            <div class="order-info-group">
                                <span class="order-label">Data</span>
                                <strong class="order-value">15/10/2023</strong>
                            </div>
                            <div class="order-info-group">
                                <span class="order-label">Total</span>
                                <strong class="order-value order-total">R$ 1.299,00</strong>
                            </div>
                            <div class="order-status">
                                <span class="badge badge-success"><i class="fa-solid fa-circle-check"></i> Entregue</span>
                            </div>
                        </div>
                        <div class="order-footer">
                            <span class="order-items-preview"><i class="fa-solid fa-box"></i> 1× Monitor Gamer UltraGear 24"</span>
                            <a href="#" class="btn btn-outline btn-sm">Ver detalhes <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    </article>

                    <article class="order-card">
                        <div class="order-header">
                            <div class="order-info-group">
                                <span class="order-label">Pedido</span>
                                <strong class="order-value">#10602</strong>
                            </div>
                            <div class="order-info-group">
                                <span class="order-label">Data</span>
                                <strong class="order-value">02/11/2023</strong>
                            </div>
                            <div class="order-info-group">
                                <span class="order-label">Total</span>
                                <strong class="order-value order-total">R$ 599,00</strong>
                            </div>
                            <div class="order-status">
                                <span class="badge badge-warning"><i class="fa-solid fa-truck"></i> Em trânsito</span>
                            </div>
                        </div>
                        <div class="order-footer">
                            <span class="order-items-preview"><i class="fa-solid fa-box"></i> 1× Mouse Sem Fio MX Master 3S</span>
                            <a href="#" class="btn btn-outline btn-sm">Ver detalhes <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    </article>
                </div>
            </div>

            <!-- ── ENDEREÇOS ───────────────────────────── -->
            <div class="account-section store-card" id="sec-enderecos">
                <div class="section-header-flex">
                    <h2><i class="fa-solid fa-location-dot"></i> Meus Endereços</h2>
                    <a href="#" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Adicionar novo</a>
                </div>
                <hr class="section-divider">

                <div class="address-grid">
                    <div class="address-card address-card--main">
                        <div class="address-badge">Principal</div>
                        <h3><i class="fa-solid fa-house"></i> Casa</h3>
                        <address>
                            <p>Rua das Flores, 123 — Apto 45</p>
                            <p>Bairro Jardim Primavera</p>
                            <p>São Paulo — SP, 01234-567</p>
                        </address>
                        <div class="address-actions">
                            <a href="#" class="btn-link"><i class="fa-regular fa-pen-to-square"></i> Editar</a>
                            <a href="#" class="btn-link text-danger"><i class="fa-regular fa-trash-can"></i> Remover</a>
                        </div>
                    </div>

                    <div class="address-card">
                        <h3><i class="fa-solid fa-building"></i> Trabalho</h3>
                        <address>
                            <p>Av. Paulista, 1000 — Sala 202</p>
                            <p>Bela Vista</p>
                            <p>São Paulo — SP, 01310-100</p>
                        </address>
                        <div class="address-actions">
                            <a href="#" class="btn-link"><i class="fa-regular fa-pen-to-square"></i> Editar</a>
                            <a href="#" class="btn-link"><i class="fa-regular fa-star"></i> Tornar principal</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── ALTERAR SENHA ───────────────────────── -->
            <div class="account-section store-card" id="sec-alterar-senha">
                <h2><i class="fa-solid fa-lock"></i> Alterar Senha</h2>
                <hr class="section-divider">

                <form method="POST" action="atualiza_senha.php" class="account-form">
                    <div class="form-grid">
                        <div class="form-group full-width">
                            <label for="senha_atual">Senha Atual</label>
                            <div class="input-password-wrapper">
                                <input type="password" id="senha_atual" name="senha_atual" class="form-control" required>
                                <button type="button" class="toggle-password" aria-label="Mostrar senha" onclick="toggleSenha('senha_atual', this)">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nova_senha">Nova Senha</label>
                            <div class="input-password-wrapper">
                                <input type="password" id="nova_senha" name="nova_senha" class="form-control" required>
                                <button type="button" class="toggle-password" aria-label="Mostrar nova senha" onclick="toggleSenha('nova_senha', this)">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirma_senha">Confirmar Nova Senha</label>
                            <div class="input-password-wrapper">
                                <input type="password" id="confirma_senha" name="confirma_senha" class="form-control" required>
                                <button type="button" class="toggle-password" aria-label="Mostrar confirmação" onclick="toggleSenha('confirma_senha', this)">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Atualizar senha</button>
                    </div>
                </form>

                <script>
                function toggleSenha(id, btn) {
                    var input = document.getElementById(id);
                    var icon  = btn.querySelector('i');
                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.replace('fa-eye', 'fa-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.replace('fa-eye-slash', 'fa-eye');
                    }
                }
                </script>
            </div>

        </section>
    </div>
</main>

@endsection