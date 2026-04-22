<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Funcionário | Monitor Store</title>
    <link rel="stylesheet" href="{{ asset('css/layout_funcionario.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="admin-container">

    <!-- ══ SIDEBAR ══════════════════════════════════════════ -->
    <aside class="sidebar" id="sidebar" aria-label="Menu de navegação">

        <div class="sidebar-logo">
            <i class="fa-solid fa-desktop" aria-hidden="true"></i>
            <span class="logo-text">Monitor<span>Store</span></span>
        </div>

        <nav class="sidebar-nav">
            <p class="nav-section-label">PRINCIPAL</p>
            <ul>
                <li class="menu-item {{ request()->routeIs('funcionario.dashboard') ? 'ativo' : '' }}">
                    <a href="{{ route('funcionario.dashboard') }}" title="Dashboard">
                        <i class="fa-solid fa-chart-pie" aria-hidden="true"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
            </ul>

            <p class="nav-section-label">GESTÃO</p>
            <ul>
                <li class="menu-item {{ request()->routeIs('funcionario.admin') ? 'ativo' : '' }}">
                    <a href="{{ route('funcionario.admin') }}" title="Produtos">
                        <i class="fa-solid fa-desktop" aria-hidden="true"></i>
                        <span class="nav-text">Produtos</span>
                    </a>
                </li>

                <li class="menu-item {{ request()->routeIs('funcionario.pedidos*') ? 'ativo' : '' }}">
                    <a href="{{ route('funcionario.pedidos') }}" title="Pedidos">
                        <i class="fa-solid fa-box-open" aria-hidden="true"></i>
                        <span class="nav-text">Pedidos</span>
                    </a>
                </li>

                <li class="menu-item {{ request()->routeIs('funcionario.clientes*') ? 'ativo' : '' }}">
                    <a href="{{ route('funcionario.clientes') }}" title="Clientes">
                        <i class="fa-solid fa-users" aria-hidden="true"></i>
                        <span class="nav-text">Clientes</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="sidebar-footer">
            <a href="/logout" class="sidebar-logout">
                <i class="fa-solid fa-arrow-right-from-bracket" aria-hidden="true"></i>
                <span class="nav-text">Sair</span>
            </a>
        </div>

    </aside>

    <!-- ══ MAIN WRAPPER ══════════════════════════════════════ -->
    <div class="main-wrapper">

        <!-- Header -->
        <header class="top-header">

            <!-- Botão hambúrguer (mobile) -->
            <button class="hamburger" id="hamburger" aria-label="Abrir menu" aria-expanded="false" aria-controls="sidebar">
                <i class="fa-solid fa-bars"></i>
            </button>

            <!-- Breadcrumb / título da página atual -->
            <div class="header-page-title" id="page-title">
                <i class="fa-solid fa-chart-pie" id="page-icon"></i>
                <span id="page-name">Dashboard</span>
            </div>

            <div class="search-bar">
                <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                <input type="text" placeholder="Buscar no sistema..." aria-label="Buscar">
            </div>

            <div class="header-actions">
                <button class="icon-btn" aria-label="Notificações">
                    <i class="fa-regular fa-bell"></i>
                    <span class="badge" aria-label="3 notificações">3</span>
                </button>

                <div class="admin-profile">
                    <div class="avatar" aria-hidden="true">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <span class="admin-name">Funcionário</span>
                </div>
            </div>
        </header>

        <!-- Conteúdo dinâmico -->
        <main class="admin-conteudo" id="admin-conteudo">
            @yield('conteudo')
        </main>

        <!-- Footer -->
        <footer class="admin-footer">
            <span>&copy; {{ date('Y') }} Monitor Store. Todos os direitos reservados.</span>
            <div class="footer-links">
                <a href="#">Suporte</a>
                <span aria-hidden="true">·</span>
                <a href="#">Políticas</a>
            </div>
        </footer>

    </div>
</div>

<!-- Overlay mobile -->
<div class="sidebar-overlay" id="sidebar-overlay" aria-hidden="true"></div>

<script>
(function () {
    /* ── Sidebar mobile toggle ── */
    var sidebar  = document.getElementById('sidebar');
    var overlay  = document.getElementById('sidebar-overlay');
    var hamburger = document.getElementById('hamburger');

    function openSidebar() {
        sidebar.classList.add('open');
        overlay.classList.add('visible');
        hamburger.setAttribute('aria-expanded', 'true');
        hamburger.innerHTML = '<i class="fa-solid fa-xmark"></i>';
    }

    function closeSidebar() {
        sidebar.classList.remove('open');
        overlay.classList.remove('visible');
        hamburger.setAttribute('aria-expanded', 'false');
        hamburger.innerHTML = '<i class="fa-solid fa-bars"></i>';
    }

    hamburger.addEventListener('click', function () {
        sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
    });

    overlay.addEventListener('click', closeSidebar);

    /* ── Fechar ao pressionar Escape ── */
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeSidebar();
    });

    /* ── Atualiza título/ícone do header conforme item ativo ── */
    var activeItem = document.querySelector('.menu-item.ativo a');
    if (activeItem) {
        var icon = activeItem.querySelector('i');
        var text = activeItem.querySelector('.nav-text');
        if (icon && text) {
            document.getElementById('page-icon').className = icon.className;
            document.getElementById('page-name').textContent = text.textContent.trim();
        }
    }
})();
</script>

</body>
</html>