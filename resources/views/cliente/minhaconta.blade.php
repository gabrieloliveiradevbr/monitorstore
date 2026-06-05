@extends('layout_cliente')

@section('contentcliente')

<link rel="stylesheet" href="{{ asset('/css/cliente/minhaconta.css') }}">

<main class="conteudo-principal account-page">

    @if ($errors->any())
        <div class="custom-alert error-alert">
            <i class="fa-solid fa-circle-xmark"></i>

            <div>
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>

            <button type="button" onclick="fecharAlerta(this)">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    @endif

    @if(session('mensagem'))
        <div class="custom-alert success-alert">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('mensagem') }}</span>

            <button type="button" onclick="fecharAlerta(this)">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    @endif

    @if(session('erro'))
        <div class="custom-alert error-alert">
            <i class="fa-solid fa-circle-exclamation"></i>
            <span>{{ session('erro') }}</span>

            <button type="button" onclick="fecharAlerta(this)">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    @endif

    <header class="store-page-header">
        <h1>Minha Conta</h1>
        <p>Gerencie seus dados, endereços e acompanhe seus pedidos.</p>
    </header>

    <div class="account-container">

        {{-- SIDEBAR --}}
        <aside class="account-sidebar">

            <div class="user-profile-summary">

                <div class="user-avatar">
                    <i class="fa-solid fa-user"></i>
                </div>

                <div class="user-info">
                    <span class="user-greeting">Olá,</span>

                    <strong class="user-name">
                        {{ $cliente->nome }}
                    </strong>
                </div>

            </div>

            <nav class="account-nav" aria-label="Menu da conta">

                <a href="#sec-meus-dados"
                   class="nav-link active"
                   onclick="alternarCor(this)">

                    <i class="fa-regular fa-id-card"></i>
                    <span>Meus Dados</span>

                </a>

                <a href="#sec-meus-pedidos"
                   class="nav-link"
                   onclick="alternarCor(this)">

                    <i class="fa-solid fa-box-open"></i>
                    <span>Meus Pedidos</span>

                </a>

                <a href="#sec-enderecos"
                   class="nav-link"
                   onclick="alternarCor(this)">

                    <i class="fa-solid fa-location-dot"></i>
                    <span>Endereços</span>

                </a>

                <a href="#sec-alterar-senha"
                   class="nav-link"
                   onclick="alternarCor(this)">

                    <i class="fa-solid fa-lock"></i>
                    <span>Alterar Senha</span>

                </a>

                <a href="{{ route('logout') }}"
                   class="nav-link nav-link-danger">

                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Sair</span>

                </a>

            </nav>

        </aside>

        {{-- CONTEÚDO --}}
        <section class="account-content">

            {{-- MEUS DADOS --}}
            <div class="account-section store-card" id="sec-meus-dados">

                <h2>
                    <i class="fa-regular fa-id-card"></i>
                    Meus Dados
                </h2>

                <hr class="section-divider">

                <form method="POST" action="{{ route('cliente.atualizar', $cliente->id) }}" class="account-form">

                    @csrf

                    <div class="form-grid">

                        <div class="form-group">

                            <label for="nome">
                                Nome Completo
                            </label>

                            <input
                                type="text"
                                id="nome"
                                name="nome"
                                class="form-control"
                                value="{{ $cliente->nome }}"
                                required
                            >

                        </div>

                        <div class="form-group">

                            <label for="cpf">
                                CPF
                            </label>

                            <input
                                type="text"
                                id="cpf"
                                name="cpf"
                                class="form-control"
                                value="{{ $cliente->cpf }}"
                                readonly
                            >

                            <small class="form-hint">
                                <i class="fa-solid fa-circle-info"></i>
                                O CPF não pode ser alterado.
                            </small>

                        </div>

                        <div class="form-group">

                            <label for="email">
                                E-mail
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control"
                                value="{{ $cliente->email }}"
                                required
                            >

                        </div>

                        <div class="form-group">

                            <label for="telefone">
                                Telefone / WhatsApp
                            </label>

                            <input
                                type="tel"
                                id="telefone"
                                name="telefone"
                                class="form-control"
                                value="{{ $cliente->telefone }}"
                            >

                        </div>

                    </div>

                    <div class="form-actions">

                        <button type="submit" class="btn btn-primary">
                            Salvar alterações
                        </button>

                    </div>

                </form>

            </div>

            {{-- PEDIDOS --}}
            <div class="account-section store-card" id="sec-meus-pedidos">

                <h2>
                    <i class="fa-solid fa-box-open"></i>
                    Meus Pedidos
                </h2>

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

                                <strong class="order-value order-total">
                                    R$ 1.299,00
                                </strong>
                            </div>

                            <div class="order-status">

                                <span class="badge badge-success">
                                    <i class="fa-solid fa-circle-check"></i>
                                    Entregue
                                </span>

                            </div>

                        </div>

                        <div class="order-footer">

                            <span class="order-items-preview">
                                <i class="fa-solid fa-box"></i>
                                1× Monitor Gamer UltraGear 24"
                            </span>

                            <a href="#" class="btn btn-outline btn-sm">
                                Ver detalhes
                                <i class="fa-solid fa-chevron-right"></i>
                            </a>

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

                                <strong class="order-value order-total">
                                    R$ 599,00
                                </strong>
                            </div>

                            <div class="order-status">

                                <span class="badge badge-warning">
                                    <i class="fa-solid fa-truck"></i>
                                    Em trânsito
                                </span>

                            </div>

                        </div>

                        <div class="order-footer">

                            <span class="order-items-preview">
                                <i class="fa-solid fa-box"></i>
                                1× Mouse Sem Fio MX Master 3S
                            </span>

                            <a href="#" class="btn btn-outline btn-sm">
                                Ver detalhes
                                <i class="fa-solid fa-chevron-right"></i>
                            </a>

                        </div>

                    </article>

                </div>

            </div>

            {{-- ENDEREÇOS --}}
            <div class="account-section store-card" id="sec-enderecos">

                <div class="section-header-flex">

                    <h2>
                        <i class="fa-solid fa-location-dot"></i>
                        Meu Endereço
                    </h2>

                </div>

                <hr class="section-divider">

                <form method="POST"
                    action="{{ route('cliente.endereco', $cliente->id) }}"
                    class="account-form">

                    @csrf

                    <div class="form-group full-width">

                        <label for="endereco_novo">
                            Endereço Principal
                        </label>

                        <input
                            type="text"
                            id="endereco_novo"
                            name="endereco"
                            class="form-control"
                            value="{{ $cliente->endereco }}"
                            placeholder="Digite seu endereço completo"
                            required
                        >

                    </div>

                    <div class="form-actions">

                        <button type="submit"
                                class="btn btn-primary">

                            Salvar endereço

                        </button>

                    </div>

                </form>

                <div class="address-grid">

                    <div class="address-card address-card--main">

                        <div class="address-badge">
                            Principal
                        </div>

                        <h3>
                            <i class="fa-solid fa-house"></i>
                            Casa
                        </h3>

                        <address>

                            <p>{{ $cliente->endereco }}</p>

                        </address>

                    </div>

                </div>

            </div>

            {{-- ALTERAR SENHA --}}
            <div class="account-section store-card" id="sec-alterar-senha">

                <h2>
                    <i class="fa-solid fa-lock"></i>
                    Alterar Senha
                </h2>

                <div class="form-requirements" id="passwordRequirements" style="display:none;">
                    <p>Requisitos da senha:</p>

                    <ul>
                        <li id="req-length" class="invalid">
                            <i class="fa-solid fa-circle-xmark"></i>
                            Mínimo de 8 caracteres
                        </li>

                        <li id="req-upper" class="invalid">
                            <i class="fa-solid fa-circle-xmark"></i>
                            Uma letra maiúscula
                        </li>

                        <li id="req-number" class="invalid">
                            <i class="fa-solid fa-circle-xmark"></i>
                            Um número
                        </li>

                        <li id="req-special" class="invalid">
                            <i class="fa-solid fa-circle-xmark"></i>
                            Um caractere especial
                        </li>
                    </ul>
                </div>

                <hr class="section-divider">

                <form method="POST" action="{{ route('cliente.senha', $cliente->id) }}" class="account-form">

                    @csrf

                    <div class="form-grid">

                        <div class="form-group full-width">

                            <label for="senha_atual">
                                Senha Atual
                            </label>

                            <div class="input-password-wrapper">

                                <input
                                    type="password"
                                    id="senha_atual"
                                    name="senha_atual"
                                    class="form-control"
                                    required
                                >

                                <button
                                    type="button"
                                    class="toggle-password"
                                    aria-label="Mostrar senha"
                                    onclick="toggleSenha('senha_atual', this)"
                                >
                                    <i class="fa-regular fa-eye"></i>
                                </button>

                            </div>

                        </div>

                        <div class="form-group">

                            <label for="nova_senha">
                                Nova Senha
                            </label>

                            <div class="input-password-wrapper">

                                <input
                                    type="password"
                                    id="nova_senha"
                                    name="nova_senha"
                                    class="form-control"
                                    required
                                >

                                <button
                                    type="button"
                                    class="toggle-password"
                                    aria-label="Mostrar nova senha"
                                    onclick="toggleSenha('nova_senha', this)"
                                >
                                    <i class="fa-regular fa-eye"></i>
                                </button>

                            </div>

                        </div>

                        <div class="form-group">

                            <label for="confirma_senha">
                                Confirmar Nova Senha
                            </label>

                            <div id="senha-match-alert" class="form-error" style="display:none;">
                                <i class="fa-solid fa-circle-xmark"></i>
                                As senhas não coincidem.
                            </div>

                            <div class="input-password-wrapper">

                                <input
                                    type="password"
                                    id="confirma_senha"
                                    name="confirma_senha"
                                    class="form-control"
                                    required
                                >

                                <button
                                    type="button"
                                    class="toggle-password"
                                    aria-label="Mostrar confirmação"
                                    onclick="toggleSenha('confirma_senha', this)"
                                >
                                    <i class="fa-regular fa-eye"></i>
                                </button>

                            </div>

                        </div>

                    </div>

                    <div class="form-actions">

                        <button type="submit" class="btn btn-primary">
                            Atualizar senha
                        </button>

                    </div>

                </form>

            </div>

        </section>

    </div>

