<template>
    <div class="chat-popup">
        <h1>Чат</h1>
        <div class="chat-messages">
            <p v-for="message in messages">{{ message }}</p>
        </div>
        <input name="message" class="form-control" v-model="message" @keydown="whisperTyping" placeholder="Введите сообщение">
        <button class="btn btn-primary" @click.prevent="sendMessage">Отправить</button>
    </div>
</template>
<style>
    .chat-popup{
        display: block;
        position: fixed;
        bottom: 15px;
        right: 15px;
        width: 300px;
        height: 330px;
        padding: 10px;
        background-color: white;
        border: 3px solid #f1f1f1;
        z-index: 1000;
    }

    .chat-popup .chat-messages
    {
        height: 150px;
        margin-bottom: 10px;
        overflow-y: scroll;
    }

    .chat-popup input{
        margin-bottom: 10px;
    }
</style>
<script>
console.log('QQQ');
    export default{
        data() {
            return{
                messages: [],
                message: '',
                channel: null,
            }
        },

        mounted(){
                this.channel =  Echo.join('presence-chat');

                this.channel.listen('ChatMessage', (data) => {
                    this.addMessage(data.user.name + ': ' + data.message);
                })
                .here((users) => {
                    this.addMessage('В чате ' + users.length + ' участников')
                })
                .joining((user) => {
                    this.addMessage('пользователь '+ user.name + ' вошел в чат');
                })
                .leaving((user) => {
                    this.addMessage('пользователь '+ user.name + ' покинул чат');
                });

                this.channel.listenForWhisper('typing', (data) => {
                    this.addMessage(data.name + 'печатает сообщение ...');
                });
        },
        methods:
        {
            sendMessage(){
                let message = this.message; 
                this.message = '';
                this.addMessage('Я: ' + message);

                if(message.length > 0 ){
                    axios.post('/chat', {message: message}).then();
                }
            },
            addMessage(message) {
                this.messages.push(message);
            },
            whisperTyping(){
                this.channel.whisper('typing', {name: 'Другой участник'});
            }
        },
    }
</script>