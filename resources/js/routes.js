import AllItems from './components/AllItems.vue';
import AddPhotoItem from './components/AddPhotoItem.vue';
import EditPhotoItem from './components/EditPhotoItem.vue';
import AddNewsItem from './components/AddNewsItem.vue';
import EditNewsItem from './components/EditNewsItem.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: AllItems
    },
    {
        name: 'add-photo-item',
        path: '/add-photo-item',
        component: AddPhotoItem
    },
    {
        name: 'edit-photo-item',
        path: '/edit-photo-item/:id',
        component: EditPhotoItem
    },
    {
        name: 'add-news-item',
        path: '/add-news-item',
        component: AddNewsItem
    },
    {
        name: 'edit-news-item',
        path: '/edit-news-item/:id',
        component: EditNewsItem
    },
    {
        name: 'login',
        path: '/login',
        component: Login,
        meta: {
            auth: false
        }
    },
    {
        name: 'register',
        path: '/register',
        component: Register,
        meta: {
            auth: false
        }
    }
];