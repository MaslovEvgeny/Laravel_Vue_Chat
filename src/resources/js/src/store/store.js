import { createStore } from "vuex"

const store = createStore({
    state() {
        return {
            messages: [],
            user: [],
            usersList: []
        }
    },
    mutations: {
        setUserData(state, user) {
            state.user = user
        },
        setUsersList(state, usersList) {
            state.usersList = usersList
        }
    },
    getters: {
        getAuthUser(state) {
            return state.user
        },
        getUsersList(state) {
            return state.usersList
        }
    },
    actions: {
        getUserData({commit, getters}) {
            axios
                .get('api/user')
                .then(res => {
                    commit('setUserData', res.data)
                    sessionStorage.setItem('authUserId', getters.getAuthUser.id)
                })
        }
    }
})

export default store
