<script>

export default {
    name: "Header",
    data() {
        return {

        }
    },

    methods: {
        async logout(){
            await axios
                .post('/api/logout')
                .then(() => {
                    sessionStorage.removeItem('token')
                    this.$router.push('/login_page')
                })
                .catch((errors) => {
                    console.log(errors)
                })
        }
    }
}
</script>

<template>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/chats">Чаты</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/profile">Профиль</router-link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" @click="logout">Выход</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true"></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<style scoped lang="scss">

</style>
