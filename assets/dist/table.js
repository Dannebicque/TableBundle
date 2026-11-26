import Actions from './actions.js';

const ICONS = { ASC: '▲', DESC: '▼', NONE: '▲▼' };

export default class Table {
    constructor(root) {
        this.root = root;
        this.options = JSON.parse(root.dataset.options);
        this.url = this.options.ajax.url || window.location.href;
        this.body = root.querySelector('table.datable > tbody');
        this.headers = [...root.querySelectorAll('table.datable > thead th[data-column]')];
        this.form = root.querySelector('form');
        this.page = this.options.pageActive || 1;
        this.pageLength = this.options.pageLength;
        this.order = [];
        this.filter = {};
        this.listeners = new AbortController();
        this.messages = this.options.messages;
        new Actions(this, this.listeners.signal);
        root.addEventListener('dannebicque-table:reload', () => this.load(), { signal: this.listeners.signal });

        this._initHeaders();
        this._initFilters();
        this._initPaging();
        this.load();
    }

    destroy() {
        this.listeners.abort();
        this.request?.abort();
        clearTimeout(this.timer);
    }

    async load() {
        this.request?.abort();
        this.request = new AbortController();

        const body = { order: this.order, filter: this.filter };
        if (this.options.paging) {
            body.paging = { pageLength: this.pageLength, pageActive: this.page };
        }

        try {
            const response = await fetch(this.url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', Accept: 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                body: JSON.stringify(body),
                signal: this.request.signal,
            });
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }
            const data = await response.json();
            this._renderRows(data.data);
            this.body.querySelectorAll('[data-init-state=expanded]').forEach((handle) => handle.click());
            const selectAll = this.root.querySelector('thead input.row-selector');
            if (selectAll) {
                selectAll.checked = false;
            }
            this._renderPaging(data.paging);
        } catch (error) {
            if (error.name !== 'AbortError') {
                console.error(error);
                this._renderMessage(this.messages.loadError);
            }
        }
    }

    _reload() {
        this.page = 1;
        this.load();
    }

    // Les cellules contiennent du HTML déjà échappé côté serveur (option is_safe_html des colonnes).
    _renderRows(rows) {
        if (!rows.length) {
            this._renderMessage(this.messages.empty);
            return;
        }

        this.body.innerHTML = rows.map((row) => `<tr>${this.options.columns
            .map((column) => `<td class="${column.className ?? ''}">${row[column.id] ?? ''}</td>`)
            .join('')}</tr>`).join('');
    }

    _renderMessage(message) {
        const row = document.createElement('tr');
        const cell = row.insertCell();
        cell.colSpan = this.options.columns.length;
        cell.className = 'text-center';
        cell.textContent = message;
        this.body.replaceChildren(row);
    }

    alert(message) {
        const zone = this.root.querySelector('.toolbar-alert');
        if (zone) {
            zone.textContent = message;
            zone.setAttribute('role', 'alert');
        }
    }

    _initHeaders() {
        this.headers.forEach((header) => {
            const column = this.options.columns.find((c) => c.id === header.dataset.column);
            if (!column?.orderable) {
                return;
            }
            if (column.order) {
                this.order = [{ column: column.id, order: column.order }];
            }

            const indicator = document.createElement('span');
            indicator.dataset.sortIndicator = '';
            header.append(' ', indicator);
            header.style.cursor = 'pointer';
            header.addEventListener('click', () => {
                const current = this.order.find((o) => o.column === column.id)?.order;
                this.order = [{ column: column.id, order: current === 'ASC' ? 'DESC' : 'ASC' }];
                this._updateIndicators();
                this._reload();
            }, { signal: this.listeners.signal });
        });
        this._updateIndicators();
    }

    _updateIndicators() {
        this.headers.forEach((header) => {
            const indicator = header.querySelector('[data-sort-indicator]');
            if (indicator) {
                const order = this.order.find((o) => o.column === header.dataset.column)?.order;
                indicator.textContent = ICONS[order ?? 'NONE'];
            }
        });
    }

    _initFilters() {
        if (!this.form) {
            return;
        }
        const options = { signal: this.listeners.signal };
        const apply = () => {
            this.filter = this._readFilters();
            this._reload();
        };

        this.form.addEventListener('submit', (event) => {
            event.preventDefault();
            apply();
        }, options);
        this.form.addEventListener('input', (event) => {
            if (!event.target.matches('input:not([type=checkbox]):not([type=radio]):not([type=date]), textarea')) {
                return;
            }
            clearTimeout(this.timer);
            const { length } = event.target.value;
            // 1 ou 2 caractères : on attend ; champ vidé : on recharge
            if (length === 0 || length >= 3) {
                this.timer = setTimeout(apply, 300);
            }
        }, options);
        this.form.addEventListener('change', (event) => {
            if (event.target.matches('[data-live-update]')) {
                return;
            }
            if (event.target.matches('select, input[type=checkbox], input[type=radio], input[type=date]')) {
                apply();
            }
        }, options);
        this.root.querySelector('#eraseFiltre, [data-table-erase]')?.addEventListener('click', (event) => {
            event.preventDefault();
            this.form.reset();
            apply();
        }, options);
    }

    // « formulaire[champ] », « formulaire[champ][] » ou « formulaire[champ][sous] » -> objet imbriqué
    _readFilters() {
        const filters = {};
        new FormData(this.form).forEach((value, name) => {
            const keys = [...name.matchAll(/\[([^\]]*)\]/g)].map((match) => match[1]);
            if (!keys.length || value === '') {
                return;
            }
            let target = filters;
            keys.forEach((key, index) => {
                const index_ = key === '' ? Object.keys(target).length : key;
                if (index === keys.length - 1) {
                    target[index_] = value;
                } else {
                    target[index_] ??= keys[index + 1] === '' ? [] : {};
                    target = target[index_];
                }
            });
        });

        return filters;
    }

    _initPaging() {
        const options = { signal: this.listeners.signal };
        this.root.querySelectorAll('[data-table-length]').forEach((select) => {
            select.addEventListener('change', () => {
                this.pageLength = Number(select.value);
                this.root.querySelectorAll('[data-table-length]').forEach((other) => { other.value = select.value; });
                this._reload();
            }, options);
        });
        this.root.addEventListener('click', (event) => {
            const link = event.target.closest('[data-table-nav] [data-page]');
            if (!link) {
                return;
            }
            event.preventDefault();
            if (!link.parentElement.classList.contains('disabled')) {
                this.page = Number(link.dataset.page);
                this.load();
            }
        }, options);
    }

    _renderPaging(paging) {
        if (!this.options.paging) {
            return;
        }
        const { numActivePage: active, nbPages } = paging;
        const item = (page, label, state = '') => `<li class="page-item ${state}"><a class="page-link" href="#" data-page="${page}">${label}</a></li>`;

        const pages = [];
        for (let page = 1; page <= nbPages; page += 1) {
            if (page === 1 || page === nbPages || Math.abs(page - active) <= 2) {
                pages.push(item(page, page, page === active ? 'active' : ''));
            } else if (Math.abs(page - active) === 3) {
                pages.push(item(page, '…'));
            }
        }

        const html = `<ul class="pagination justify-content-end">${
            item(active - 1, `<span aria-label="${this.messages.previous}">←</span>`, paging.firstPage ? 'disabled' : '')
        }${pages.join('')}${
            item(active + 1, `<span aria-label="${this.messages.next}">→</span>`, paging.lastPage ? 'disabled' : '')
        }</ul>`;

        this.root.querySelectorAll('[data-table-nav]').forEach((nav) => { nav.innerHTML = html; });
    }
}
