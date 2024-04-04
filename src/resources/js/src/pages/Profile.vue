<template>
    <div class="profile">
        <p>Имя: <b>{{ getAuthUser.name }}</b></p>
        <p>Логин: <b>{{ getAuthUser.login }}</b></p>
    </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "Profile",

    data() {
        return {

        }
    },
    methods: {

    },
    computed: {
        ...mapGetters(['getAuthUser'])
    },
    mounted() {
        this.$store.dispatch('getUserData')
    }
}
</script>

<style scoped lang="scss">
    .profile {
        margin: 20px;
    }
</style>
