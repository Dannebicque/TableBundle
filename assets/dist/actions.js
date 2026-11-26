import { send } from './http.js';

/*
 * data-confirm, data-xhr, data-spinner, listes déroulantes « live update », cases à cocher et détails de ligne.
 * Événements émis (bulles) : dannebicque-table:success, dannebicque-table:error, dannebicque-table:selection.
 */
export default class Actions {
    constructor(table, signal) {
        this.table = table;
        const { root } = table;

        // phase de capture : un refus doit bloquer les autres écouteurs (Stimulus, Bootstrap…)
        root.addEventListener('click', (event) => this._click(event), { signal, capture: true });
        root.addEventListener('change', (event) => this._change(event), { signal });
    }

    _click(event) {
        const details = event.target.closest('[data-row-details]');
        if (details) {
            event.preventDefault();
            this._toggleDetails(details);
            return;
        }

        const element = event.target.closest('[data-confirm], [data-xhr]');
        if (!element) {
            return;
        }
        if (element.dataset.confirm && !window.confirm(element.dataset.confirm)) {
            event.preventDefault();
            event.stopImmediatePropagation();
            return;
        }
        if (element.dataset.xhr) {
            event.preventDefault();
            this._run(element, element.dataset.xhr, { method: element.dataset.method, token: element.dataset.token });
        }
    }

    _change(event) {
        const { target } = event;

        if (target.matches('[data-live-update]')) {
            const params = JSON.parse(target.dataset.params || '{}');
            this._run(target, target.dataset.route, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ ...params, value: target.value }),
                token: target.dataset.token,
            });
        } else if (target.matches('.row-selector')) {
            this._select(target);
        }
    }

    async _run(element, url, options) {
        if (element.dataset.busy) {
            return;
        }
        element.dataset.busy = 'true';
        element.setAttribute('aria-busy', 'true');
        let spinner;
        if (element.dataset.spinner) {
            spinner = document.createElement('span');
            spinner.className = 'spinner-border spinner-border-sm';
            element.append(spinner);
        }

        try {
            const response = await send(url, options);
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }
            const data = response.headers.get('Content-Type')?.includes('json') ? await response.json() : null;
            const handled = !this._emit(element, 'success', { response, data });
            if (!handled) {
                this.table.alert('');
                if (data?.redirect) {
                    window.location.assign(data.redirect);
                } else if (!element.matches('[data-live-update]')) {
                    this.table.load();
                }
            }
        } catch (error) {
            console.error(error);
            this._emit(element, 'error', { error });
            this.table.alert(this.table.messages.actionError);
        } finally {
            delete element.dataset.busy;
            element.removeAttribute('aria-busy');
            spinner?.remove();
        }
    }

    _toggleDetails(handle) {
        const row = handle.closest('tr');
        if (row.nextElementSibling?.matches('[data-details-row]')) {
            row.nextElementSibling.remove();
            handle.setAttribute('aria-expanded', 'false');
            handle.textContent = '▸';
            return;
        }
        const detailsRow = document.createElement('tr');
        detailsRow.dataset.detailsRow = '';
        const cell = detailsRow.insertCell();
        cell.colSpan = row.cells.length;
        // contenu HTML fourni par l'option render_details, écrite par le développeur
        cell.innerHTML = handle.dataset.rowDetails;
        row.after(detailsRow);
        handle.setAttribute('aria-expanded', 'true');
        handle.textContent = '▾';
    }

    _select(checkbox) {
        const { root } = this.table;
        const boxes = [...root.querySelectorAll('tbody input.row-selector[type=checkbox]')];
        if (checkbox.closest('thead')) {
            boxes.forEach((box) => { box.checked = checkbox.checked; });
        }
        const values = boxes.filter((box) => box.checked).map((box) => box.value);
        this._emit(root, 'selection', { values });
    }

    _emit(element, name, detail) {
        return element.dispatchEvent(new CustomEvent(`dannebicque-table:${name}`, { bubbles: true, cancelable: true, detail }));
    }
}
