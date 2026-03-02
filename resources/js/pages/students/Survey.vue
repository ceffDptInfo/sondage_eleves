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

onMounted(() => {
    setInterval(() => {
        axios.get(`/students/survey/${props.code}/remarks`)
            .then(response => {
                remarks.value = response.data.messages;
            })
            .catch(error => {
                console.error('Erreur lors de la récupération des messages :', error);
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
            remarks.value.unshift(response.data.remark);
            remark.value = {
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
            <h2 class="text-2xl md:text-3xl font-bold">Sondage</h2>

            <MessageListItem v-for="remark in remarks" :key="remark.id" :remark="remark" />

            <div class="fixed bottom-0 border-t border-gray-200 h-16 px-4 flex items-center gap-3">
                <form @submit.prevent="submitForm">
                    <input type="text" v-model="remark.value" required="true"
                        class="flex-1 h-10 px-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Votre remarque...">

                    <div class="flex gap-2">
                        <div class="flex gap-4">
                            <label class="relative inline-block cursor-pointer">
                                <input type="radio" v-model="remark.status" value="positive" class="peer sr-only" required="true">
                                <div class="h-10 w-10 rounded-full bg-green-300 text-gray-500 hover:bg-green-400 transition flex items-center justify-center 
                                        peer-checked:bg-green-600 peer-checked:text-white">
                                    <img src="/icons/checkmark.png"
                                        class="h-5 w-5 brightness-0 invert peer-checked:brightness-100 peer-checked:invert-0"
                                        alt="Positive">
                                </div>
                            </label>

                            <label class="relative inline-block cursor-pointer">
                                <input type="radio" v-model="remark.status" value="negative" class="peer sr-only" required="true">
                                <div class="h-10 w-10 rounded-full bg-red-300 text-gray-500 hover:bg-red-400 transition flex items-center justify-center 
                                        peer-checked:bg-red-600 peer-checked:text-white">
                                    <img src="/icons/close.png"
                                        class="h-5 w-5 brightness-0 invert peer-checked:brightness-100 peer-checked:invert-0"
                                        alt="Negative">
                                </div>
                            </label>
                        </div>
                        <label class="relative inline-block cursor-pointer">
                            <input name="private" type="checkbox" class="peer sr-only" v-model="remark.private"
                                value="true">

                            <div
                                class="h-10 w-10 rounded-full bg-gray-300 hover:bg-gray-400 transition flex items-center justify-center peer-checked:bg-gray-600">
                                <img src="/icons/lock.png" class="h-5 w-5" alt="Private status">
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