import {createRouter, createWebHistory} from 'vue-router'

import IndexView from '@/views/IndexView.vue'
import CategoriesView from '@/views/CategoriesView.vue'
import CategoryDetailsView from '@/views/CategoryDetailsView.vue'
import AboutView from '@/views/AboutView.vue'

const routes = [
    {
        name: 'index',
        component: IndexView,
        path: '/'
    },
    {
        name: 'categories',
        component: CategoriesView,
        path: '/categories'
    },
    {
        name: 'categoryDetails',
        component: CategoryDetailsView,
        path: '/category/:slug'
    },
    {
        name: 'about',
        component: AboutView,
        path: '/about'
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes: routes
})

export default router