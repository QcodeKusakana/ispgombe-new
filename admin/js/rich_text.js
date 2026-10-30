(() => {
    const editorBySource = new WeakMap();

    const toolbarOptions = [
        [{ header: [2, 3, false] }],
        ['bold', 'italic', 'underline', 'strike'],
        [{ list: 'ordered' }, { list: 'bullet' }],
        [{ align: [] }],
        ['blockquote', 'link'],
        ['clean'],
    ];
    const labels = {
        bold: 'Gras', italic: 'Italique', underline: 'Souligné', strike: 'Barré',
        'list:ordered': 'Liste numérotée', 'list:bullet': 'Liste à puces',
        blockquote: 'Citation', link: 'Insérer un lien', clean: 'Effacer la mise en forme',
    };

    const initializeEditor = (source) => {
        if (!window.Quill || editorBySource.has(source) || source.getClientRects().length === 0) return;
        const host = document.createElement('div');
        host.className = 'admin-rich-editor';
        source.insertAdjacentElement('afterend', host);

        try {
            const editor = new window.Quill(host, { theme: 'snow', modules: { toolbar: toolbarOptions } });
            if (source.value.trim() !== '') editor.clipboard.dangerouslyPasteHTML(source.value);
            editor.enable(!source.readOnly);
            host.classList.toggle('is-readonly', source.readOnly);
            const required = source.required;
            source.required = false;

            const label = source.id
                ? Array.from(document.querySelectorAll('label[for]')).find((candidate) => candidate.htmlFor === source.id)
                : null;
            if (label) {
                if (!label.id) label.id = `rich-label-${Math.random().toString(36).slice(2)}`;
                editor.root.setAttribute('aria-labelledby', label.id);
            } else {
                editor.root.setAttribute('aria-label', source.getAttribute('aria-label') || 'Description');
            }

            host.querySelectorAll('button.ql-list').forEach((button) => {
                button.setAttribute('aria-label', button.value === 'ordered' ? labels['list:ordered'] : labels['list:bullet']);
            });
            host.querySelectorAll('button.ql-bold,button.ql-italic,button.ql-underline,button.ql-strike,button.ql-blockquote,button.ql-link,button.ql-clean').forEach((button) => {
                const format = Array.from(button.classList).find((className) => className.startsWith('ql-'))?.slice(3);
                if (format && labels[format]) button.setAttribute('aria-label', labels[format]);
            });
            host.querySelectorAll('select.ql-header,select.ql-align').forEach((select) => {
                select.setAttribute('aria-label', select.classList.contains('ql-header') ? 'Style de titre' : 'Alignement du texte');
            });

            source.hidden = true;
            editorBySource.set(source, editor);
            const form = source.closest('form');
            form?.addEventListener('submit', (event) => {
                source.value = editor.root.innerHTML;
                if (required && editor.getText().trim() === '') {
                    event.preventDefault();
                    host.classList.add('is-invalid');
                    editor.root.setAttribute('aria-invalid', 'true');
                    editor.root.focus();
                }
            });
            editor.on('text-change', () => {
                host.classList.remove('is-invalid');
                editor.root.removeAttribute('aria-invalid');
            });
        } catch (error) {
            host.remove();
            console.error('Impossible d’initialiser l’éditeur de texte enrichi.', error);
        }
    };

    const initializeVisibleEditors = (container = document) => {
        if (!container || typeof container.querySelectorAll !== 'function') return;
        if (container.matches?.('textarea[data-rich-text]')) initializeEditor(container);
        container.querySelectorAll('textarea[data-rich-text]').forEach(initializeEditor);
    };

    // Do not calculate Quill's toolbar geometry in display:none modals or closed details.
    initializeVisibleEditors();
    document.addEventListener('shown.bs.modal', (event) => initializeVisibleEditors(event.target));
    document.addEventListener('toggle', (event) => {
        if (event.target instanceof HTMLDetailsElement && event.target.open) {
            requestAnimationFrame(() => initializeVisibleEditors(event.target));
        }
    }, true);

    document.querySelectorAll('button[data-edit-content]').forEach((button) => {
        button.addEventListener('click', () => {
            const form = button.closest('form');
            if (!form) return;
            const editing = button.getAttribute('aria-pressed') !== 'true';
            button.setAttribute('aria-pressed', String(editing));
            button.innerHTML = editing
                ? '<i class="bi bi-check2 me-1" aria-hidden="true"></i> Terminer la modification'
                : '<i class="bi bi-pencil-square me-1" aria-hidden="true"></i> Modifier';
            form.querySelectorAll('input:not([type="hidden"]),textarea').forEach((field) => {
                field.readOnly = !editing;
                const editor = editorBySource.get(field);
                if (editor) {
                    editor.enable(editing);
                    editor.container.parentElement?.classList.toggle('is-readonly', !editing);
                }
            });
            if (editing) {
                const firstEditor = form.querySelector('.admin-rich-editor .ql-editor');
                const firstField = form.querySelector('input:not([type="hidden"])');
                (firstEditor || firstField)?.focus();
            }
        });
    });
})();
