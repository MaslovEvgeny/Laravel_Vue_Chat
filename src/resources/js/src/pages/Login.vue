<template>
    <form @submit.prevent="login" method="post">
        <div class="login-form">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Логин (Email)</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="email">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="exampleInputPassword1" v-model="password">
            </div>
            <button type="submit" class="btn btn-primary">Войти</button>
        </div>
    </form>

</template>

<script>
export default {
    name: "Login",
    data() {
        return {
            email: '',
            password: ''
        }
    },
    methods: {
        async login(){
            await axios
                .post('api/login', {email: this.email, password: this.password})
                .then(res => {
                    sessionStorage.setItem('token', res.data.token)
                    this.$router.push('/')
                })
                .catch((errors) => {
                   alert( errors.response.data.message)
                })


        }
    }

}
</script>

<style scoped lang="scss">
.login-form {
    width: 500px;
    margin: 50px auto;
}
</style>
