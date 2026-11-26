import { Controller } from '@hotwired/stimulus';
import Table from './table.js';

export default class extends Controller {
    connect() {
        this.table = new Table(this.element);
    }

    disconnect() {
        this.table.destroy();
    }
}
