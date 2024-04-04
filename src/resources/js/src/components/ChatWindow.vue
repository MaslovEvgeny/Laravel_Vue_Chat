<template>
    <div class="window-messages">
        <div class="text-messages">
            <div v-for="mess in messages" >
                <div class="from" v-if="mess.user_id_from === authUserId">
                    <p class="mess" :data-mess_id="mess.id" :data-mess_time="mess.created_at" @click="correctMessage">{{ mess.message }}</p>
                    <p class="time">{{ mess.created_at }}</p>
                </div>
                <div class="to" v-else-if="mess.user_id_from === parseInt(chatId)">
                    <p class="mess">{{ mess.message }}</p>
                    <p class="time">{{ mess.created_at }}</p>
                </div>
            </div>

        </div>
        <div class="text-window">
            <div class="input-group">
                <textarea class="form-control" placeholder="Введите сообщение" v-model="text"></textarea>
                <button type="button" class="btn btn-primary" @click="createMessage" v-if="corrMess === false">Отправить</button>
                <button type="button" class="btn btn-danger" @click="closeEdit" v-if="corrMess">Отмена</button>
                <button type="button" class="btn btn-success" @click="editMessage" v-if="corrMess">Изменить</button>
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment"
import axios from "axios";
import {mapGetters} from "vuex";
export default {
    name: "ChatWindow",
    data() {
        return {
            messages: [],
            text: '',
            messInterval: '',
            authUserId: parseInt( sessionStorage.getItem('authUserId')),
            corrMess: false,
            corrMessId: '',
            corrMessText: ''
        }
    },
    props: ['chatId'],
    computed: {
        ...mapGetters(['getAuthUser'])
    },
    mounted() {
        this.getMessages()
        this.messInterval = setInterval(() => {
            this.getMessages()
        }, 5000)


    },
    beforeUnmount() {
      clearInterval(this.messInterval)
    },

    methods: {
        getMessages() {
            axios
                .get('/api/messages', {params: {from: this.authUserId, to: this.chatId}})
                .then(res => {
                    if (this.messages.length === 0) {
                        this.messages = res.data.map((mess) => {
                            mess.created_at = moment(String(mess.created_at)).format('DD-MM-YYYY hh:mm')
                            return mess
                        })
                    } else {
                        const newMessages = res.data
                            .map((mess) => {
                            mess.created_at = moment(String(mess.created_at)).format('DD-MM-YYYY hh:mm')
                            return mess
                            })
                            .filter(mess => this.messages.every(item => item.id !== mess.id))
                        this.messages = [...this.messages, ...newMessages]
                    }
                })
        },

        createMessage() {
            axios
                .post('/api/messages', {message: this.text, user_id_from: this.authUserId, user_id_to: this.chatId})
                .then(res => {
                    this.text = ''
                    this.getMessages()
                })
                .then(() => {
                    const usersList = this.$store.getters.getUsersList
                    const activeUserId = usersList.findIndex((user) => user.id == this.chatId )

                    axios.get('/api/send_mail', {params: { name: this.getAuthUser.name, email: usersList[activeUserId].email}})
                })
        },

        correctMessage(event) {
            const now = moment().format('DD-MM-YYYY hh:mm')
            const diffMins = moment(String(now)).diff(moment(event.target.dataset.mess_time), 'minutes')
            if (diffMins < 5) {
                this.text = event.target.innerText
                this.corrMess = true
                this.corrMessId = event.target.dataset.mess_id
            }
        },

        editMessage() {
            axios
                .put('/api/messages/' + this.corrMessId, {text: this.text})
                .then(() => {
                    const idx = this.messages.findIndex((mess) => mess.id == this.corrMessId )
                    this.messages[idx].message = this.text
                    this.closeEdit()
                })
        },

        closeEdit() {
            this.corrMess = false
            this.text = ''
        }
    },
    watch: {
        '$route.path'() {
            this.messages = []
            this.getMessages()
        }
    }
}
</script>

<style scoped lang="scss">
.window-messages {
    background-color: transparent;
    width: 70%;
    display: flex;
    flex-direction: column;
}
.text-window {
    background-color: #717171;
    width: 100%;
    height: 10%;
}
.text-messages {
    background-color: #717171;
    width: 100%;
    height: 90%;
    display: flex;
    flex-direction: column;
    gap: 10px;
    overflow: auto;
}
.to {
    text-align: left;
    background-color: #333333;
    margin: 5px;
    border-radius: 5px;
    margin-right: 55%;
    word-break: break-word;
}
.from {
    text-align: left;
    background-color: #006b50c9;
    margin: 5px;
    border-radius: 5px;
    margin-left: 55%;
    word-break: break-word;
}

.time {
    font-size: 12px;
    font-weight: 700;
    text-align: right;
    margin-bottom: 0;
}
.mess {
    margin-bottom: 0;
    padding: 0 5px;
}
</style>
