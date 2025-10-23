import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    const tabElements = [
        {
            id: 'login',
            triggerEl: document.querySelector('#login-tab'),
            targetEl: document.querySelector('#login')
        },
        {
            id: 'register',
            triggerEl: document.querySelector('#register-tab'),
            targetEl: document.querySelector('#register')
        },
    ];

    // options with default values
    const options = {
        defaultTabId: 'login',
        activeClasses: 'text-blue-600 border-blue-600 dark:text-blue-500 dark:border-blue-500',
        inactiveClasses: 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300',
        onShow: () => {
            // console.log('tab is shown');
        }
    };

    class Tabs {
        constructor(tabElements, options) {
            this._tabElements = tabElements;
            this._options = options;
            this._init();
        }

        _init() {
            if (this._tabElements.length) {
                // get the default tab
                let defaultTab = this._tabElements.find(t => t.id === this._options.defaultTabId);
                if (!defaultTab) {
                    defaultTab = this._tabElements[0];
                }

                // show the default tab
                this.show(defaultTab.id);

                // set up the event listeners
                this._tabElements.forEach(tab => {
                    tab.triggerEl.addEventListener('click', () => {
                        this.show(tab.id);
                    });
                });
            }
        }

        show(tabId) {
            const tab = this._tabElements.find(t => t.id === tabId);

            // hide all other tabs
            this._tabElements.forEach(t => {
                if (t.id !== tabId) {
                    t.targetEl.classList.add('hidden');
                    t.triggerEl.classList.remove(...this._options.activeClasses.split(' '));
                    t.triggerEl.classList.add(...this._options.inactiveClasses.split(' '));
                    t.triggerEl.setAttribute('aria-selected', 'false');
                }
            });

            // show the target tab
            tab.targetEl.classList.remove('hidden');
            tab.triggerEl.classList.add(...this._options.activeClasses.split(' '));
            tab.triggerEl.classList.remove(...this._options.inactiveClasses.split(' '));
            tab.triggerEl.setAttribute('aria-selected', 'true');

            // call the onShow callback
            this._options.onShow(this, tab);
        }
    }

    new Tabs(tabElements, options);
});
