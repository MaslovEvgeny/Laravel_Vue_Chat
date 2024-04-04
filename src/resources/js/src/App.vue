<template>
    <Header />
    <main class="main">
        <router-view />
    </main>
</template>

<script>
import Header from "./components/TheHeader.vue";
export default {
    name: "App",
    components: {
        Header
    },
    data() {
        return {
            isAuth: ''
        }
    },
    mounted() {

    },
    computed: {

    }
}
</script>

<style lang="scss" scoped>

</style>
