<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import MessageListItem from '@/components/students/Survey/message_list_item.vue';
import { onMounted, ref } from 'vue';
import axios from 'axios';

const props = defineProps({
    code: String
});

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

        axios.get(`/students/session/${props.code}`)
            .then(response => {
                if (response.data.session.status === 'completed') {
                    window.location.href = '/students/home';
                }
            })
            .catch(error => {
                console.error('Erreur lors de la récupération du statut de la session :', error);
            });
    }, 1000);
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
            console.error('Erreur lors de l\'ajout de la remarque :', error.response.data.message);
            alert(error.response.data.message || 'Une erreur est survenue lors de l\'ajout de la remarque.');
        });
}
</script>

<template>
    <Head title="Sondage" />
    <AppLayout class="h-screen overflow-hidden flex flex-col">
        <div class="p-6 bg-white flex flex-col">
            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
                Espace élèves - Sondage {{ props.code }}
            </h2>
            <div class="mt-3 h-1.5 w-20 bg-amber-500 rounded-full"></div>
        </div>
        <div class="flex-1 overflow-y-auto px-6 pb-52 mb-4">
            <MessageListItem v-for="remark in remarks" :remark="remark" :ip="ipAddress" :code="props.code"
                :vote="votes.filter(vote => vote.remark_id === remark.id && vote.ip_address === ipAddress)[0]" />
        </div>

        <div class="flex fixed bottom-0 left-0 right-0 h-16 items-center bg-white">
            <form @submit.prevent="submitForm"
                class="w-full max-w-7xl mx-auto border-t pt-4 mb-8 px-6 border-gray-200 bg-white">
                <div class="flex flex-wrap items-center gap-3 mb-8">

                    <div class="flex-grow min-w-[280px]">
                        <input type="text" v-model="remark.value" required
                            class="w-full h-10 px-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-500"
                            placeholder="Votre remarque...">
                    </div>

                    <div class="flex items-center gap-2 sm:ml-auto">
                        <label class="relative inline-block cursor-pointer">
                            <input type="radio" id="positiveStatus" v-model="remark.status" value="positive"
                                class="peer sr-only" required="true">
                            <div
                                class="h-10 rounded-lg px-2 bg-green-300 text-white hover:bg-green-400 transition flex items-center justify-center peer-checked:bg-green-600">
                                <img src="/icons/checkmark.png" class="h-5 w-5 brightness-0 invert" alt="Positive">
                                <span class="ml-1.5">Positive</span>
                            </div>
                        </label>

                        <label class="relative inline-block cursor-pointer">
                            <input type="radio" id="negativeStatus" v-model="remark.status" value="negative"
                                class="peer sr-only" required="true">
                            <div
                                class="h-10 rounded-lg px-2 bg-red-300 text-white hover:bg-red-400 transition flex items-center justify-center peer-checked:bg-red-600">
                                <img src="/icons/close.png" class="h-5 w-5 brightness-0 invert" alt="Negative">
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

                        <button type="submit" class="rounded-full hover:bg-gray-200 h-10 w-10 transition shrink-0">
                            <img src="/icons/message.png" class="p-2" alt="Send">
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </AppLayout>
</template>