</main>

<script>

function alternarCor(elementoClicado) {
    document.querySelectorAll('.nav-link').forEach(function(link) {
        link.classList.remove('active');
    });

    elementoClicado.classList.add('active');
}

function toggleSenha(id, btn) {

    const input = document.getElementById(id);
    const icon = btn.querySelector('i');

    if (input.type === 'password') {

        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');

    } else {

        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');

    }
}

function fecharAlerta(btn) {
    btn.parentElement.remove();
}

function validar(id, ok) {

    const item = document.getElementById(id);

    if (!item) return;

    const icon = item.querySelector('i');

    if (ok) {

        item.classList.remove('invalid');
        item.classList.add('valid');

        icon.className = 'fa-solid fa-circle-check';

    } else {

        item.classList.remove('valid');
        item.classList.add('invalid');

        icon.className = 'fa-solid fa-circle-xmark';

    }
}

document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.account-form').forEach(function(form) {

        form.addEventListener('submit', function() {

            const btn = form.querySelector('.btn-primary');

            if (btn) {
                btn.innerHTML = 'Salvando...';
            }

        });

    });

    const senha = document.getElementById('nova_senha');
    const confirmaSenha = document.getElementById('confirma_senha');
    const requirementsBox = document.getElementById('passwordRequirements');
    const senhaAlert = document.getElementById('senha-match-alert');

    if (senha) {

        senha.addEventListener('focus', function() {

            if (requirementsBox) {
                requirementsBox.style.display = 'block';
            }

        });

        senha.addEventListener('input', function() {

            validar('req-length', senha.value.length >= 8);
            validar('req-upper', /[A-Z]/.test(senha.value));
            validar('req-number', /\d/.test(senha.value));
            validar('req-special', /[^A-Za-z0-9]/.test(senha.value));

        });

    }

    if (confirmaSenha && senha && senhaAlert) {

        confirmaSenha.addEventListener('input', function() {

            if (confirmaSenha.value === '') {

                senhaAlert.style.display = 'none';
                return;

            }

            senhaAlert.style.display =
                senha.value !== confirmaSenha.value
                    ? 'flex'
                    : 'none';

        });

    }

});

</script>

@endsection