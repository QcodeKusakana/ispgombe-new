(() => {
    const button = document.querySelector('.nav-toggle');
    const navigation = document.getElementById('site-navigation');
    if (button && navigation) {
        const setNavigationOpen = (open) => {
            button.setAttribute('aria-expanded', String(open));
            button.setAttribute('aria-label', open ? 'Fermer le menu' : 'Ouvrir le menu');
            navigation.classList.toggle('is-open', open);
        };
        button.addEventListener('click', () => {
            const open = button.getAttribute('aria-expanded') !== 'true';
            setNavigationOpen(open);
        });
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && button.getAttribute('aria-expanded') === 'true') {
                setNavigationOpen(false);
                button.focus();
            }
        });
        document.addEventListener('click', (event) => {
            if (button.getAttribute('aria-expanded') === 'true' && !navigation.contains(event.target) && !button.contains(event.target)) {
                setNavigationOpen(false);
            }
        });
    }

    const lightbox = document.querySelector('[data-governance-lightbox]');
    const lightboxImage = lightbox?.querySelector('[data-governance-lightbox-image]');
    const lightboxCaption = lightbox?.querySelector('[data-governance-lightbox-caption]');
    if (lightbox && typeof lightbox.showModal === 'function' && lightboxImage) {
        document.querySelectorAll('[data-governance-photo]').forEach((trigger) => {
            trigger.addEventListener('click', () => {
                lightboxImage.src = trigger.dataset.photoSrc || '';
                lightboxImage.alt = trigger.dataset.photoAlt || 'Portrait du Comité de gestion';
                if (lightboxCaption) lightboxCaption.textContent = trigger.dataset.photoAlt || '';
                lightbox.showModal();
            });
        });
        lightbox.querySelector('[data-governance-close]')?.addEventListener('click', () => lightbox.close());
        lightbox.addEventListener('click', (event) => {
            if (event.target === lightbox) lightbox.close();
        });
        lightbox.addEventListener('close', () => {
            lightboxImage.removeAttribute('src');
            lightboxImage.alt = '';
        });
    }

    const carousel = document.querySelector('[data-image-carousel]');
    if (!carousel) return;
    const slides = Array.from(carousel.querySelectorAll('[data-image-slide]'));
    const dots = Array.from(carousel.querySelectorAll('[data-image-slide-to]'));
    const toggle = carousel.querySelector('[data-image-toggle]');
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    let active = 0;
    let timer = null;
    let pointerInside = false;
    let focusInside = false;
    let paused = reducedMotion || slides.length < 2;
    if (toggle) {
        toggle.setAttribute('aria-pressed', String(paused));
        toggle.setAttribute('aria-label', paused ? 'Reprendre le défilement' : 'Mettre le défilement en pause');
        toggle.textContent = paused ? '▶' : 'Ⅱ';
    }

    const show = (index) => {
        active = (index + slides.length) % slides.length;
        slides.forEach((slide, position) => {
            const selected = position === active;
            slide.hidden = !selected;
            slide.classList.toggle('is-active', selected);
        });
        dots.forEach((dot, position) => {
            if (position === active) dot.setAttribute('aria-current', 'true');
            else dot.removeAttribute('aria-current');
        });
    };
    const stopTimer = () => { window.clearTimeout(timer); timer = null; };
    const schedule = () => {
        stopTimer();
        if (!paused && !pointerInside && !focusInside) timer = window.setTimeout(() => { show(active + 1); schedule(); }, 6500);
    };
    carousel.querySelector('[data-image-prev]')?.addEventListener('click', () => { show(active - 1); schedule(); });
    carousel.querySelector('[data-image-next]')?.addEventListener('click', () => { show(active + 1); schedule(); });
    dots.forEach((dot) => dot.addEventListener('click', () => { show(Number(dot.dataset.imageSlideTo)); schedule(); }));
    toggle?.addEventListener('click', () => {
        paused = !paused;
        toggle.setAttribute('aria-pressed', String(paused));
        toggle.setAttribute('aria-label', paused ? 'Reprendre le défilement' : 'Mettre le défilement en pause');
        toggle.textContent = paused ? '▶' : 'Ⅱ';
        schedule();
    });
    carousel.addEventListener('mouseenter', () => { pointerInside = true; stopTimer(); });
    carousel.addEventListener('mouseleave', () => { pointerInside = false; schedule(); });
    carousel.addEventListener('focusin', () => { focusInside = true; stopTimer(); });
    carousel.addEventListener('focusout', (event) => {
        if (!carousel.contains(event.relatedTarget)) { focusInside = false; schedule(); }
    });
    show(0);
    schedule();
})();
