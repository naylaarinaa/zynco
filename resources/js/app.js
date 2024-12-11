import Alpine from 'alpinejs';
import axios from 'axios'; // Mengimpor axios

// Konfigurasi axios
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Konfigurasi Alpine.js
window.Alpine = Alpine;
Alpine.start();
