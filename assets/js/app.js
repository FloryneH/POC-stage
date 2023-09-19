import '../css/app.scss';
import { Dropdown } from 'bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    new App();
});

class App {
    constructor() {
        this.enableDropdowns();
        this.handleCommentForm();
    }

    enableDropdowns() {
        const dropDownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
        dropDownElementList.map(function (dropdownToggleEl) {
            return new Dropdown(dropdownToggleEl)
        });
    }
}
