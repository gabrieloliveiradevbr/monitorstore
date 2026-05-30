<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor Store</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('/css/layout_cliente.css') }}">
</head>
<body class="site-wrapper">

    {{-- ===== HEADER ===== --}}
    <header class="header">
        <div class="header-container">

            {{-- Logo --}}
            <a href="{{ route('inicio') }}" class="logo">
                <i class="fa-solid fa-desktop"></i> Monitor<span>Store</span>
            </a>

            {{-- Nav Desktop --}}
            <nav class="nav-menu" aria-label="Menu principal">
                <ul>
                    <li class="menu-item {{ request()->routeIs('inicio') ? 'ativo' : '' }}">
                        <a href="{{ route('inicio') }}">Início</a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('loja.monitores') ? 'ativo' : '' }}">
                        <a href="{{ route('loja.monitores') }}">Monitores</a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('loja.perifericos') ? 'ativo' : '' }}">
                        <a href="{{ route('loja.perifericos') }}">Periféricos</a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('loja.acessorios') ? 'ativo' : '' }}">
                        <a href="{{ route('loja.acessorios') }}">Acessórios</a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('loja.contato') ? 'ativo' : '' }}">
                        <a href="{{ route('loja.contato') }}">Contato</a>
                    </li>
                </ul>
            </nav>

            {{-- Ações do Header --}}
            <div class="header-actions">

                {{-- Busca (Desktop) --}}
                <div class="search-bar" role="search">
                    <input type="text" placeholder="Buscar produtos..." aria-label="Buscar produtos">
                    <button type="button" aria-label="Pesquisar">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>

                {{-- Conta --}}
                <ul>
                    @if(session()->has('cliente_id'))

                        <a href="{{ route('loja.minhaconta', session('cliente_id')) }}">
                            <i class="fa-regular fa-user"></i> Minha Conta
                        </a>

                    @else

                        <a href="{{ route('login') }}">
                            <i class="fa-regular fa-user"></i> Login
                        </a>

                    @endif
                </ul>

                {{-- Carrinho --}}
                <ul>
                    <li class="menu-item {{ request()->routeIs('loja.carrinho') ? 'ativo' : '' }}" title="Carrinho" style="position:relative">
                        <a href="{{ route('loja.carrinho') }}" aria-label="Carrinho de compras">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </a>
                        {{-- <span class="cart-count">3</span> --}}
                    </li>
                </ul>

                {{-- Hamburger (Mobile) --}}
                <button class="nav-toggle" id="navToggle" aria-label="Abrir menu" aria-expanded="false" aria-controls="mobileNav">
                    <i class="fa-solid fa-bars"></i>
                </button>

            </div>
        </div>
    </header>

    {{-- ===== MENU MOBILE (SLIDE-OUT) ===== --}}
    <div class="mobile-nav" id="mobileNav" role="dialog" aria-modal="true" aria-label="Menu de navegação">
        <div class="mobile-nav-backdrop" id="mobileNavBackdrop"></div>
        <div class="mobile-nav-panel">

            <div class="mobile-nav-header">
                <a href="{{ route('inicio') }}" class="logo">
                    <i class="fa-solid fa-desktop"></i> Monitor<span>Store</span>
                </a>
                <button class="mobile-nav-close" id="navClose" aria-label="Fechar menu">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <nav>
                <ul class="mobile-nav-links">
                    <li class="{{ request()->routeIs('inicio') ? 'ativo' : '' }}">
                        <a href="{{ route('inicio') }}">
                            <i class="fa-solid fa-house"></i> Início
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('loja.monitores') ? 'ativo' : '' }}">
                        <a href="{{ route('loja.monitores') }}">
                            <i class="fa-solid fa-display"></i> Monitores
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('loja.perifericos') ? 'ativo' : '' }}">
                        <a href="{{ route('loja.perifericos') }}">
                            <i class="fa-solid fa-display"></i> Periféricos
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('loja.acessorios') ? 'ativo' : '' }}">
                        <a href="{{ route('loja.acessorios') }}">
                            <i class="fa-solid fa-plug"></i> Acessórios
                        </a>
                    </li>
                    @if(session()->has('cliente_id'))

                        <a href="{{ route('loja.minhaconta', session('cliente_id')) }}">
                            <i class="fa-regular fa-user"></i> Minha Conta
                        </a>

                    @else

                        <a href="{{ route('login') }}">
                            <i class="fa-regular fa-user"></i> Login
                        </a>

                    @endif
                    <li class="{{ request()->routeIs('loja.carrinho') ? 'ativo' : '' }}">
                        <a href="{{ route('loja.carrinho') }}">
                            <i class="fa-solid fa-cart-shopping"></i> Carrinho
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('loja.contato') ? 'ativo' : '' }}">
                        <a href="{{ route('loja.contato') }}">
                            <i class="fa-solid fa-envelope"></i> Contato
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="mobile-nav-footer">
                <div class="mobile-search" role="search">
                    <input type="text" placeholder="Buscar produtos..." aria-label="Buscar produtos">
                    <button type="button" aria-label="Pesquisar">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>

    {{-- ===== CONTEÚDO DA PÁGINA ===== --}}
    @yield('contentlogin')


    {{-- ===== JS: Menu mobile ===== --}}
    <script>
    (function () {
        const toggle   = document.getElementById('navToggle');
        const closeBtn = document.getElementById('navClose');
        const backdrop = document.getElementById('mobileNavBackdrop');
        const nav      = document.getElementById('mobileNav');

        function openNav() {
            nav.classList.add('open');
            toggle.setAttribute('aria-expanded', 'true');
            document.body.style.overflow = 'hidden';
        }

        function closeNav() {
            nav.classList.remove('open');
            toggle.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
        }

        toggle.addEventListener('click', openNav);
        closeBtn.addEventListener('click', closeNav);
        backdrop.addEventListener('click', closeNav);

        // Fecha com ESC
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape' && nav.classList.contains('open')) closeNav();
        });
    })();
    </script>

</body>
</html>