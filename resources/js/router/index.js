import Vue from 'vue'
import VueRouter from 'vue-router'
import Main from '../pages/Main.vue'
Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        component: Main,
        children: [
            {
                path: '/profile',
                name: 'profile',
                component: () => import('../pages/Profile.vue'),
                meta: {
                    auth: true
                }
            },
            {
                path: '/myreviews',
                name: 'myreviews',
                component: () => import('../pages/Myreviews.vue'),
                meta: {
                    auth: true
                }
            }
        ]
    }
]

const router = new VueRouter({
	mode: 'history',
	base: process.env.BASE_URL,
	routes
})

/* router.beforeEach((to, from, next) => {
    if(!to.meta.title) return next();
    document.title = to.meta.title;
    next();
}) */
export default router
