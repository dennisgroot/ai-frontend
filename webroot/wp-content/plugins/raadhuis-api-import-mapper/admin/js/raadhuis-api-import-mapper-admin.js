(function ($) {
    'use strict';

})(jQuery);

document.addEventListener('alpine:init', () => {
    Alpine.data('apiMapper', () => ({
        isLoading: false,
        apiShowItem: '0', // "all" or "number"
        wpShowItem: '0', // "all" or "number"
        apiView: 'card',
        wpView: 'card',
        apiKey: '', // only if required
        apiUrl: localStorage.getItem('apiUrl') ? JSON.parse(localStorage.getItem('apiUrl')) : null,
        apiData: localStorage.getItem('apiData') ? JSON.parse(localStorage.getItem('apiData')) : null,
        wpUrl: localStorage.getItem('wpUrl') ? JSON.parse(localStorage.getItem('wpUrl')) : null,
        wpData: localStorage.getItem('wpData') ? JSON.parse(localStorage.getItem('wpData')) : null,
        importProfile: {},
        dragging: null,
        draggedKey: null,
        // dropKey: null,

        // Fetch API data
        fetchData() {
            this.isLoading = true;

            if (!this.apiUrl) {
                return alert('Voer een geldige API URL in!')
            };

            fetch(this.apiUrl)
                .then(res => res.json())
                .then(data => {
                    this.apiData = data;
                    localStorage.setItem('apiUrl', JSON.stringify(this.apiUrl));
                    localStorage.setItem('apiData', JSON.stringify(data));
                    this.isLoading = false;
                })
                .catch(err => {
                    console.error(err);
                    alert('Kon data niet ophalen. Controleer de API URL.');
                    this.isLoading = false;
                });
        },

        // Fetch WP data
        fetchWPData() {
            this.isLoading = true;

            if (!this.wpUrl) {
                return alert('Voer een geldige API URL in!')
            };

            fetch(this.wpUrl)
                .then(res => res.json())
                .then(data => {
                    this.wpData = data;
                    localStorage.setItem('wpUrl', JSON.stringify(this.wpUrl));
                    localStorage.setItem('wpData', JSON.stringify(data));
                    this.isLoading = false;
                })
                .catch(err => {
                    console.error(err);
                    alert('Kon data niet ophalen. Controleer de API URL.');
                    this.isLoading = false;
                });
        },

        // Return the type of a value
        getType(value) {
            return typeof value;
        },

        // Helper function to render fields
        renderFields(data, parentKey = '') {
            if (Array.isArray(data) || typeof data === 'object') {
                return Object.keys(data).map(key => {
                    const fullKey = parentKey ? `${parentKey}.${key}` : key;
                    return {
                        key: fullKey,
                        type: Array.isArray(data[key]) ? 'array' : typeof data[key],
                        value: data[key],
                    };
                });
            }
            return [];
        },
    }));
});
