<template>
    <div class="chat">
        <TheContacts></TheContacts>
        <router-view>
        </router-view>
    </div>
</template>

<script>
import ChatWindow from "../components/ChatWindow.vue";
import TheContacts from "../components/TheContacts.vue";

export default {
    name: "Chat",
    components: {ChatWindow, TheContacts}
}
</script>

<style scoped lang="scss">
.chat {
    display: flex;
    background-color: transparent;
    position: fixed;
    width: 100%;
    height: 93vh;
}
</style>
