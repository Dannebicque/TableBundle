import { Controller } from '@hotwired/stimulus';
import { send } from './http.js';

/*
 * Modale basée sur l'élément natif <dialog>. Le HTML chargé vient de l'application (même origine) ;
 * ses balises <script> ne sont pas exécutées.
 * Un formulaire invalide doit répondre 422 (comportement par défaut de render() avec Symfony).
 */
export default class extends Controller {
    static values = { modalUrl: String, size: String, modalTitle: String };

    async openModal(event) {
        event.preventDefault();
        this.root = this.element.closest('.datable-container');
        this._build();
        await this._load(this.modalUrlValue);
    }

    _build() {
        this.dialog?.remove();
        const dialog = document.createElement('dialog');
        dialog.className = `table-modal table-modal-${this.sizeValue || 'md'}`;
        dialog.style.width = { sm: '20rem', md: '32rem', lg: '50rem', xl: '70rem' }[this.sizeValue] ?? '32rem';
        dialog.style.maxWidth = '95vw';

        const header = document.createElement('div');
        header.style.cssText = 'display:flex;justify-content:space-between;gap:1rem;align-items:center';
        const title = document.createElement('strong');
        title.textContent = this.modalTitleValue;
        const close = document.createElement('button');
        close.type = 'button';
        close.textContent = '×';
        close.dataset.modalClose = '';
        close.setAttribute('aria-label', this.root?.dataset.closeLabel ?? 'Close');
        header.append(title, close);

        this.body = document.createElement('div');
        dialog.append(header, this.body);
        dialog.addEventListener('click', (event) => {
            if (event.target === dialog || event.target.closest('[data-modal-close]')) {
                dialog.close();
            }
        });
        dialog.addEventListener('close', () => dialog.remove());
        dialog.addEventListener('submit', (event) => this._submit(event));
        document.body.append(dialog);
        this.dialog = dialog;
        dialog.showModal();
    }

    async _load(url, options) {
        try {
            const response = await send(url, options);
            if (!response.ok && response.status !== 422) {
                throw new Error(`HTTP ${response.status}`);
            }
            const submitted = options?.method && options.method !== 'GET';
            // soumission acceptée : redirection, 204 ou toute réponse 2xx
            if (submitted && response.ok) {
                this.dialog.close();
                this.root?.dispatchEvent(new CustomEvent('dannebicque-table:reload'));
                return;
            }
            this.body.innerHTML = await response.text();
        } catch (error) {
            console.error(error);
            this.body.textContent = this.root?.dataset.errorLabel ?? 'Error';
        }
    }

    _submit(event) {
        const form = event.target;
        const method = (form.getAttribute('method') || 'GET').toUpperCase();
        if (method === 'DIALOG') {
            return;
        }
        event.preventDefault();
        const data = new FormData(form, event.submitter);
        const url = new URL(form.getAttribute('action') || this.modalUrlValue, window.location.href);
        if (method === 'GET') {
            url.search = new URLSearchParams(data).toString();
            this._load(url);
        } else {
            this._load(url, { method, body: data });
        }
    }
}
