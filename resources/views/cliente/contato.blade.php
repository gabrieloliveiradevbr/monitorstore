@extends('layout_cliente')

@section('contentcliente')
<link rel="stylesheet" href="{{ asset('/css/cliente/contato.css') }}">

<main class="conteudo-principal">

    {{-- ===== HERO DO CONTATO ===== --}}
    <div class="contact-hero">
        <div class="contact-hero-content">
            <h1>Fale <span>Conosco</span></h1>
            <p>Estamos aqui para ajudar. Envie sua dúvida, sugestão ou solicitação — respondemos em até 24 horas.</p>
        </div>
        <div class="contact-hero-badges">
            <div class="hero-badge">
                <i class="fa-solid fa-clock"></i> Resposta em até 24h
            </div>
            <div class="hero-badge">
                <i class="fa-solid fa-shield-halved"></i> Dados protegidos
            </div>
            <div class="hero-badge">
                <i class="fa-brands fa-whatsapp"></i> WhatsApp disponível
            </div>
        </div>
    </div>

    {{-- ===== GRID: FORMULÁRIO + INFORMAÇÕES ===== --}}
    <div class="contact-container">

        {{-- ===== FORMULÁRIO ===== --}}
        <div class="contact-card contact-form-wrapper">
            <span class="section-label"><i class="fa-solid fa-envelope"></i> Formulário</span>
            <h2>Envie uma mensagem</h2>

            <form method="POST" action="processa_contato.php" class="contact-form" id="contactForm" novalidate>

                <div class="form-row">
                    <div class="form-group">
                        <label for="nome">Nome Completo</label>
                        <input type="text" id="nome" name="nome" class="form-control"
                               placeholder="Seu nome" required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" class="form-control"
                               placeholder="seu@email.com.br" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="assunto">Assunto</label>
                    <input type="text" id="assunto" name="assunto" class="form-control"
                           placeholder="Sobre o que deseja falar?" required>
                </div>

                <div class="form-group">
                    <label for="mensagem">Mensagem</label>
                    <textarea id="mensagem" name="mensagem" rows="5" class="form-control"
                              placeholder="Escreva sua mensagem aqui..." required></textarea>
                </div>

                <button type="submit" class="btn-submit" id="btnSubmit">
                    <i class="fa-solid fa-paper-plane"></i> Enviar Mensagem
                </button>

            </form>
        </div>

        {{-- ===== COLUNA DIREITA ===== --}}
        <aside class="contact-info-wrapper">

            {{-- Card escuro com informações --}}
            <div class="info-card-dark">
                <span class="section-label"><i class="fa-solid fa-store"></i> Loja</span>
                <h2>Informações da Loja</h2>

                <ul class="info-list">
                    <li>
                        <div class="info-icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="info-text">
                            <strong>Endereço</strong>
                            Av. da Tecnologia, 1024 — Bairro Tech<br>
                            São Paulo - SP, 01000-000
                        </div>
                    </li>
                    <li>
                        <div class="info-icon">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="info-text">
                            <strong>Telefone / WhatsApp</strong>
                            (11) 99999-0000<br>
                            (11) 4002-8922
                        </div>
                    </li>
                    <li>
                        <div class="info-icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div class="info-text">
                            <strong>E-mail</strong>
                            contato@monitorstore.com.br
                        </div>
                    </li>
                    <li>
                        <div class="info-icon">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div class="info-text">
                            <strong>Atendimento</strong>
                            Seg. a Sex.: 08h às 18h<br>
                            Sábado: 09h às 13h
                        </div>
                    </li>
                </ul>
            </div>

            {{-- Mapa --}}
            <div class="map-card">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58517.22414036745!2d-46.68036576683273!3d-23.556714093778854!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce5984faf5be37%3A0x1b649358f56e7f4d!2sID%20Technology!5e0!3m2!1spt-BR!2sbr!4v1775498405415!5m2!1spt-BR!2sbr"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Localização da Monitor Store">
                </iframe>
            </div>

        </aside>
    </div>

</main>

{{-- ===== JS: Feedback de envio ===== --}}
<script>
document.getElementById('contactForm').addEventListener('submit', function (e) {
    e.preventDefault(); // remova esta linha quando conectar ao backend

    const btn = document.getElementById('btnSubmit');
    const original = btn.innerHTML;

    btn.innerHTML = '<i class="fa-solid fa-check"></i> Mensagem enviada!';
    btn.classList.add('sent');
    btn.disabled = true;

    setTimeout(() => {
        btn.innerHTML = original;
        btn.classList.remove('sent');
        btn.disabled = false;
        this.reset();
    }, 3000);
});

// Highlight sutil nos campos ao focar
document.querySelectorAll('.form-control').forEach(input => {
    input.addEventListener('focus', () => {
        input.closest('.form-group').querySelector('label').style.color = 'var(--ms-black)';
    });
    input.addEventListener('blur', () => {
        input.closest('.form-group').querySelector('label').style.color = '';
    });
});
</script>

@endsection