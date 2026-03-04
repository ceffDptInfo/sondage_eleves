<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import MessageListItem from '@/components/students/Survey/message_list_item.vue';
import { onMounted, ref } from 'vue';
import axios from 'axios';

const remark = ref({
    value: '',
    status: 'positive',
    private: false
});

const remarks = ref([]);
const votes = ref([]);
let ipAddress = '';

onMounted(() => {
    axios.get('/ip')
        .then(response => {
            ipAddress = response.data;
            console.log('Adresse IP récupérée :', ipAddress);
        })
        .catch(error => {
            console.error('Erreur lors de la récupération de l\'adresse IP :', error);
        });
    setInterval(() => {
        axios.get(`/students/survey/${props.code}/remarks`)
            .then(response => {
                remarks.value = (response.data.remarks).filter(remark => !remark.private || remark.ip_address == ipAddress);
            })
            .catch(error => {
                console.error('Erreur lors de la récupération des messages :', error);
            });
        axios.get(`/students/survey/${props.code}/votes`)
            .then(response => {
                votes.value = response.data.votes;
            })
            .catch(error => {
                console.error('Erreur lors de la récupération des votes :', error);
            });
    }, 1000);
});

const props = defineProps({
    code: String
});

function submitForm() {
    axios.post(`/students/survey/${props.code}/remark`, remark.value)
        .then(response => {
            console.log('Remarque ajoutée :', response.data);
            remarks.value.unshift(response.data.remark); // mettre au début
            remark.value = { // nécessaire pour réinitialiser le formulaire - ne pas avoir de rechargement sur le input
                value: '',
                status: 'positive',
                private: false
            };
        })
        .catch(error => {
            console.error('Erreur lors de l\'ajout de la remarque :', error);
        });
}
</script>

<template>

    <Head title="Sondage" />
    <AppLayout>
        <div class="flex-col items-center mb-10 mt-24">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold">Sondage - {{ props.code }}</h2>
                <div class="mt-2 h-px flex-grow bg-gradient-to-r from-gray-500 to-transparent">
                </div>
            </div>

            <MessageListItem class="mt-4" v-for="remark in remarks" :remark="remark" :ip="ipAddress" :vote="votes.filter(vote => vote.remark_id === remark.id && vote.ip_address === ipAddress)[0]"/>

            <div class="fixed bottom-0 left-0 right-0 h-16 px-4 flex items-center bg-white">
                <form @submit.prevent="submitForm" class="w-full max-w-7xl mx-auto border-t pt-4 mb-8 border-gray-200">
                    <div class="flex w-full items-center space-x-2">
                        <input type="text" v-model="remark.value" required
                            class="min-w-0 flex-1 h-10 px-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Votre remarque...">

                        <label class="relative inline-block cursor-pointer">
                            <input type="radio" id="positiveStatus" v-model="remark.status" value="positive"
                                class="peer sr-only" required="true">
                            <div class="h-10 rounded-lg px-2 bg-green-300 text-white hover:bg-green-400 transition flex items-center justify-center 
                                        peer-checked:bg-green-600 peer-checked:text-white">
                                <img src="/icons/checkmark.png"
                                    class="h-5 w-5 brightness-0 invert peer-checked:brightness-100 peer-checked:invert-0"
                                    alt="Positive">
                                <span class="ml-1.5">Positive</span>
                            </div>
                        </label>

                        <label class="relative inline-block cursor-pointer">
                            <input type="radio" id="negativeStatus" v-model="remark.status" value="negative"
                                class="peer sr-only" required="true">
                            <div class="h-10 rounded-lg px-2 bg-red-300 text-white hover:bg-red-400 transition flex items-center justify-center 
                                        peer-checked:bg-red-600 peer-checked:text-white">
                                <img src="/icons/close.png"
                                    class="h-5 w-5 brightness-0 invert peer-checked:brightness-100 peer-checked:invert-0"
                                    alt="Negative">
                                <span class="ml-1.5">Négative</span>
                            </div>
                        </label>
                        <label class="relative inline-block cursor-pointer">
                            <input name="private" type="checkbox" class="peer sr-only" v-model="remark.private"
                                value="true">

                            <div
                                class="h-10 rounded-lg px-2 bg-gray-300 text-black hover:bg-gray-400 transition flex items-center justify-center peer-checked:bg-gray-500 peer-checked:text-white">
                                <img src="/icons/lock.png" class="h-5 w-5" alt="Private status">
                                <span class="ml-1.5">Privé</span>
                            </div>
                        </label>
                        <button type="submit" class="ms-8 rounded-full hover:bg-gray-200 h-10 w-10 transition">
                            <img src="/icons/message.png" class="p-2" alt="Message">
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>