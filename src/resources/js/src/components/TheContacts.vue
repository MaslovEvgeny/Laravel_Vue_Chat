<template>
    <div class="contacts">
        <router-link v-for="user in usersList" :to="'/chats/' + user.id">
            <button :key="user.id" class="person" :class="activeChat == user.id ? 'active_chat' : ''">{{ user.name }}</button>
        </router-link>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "TheContacts",
    data() {
        return {
            authUserId: sessionStorage.getItem('authUserId'),
            activeChat: ''
        }
    },
    methods: {
        getUsersList() {
            axios
                .get('/api/get_users', {params: {authUserId: this.authUserId}})
                .then(res => {
                    this.$store.commit('setUsersList', res.data)
                })
        }
    },
    computed: {
        usersList() {
            return this.$store.getters.getUsersList
        }
    },
    mounted() {
       setTimeout( this.getUsersList() , 1)
    },
    watch: {
        '$route.path'() {
           this.activeChat = this.$route.params.chatId
        }
    }
}
</script>

<style scoped lang="scss">
.contacts {
    background-color: #212529ba;
    width: 30%;
    display: flex;
    flex-direction: column;
    border-right: 1px solid black;
}
.person {
    padding: 10px;
    width: 100%;
    text-align: left;
    background-color: transparent;
    border-right: 0;
    border-top: 0;
    border-left: 0;
    &:hover {
        background-color: #717171;
    }
}
.active_chat {
    background-color: #717171;
}
</style>
