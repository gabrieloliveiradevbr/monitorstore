/**
 * Monitor Store — Home Page JS
 * Interações leves: animações de entrada, ripple, carrinho, toast.
 */

(function () {
    'use strict';

    /* =====================================================
       1. ANIMAÇÕES DE ENTRADA (Intersection Observer)
       ===================================================== */
    const animTargets = document.querySelectorAll('[data-animate]');

    if (animTargets.length > 0 && 'IntersectionObserver' in window) {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) return;

                    const el    = entry.target;
                    const delay = parseInt(el.dataset.delay || 0, 10);

                    setTimeout(() => {
                        el.classList.add('is-visible');
                    }, delay);

                    observer.unobserve(el);
                });
            },
            { threshold: 0.12 }
        );

        animTargets.forEach((el) => observer.observe(el));
    } else {
        // Fallback: mostra tudo imediatamente
        animTargets.forEach((el) => el.classList.add('is-visible'));
    }

    /* =====================================================
       2. EFEITO RIPPLE NOS BOTÕES
       ===================================================== */
    document.querySelectorAll('.btn--ripple').forEach((btn) => {
        btn.addEventListener('click', function (e) {
            const circle = document.createElement('span');
            circle.classList.add('ripple');

            const rect   = this.getBoundingClientRect();
            const size   = Math.max(rect.width, rect.height);
            const x      = e.clientX - rect.left - size / 2;
            const y      = e.clientY - rect.top  - size / 2;

            circle.style.cssText = `
                width: ${size}px;
                height: ${size}px;
                left: ${x}px;
                top: ${y}px;
            `;

            this.appendChild(circle);
            circle.addEventListener('animationend', () => circle.remove());
        });
    });

    /* =====================================================
       3. BOTÃO "ADICIONAR AO CARRINHO" — feedback visual
       ===================================================== */
    const toast    = document.getElementById('cartToast');
    const toastMsg = document.getElementById('cartToastMsg');
    let toastTimer = null;

    function showToast(productName) {
        if (!toast) return;

        toastMsg.textContent = `"${productName}" adicionado ao carrinho!`;
        toast.classList.add('show');

        clearTimeout(toastTimer);
        toastTimer = setTimeout(() => {
            toast.classList.remove('show');
        }, 2800);
    }

    document.querySelectorAll('.btn--cart').forEach((btn) => {
        btn.addEventListener('click', function () {
            const productName = this.dataset.product || 'Produto';

            if (this.classList.contains('added')) return;

            // Troca estado visual do botão
            const original = this.innerHTML;
            this.innerHTML = '<i class="fa-solid fa-check"></i> Adicionado!';
            this.classList.add('added');
            this.disabled = true;

            showToast(productName);

            // Reverte após 2.5s
            setTimeout(() => {
                this.innerHTML = original;
                this.classList.remove('added');
                this.disabled = false;
            }, 2500);
        });
    });

    /* =====================================================
       4. HOVER TILT SUAVE NAS CATEGORY CARDS
       ===================================================== */
    document.querySelectorAll('[data-tilt]').forEach((card) => {
        card.addEventListener('mousemove', function (e) {
            const rect = this.getBoundingClientRect();
            const x    = (e.clientX - rect.left) / rect.width  - 0.5; // -0.5 a 0.5
            const y    = (e.clientY - rect.top)  / rect.height - 0.5;

            const rotateX = (-y * 8).toFixed(2);
            const rotateY = ( x * 8).toFixed(2);

            this.style.transform    = `perspective(600px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-5px)`;
            this.style.transition   = 'transform 0.1s linear';
        });

        card.addEventListener('mouseleave', function () {
            this.style.transform  = '';
            this.style.transition = 'transform 0.45s cubic-bezier(0.22, 1, 0.36, 1)';
        });
    });

    /* =====================================================
       5. SMOOTH SCROLL para âncoras internas
       ===================================================== */
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const target = document.querySelector(targetId);
            if (!target) return;

            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });

    /* =====================================================
       6. ANIMAÇÃO DO BADGE DE OFERTA (escala ao entrar na view)
       ===================================================== */
    const badges = document.querySelectorAll('.offer-card__badge');

    if ('IntersectionObserver' in window && badges.length > 0) {
        const badgeObs = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.style.animationPlayState = 'running';
                        badgeObs.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.5 }
        );

        badges.forEach((b) => {
            b.style.animationPlayState = 'paused';
            badgeObs.observe(b);
        });
    }

})();