import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';

import router from './routes.js';

const app = createApp({
    // Конфигурация вашего приложения Vue
});

app.component('example-component', ExampleComponent);

app.use(router);
app.mount('#app');