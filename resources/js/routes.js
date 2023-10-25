import { createRouter, createWebHistory } from 'vue-router';
import MainPage from './components/MainPage.vue';
import AdminComponent from './components/AdminComponent.vue';
import AuthorizationForm from './components/AuthorizationForm.vue';
import BookAddPage from './components/BookAddPage.vue';
import BookEditPage from './components/BookEditPage.vue';

export default createRouter({
    routes: [{
            path: '/Book_inventory/public/',
            component: MainPage
        },
        {
            path: '/Book_inventory/public/adminPanel',
            component: AdminComponent,
        },
        {
            path: '/Book_inventory/public/adminPanel/LogIn',
            component: AuthorizationForm,
        },
        {
            path: '/Book_inventory/public/adminPanel/add',
            name: 'addBook',
            component: BookAddPage,
        },
        {
            path: '/Book_inventory/public/adminPanel/:isbn/edit',
            name: 'editBook',
            component: BookEditPage,
        }
    ],

    history: createWebHistory(),
    
});