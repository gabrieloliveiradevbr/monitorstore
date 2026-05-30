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

            <h2>Login Funcionário</h2>

            <p>
                Acesso restrito ao painel administrativo.
            </p>

        </div>

        <form action="{{ route('funcionario.auth') }}"
              method="POST"
              class="login-form-compact">

            @csrf
            
            <div class="form-group-compact">

                <label for="login-email">
                    E-mail Corporativo
                </label>

                <div class="input-box">

                    <i class="fa-regular fa-envelope"></i>

                    <input
                        type="email"
                        id="login-email"
                        name="email"
                        placeholder="funcionario@monitorstore.com"
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

            </div>

            <button type="submit"
                    class="btn-submit-compact">

                Entrar no Painel

            </button>

        </form>

        <div class="divider-compact"></div>

        <div class="register-action">

            <p>
                Deseja voltar para a loja?
            </p>

            <a href="{{ route('login') }}"
               class="btn-outline-compact">

                Login Cliente

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