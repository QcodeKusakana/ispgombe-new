(() => {
    const allowedTypes = 'image/jpeg,image/png,image/webp';
    const guidanceText = 'JPG, PNG ou WebP — 15 Mo maximum.';

    document.querySelectorAll('input[type="file"]').forEach((input) => {
        input.accept = allowedTypes;

        const nextElement = input.nextElementSibling;
        if (nextElement?.matches('[data-image-upload-guidance]') || (nextElement?.classList.contains('form-text') && nextElement.textContent.includes('15 Mo maximum'))) {
            return;
        }

        const guidance = document.createElement('div');
        guidance.className = 'form-text';
        guidance.dataset.imageUploadGuidance = '';
        guidance.textContent = guidanceText;
        input.insertAdjacentElement('afterend', guidance);
    });
})();
