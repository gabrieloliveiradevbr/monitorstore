@extends('layout_login')

@section('contentlogin')
<link rel="stylesheet" href="{{ asset('/css/cliente/login.css') }}">
<link rel="stylesheet" href="{{ asset('/css/cliente/criarconta.css') }}">

<main class="conteudo-principal login-flex-wrapper no-scroll-area">
    <div class="login-compact-card register-wide-card">
        
        <div class="login-header-compact">
            <h2>Criar Conta</h2>
            <p>Preencha os dados abaixo para se cadastrar.</p>
        </div>

        <form action="/clientes" method="POST" class="login-form-compact scrollable-form">
            @csrf
            <div class="form-row-compact">
                <div class="form-group-compact half-width">
                    <label for="reg-nome">Nome Completo</label>
                    <div class="input-box">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" id="reg-nome" name="nome" placeholder="Seu nome" required>
                    </div>
                </div>

                <div class="form-group-compact half-width">
                    <label for="reg-email">E-mail</label>
                    <div class="input-box">
                        <i class="fa-regular fa-envelope"></i>
                        <input type="email" id="reg-email" name="email" placeholder="seu@email.com" required>
                    </div>
                </div>
            </div>

            <div class="form-row-compact">
                <div class="form-group-compact half-width">
                    <label for="reg-cpf">CPF</label>
                    <div class="input-box">
                        <i class="fa-solid fa-id-card"></i>
                        <input type="text" id="reg-cpf" name="cpf" placeholder="000.000.000-00" required>
                    </div>
                </div>
                
                <div class="form-group-compact half-width">
                    <label for="reg-telefone">Telefone</label>
                    <div class="input-box">
                        <i class="fa-solid fa-phone"></i>
                        <input type="tel" id="reg-telefone" name="telefone" placeholder="(00) 00000-0000" required>
                    </div>
                </div>
            </div>

            <div class="form-group-compact">
                <label for="reg-endereco">Endereço Completo</label>
                <div class="input-box">
                    <i class="fa-solid fa-location-dot"></i>
                    <input type="text" id="reg-endereco" name="endereco" placeholder="Rua, Número, Bairro, Cidade" required>
                </div>
            </div>

            <div class="form-row-compact">
                <div class="form-group-compact half-width">
                    <label for="reg-senha">Senha</label>
                    <div class="input-box">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="reg-senha" name="senha" placeholder="••••••••" required>
                        <button type="button" class="btn-toggle-view" aria-label="Mostrar senha" onclick="togglePass('reg-senha', this)">
                            <i class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <div class="form-group-compact half-width">
                    <label for="reg-conf-senha">Confirmar Senha</label>
                    <div class="input-box">
                        <i class="fa-solid fa-shield-halved"></i>
                        <input type="password" id="reg-conf-senha" name="confirmar_senha" placeholder="••••••••" required>
                        <button type="button" class="btn-toggle-view" aria-label="Mostrar senha" onclick="togglePass('reg-conf-senha', this)">
                            <i class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-submit-compact">Criar Conta</button>

        @if(session('mensagem'))
            <script>
                window.onload = function () {
                    alert("{{ session('mensagem') }}");
                }
            </script>
        @endif
        </form>

        <div class="divider-compact"></div>

        <div class="register-action">
            <p>Já possui conta?</p>
            <a href="#" class="btn-outline-compact">Entrar</a>
        </div>

    </div>
</main>

<script>
function togglePass(inputId, button) {
    const input = document.getElementById(inputId);
    const icon = button.querySelector('i');
    
    if (input.type === "password") {
        input.type = "text";
        icon.className = 'fa-regular fa-eye-slash';
    } else {
        input.type = "password";
        icon.className = 'fa-regular fa-eye';
    }
}
</script>

@endsection