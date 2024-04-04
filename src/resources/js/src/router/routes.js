import Chat from "../pages/Chat.vue"
import Profile from "../pages/Profile.vue"
import Login from "../pages/Login.vue";
import ChatWindow from "../components/ChatWindow.vue";

const routes = [
    {
        path: '/login_page',
        component: Login,
        meta: {guest: true}
    },
    {
        path: '/chats',
        component: Chat,
        meta: {requiresAuth: true},
        children: [
            {
                path: ':chatId',
                component: ChatWindow,
                props: true
            }
        ]
    },
    {
        path: '/profile',
        component: Profile,
        meta: {requiresAuth: true},
        alias: '/'
    }
]

export default routes
