import './bootstrap';

import Alpine from 'alpinejs';
import { createApp } from 'vue';

window.Alpine = Alpine;
Alpine.start();

const app = createApp({});
app.mount('#vue-app');
