<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { ref } from 'vue';
import axios from 'axios';

const survey = ref({
    name: '',
    creation_date: '',
    description: '',
    question: '',
});

const errorMsg = ref('');

function submit() {
    if (survey.value.creation_date == "") {
        survey.value.creation_date = new Date().toISOString().split('T')[0];
    }
    axios.post('/teachers/survey', survey.value)
        .then(response => {
            console.log('Sondage créé avec succès:', response.data);
            window.location.href = '/teachers/home';
        })
        .catch(error => {
            console.error('Erreur lors de la création du sondage:', error);
            errorMsg.value = error.response.data.message || 'Une erreur est survenue lors de la création du sondage.';
        });
}
</script>

<template>

    <Head title="Conception" />
    <AppLayout>
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-24 mb-10">
            <h2 class="text-2xl md:text-3xl font-bold">Conception d'un sondage</h2>
            <div class="mt-2 h-px flex-grow bg-gradient-to-r from-gray-500 to-transparent"></div>

            <form class="max-w-lg mx-auto space-y-4 mt-8" @submit.prevent="submit()" autocomplete="off">
                <div>
                    <label for="name" class="block text-sm font-medium">Nom du sondage:</label>
                    <input type="text" id="name" name="name" v-model="survey.name"
                        class="w-full px-3 py-2 border border-gray-300 rounded-xl">
                </div>

                <div>
                    <label for="creation_date" class="block text-sm font-medium">Date de création:</label>
                    <input type="date" id="creation_date" name="creation_date" v-model="survey.creation_date"
                        class="w-full px-3 py-2 border border-gray-300 rounded">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium">Description:</label>
                    <textarea id="description" name="description" v-model="survey.description"
                        class="w-full px-3 py-2 border border-gray-300 rounded-xl"></textarea>
                </div>

                <div>
                    <label for="question" class="block text-sm font-medium">Question:</label>
                    <input type="text" id="question" name="question" v-model="survey.question"
                        class="w-full px-3 py-2 border border-gray-300 rounded-xl">
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-xl hover:bg-blue-700">Créer le
                    sondage</button>
            </form>
            <div class="text-red-500 text-center mt-8">{{ errorMsg }}</div>
        </div>
    </AppLayout>
</template>