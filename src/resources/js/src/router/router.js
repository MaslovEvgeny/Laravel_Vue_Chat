import { createRouter, createWebHistory } from "vue-router"
import routes from "./routes.js";

const router = createRouter({
    history: createWebHistory(),
    linkActiveClass: 'active_link',
    routes
})

function loggedIn(){
    window.axios.defaults.headers.common['Authorization'] = `Bearer ${sessionStorage.getItem('token')}`
    return sessionStorage.getItem('token')
}

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!loggedIn()) {
            next({
                path: '/login_page',
                query: { redirect: to.fullPath }
            })
        } else {
            next()
        }
    } else if(to.matched.some(record => record.meta.guest)) {
        if (loggedIn()) {
            next({
                path: '/',
                query: { redirect: to.fullPath }
            })
        } else {
            next()
        }
    } else {
        next()
    }
})

axios.interceptors.response.use(function (response) {
    return response
}, function (error) {
    if(error.response.status === 403 || error.response.status === 401) {
        window.location.href = "/login_page"
    }
    return Promise.reject(error)
})

export default router
