@extends('layout_login')

@section('contentlogin')

<link rel="stylesheet" href="{{ asset('/css/cliente/login.css') }}">

<main class="admin-conteudo login-flex-wrapper">

    @if(session('mensagem'))

    <script>

        window.onload = function () {

            alert("{{ session('mensagem') }}");

        }

    </script>

    @endif

    <div class="login-compact-card">
        
        <div class="login-header-compact">

            <h2>Entrar</h2>

            <p>
                Acesse sua conta para continuar.
            </p>

        </div>

        <form action="{{ request()->is('funcionario/*')
                ? route('funcionario.auth')
                : route('login.auth') }}"
              method="POST"
              class="login-form-compact">

            @csrf
            
            <div class="form-group-compact">

                <label for="login-email">
                    E-mail
                </label>

                <div class="input-box">

                    <i class="fa-regular fa-envelope"></i>

                    <input
                        type="email"
                        id="login-email"
                        name="email"
                        placeholder="seu@email.com"
                        required
                    >

                </div>

            </div>

            <div class="form-group-compact">

                <label for="login-password">
                    Senha
                </label>

                <div class="input-box">

                    <i class="fa-solid fa-lock"></i>

                    <input
                        type="password"
                        id="login-password"
                        name="senha"
                        placeholder="••••••••"
                        required
                    >

                    <button
                        type="button"
                        class="btn-toggle-view"
                        aria-label="Mostrar senha"
                    >

                        <i class="fa-regular fa-eye"></i>

                    </button>

                </div>

                <a href="#" class="link-forgot">
                    Esqueci minha senha
                </a>

            </div>

            <button type="submit"
                    class="btn-submit-compact">

                Entrar

            </button>

        </form>

        <div class="divider-compact"></div>

        {{-- LOGIN FUNCIONÁRIO --}}
        @if(!request()->is('funcionario/*'))

        <div class="register-action">

            <p>
                É um funcionário?
            </p>

            <a href="{{ route('funcionario.login') }}"
               class="btn-outline-compact">

                Login Funcionário

            </a>

        </div>

        <div class="divider-compact"></div>

        @endif

        {{-- CRIAR CONTA --}}
        <div class="register-action">

            <p>
                Ainda não possui conta?
            </p>

            <a href="{{ route('loja.criar') }}"
               class="btn-outline-compact">

                Criar Conta

            </a>

        </div>

    </div>

</main>

<script>

document.addEventListener('DOMContentLoaded', function() {

    const btnToggle =
        document.querySelector('.btn-toggle-view');

    const inputPass =
        document.getElementById('login-password');

    if (btnToggle && inputPass) {

        btnToggle.addEventListener('click', function() {

            const isPassword =
                inputPass.getAttribute('type')
                === 'password';

            inputPass.setAttribute(
                'type',
                isPassword ? 'text' : 'password'
            );
            
            const icon =
                this.querySelector('i');

            icon.className =
                isPassword
                ? 'fa-regular fa-eye-slash'
                : 'fa-regular fa-eye';

        });

    }

});

</script>

@endsection