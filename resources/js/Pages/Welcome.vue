<script setup>
import {reactive, onBeforeUnmount, ref} from 'vue'
import {Head, router} from '@inertiajs/vue3';
import emitter from 'tiny-emitter/instance'
import axios from 'axios';

const form = reactive({
    chat_message: null,
    // _token: this.$page.props.csrf_token,
})

const messages = ref([]);

async function submit() {
    await axios.get('/chat', {params: form});
    form.chat_message = null;
    return false;
}

function handleChatMessage(data) {
    messages.value.push(data)

}

emitter.on('chat-message', handleChatMessage);

onBeforeUnmount(() => {
    emitter.off('chat-message', handleChatMessage);
});

</script>

<template>
    <Head title="Welcome"/>

    <div class="flex flex-col justify-center items-center h-[100vh]">

        <ul>
            <li v-for="message in messages">
                {{ message }}
            </li>
        </ul>
        <form @submit.prevent="submit">
            <div>
                <input id="chat_message" v-model="form.chat_message" type="text">
                <button>Send</button>
            </div>
        </form>
    </div>

</template>
