<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { ref } from 'vue';
import axios from 'axios';

let survey = ref({
    name: '',
    creation_date: '',
    description: '',
    question: '',
});

function submit() {
    axios.post('/teachers/survey', survey.value)
        .then(response => {
            console.log('Sondage créé avec succès:', response.data);
            window.location.href = '/teachers/home';
        })
        .catch(error => {
            console.error('Erreur lors de la création du sondage:', error);
        });
}
</script>

<template>
    <AppLayout>
        <div class="flex-col items-center mb-10 mt-24">
            <h2 class="text-2xl md:text-3xl font-bold">Création d'un sondage</h2>
        </div>

        <form class="max-w-lg mx-auto space-y-4" @submit.prevent="submit()" autocomplete="off">
            <div>
            <label for="name" class="block text-sm font-medium">Nom du sondage:</label>
            <input type="text" id="name" name="name" v-model="survey.name" class="w-full px-3 py-2 border border-gray-300 rounded">
            </div>

            <div>
            <label for="creation_date" class="block text-sm font-medium">Date de création:</label>
            <input type="date" id="creation_date" name="creation_date" v-model="survey.creation_date" class="w-full px-3 py-2 border border-gray-300 rounded">
            </div>

            <div>
            <label for="description" class="block text-sm font-medium">Description:</label>
            <textarea id="description" name="description" v-model="survey.description" class="w-full px-3 py-2 border border-gray-300 rounded"></textarea>
            </div>

            <div>
            <label for="question" class="block text-sm font-medium">Question:</label>
            <input type="text" id="question" name="question" v-model="survey.question" class="w-full px-3 py-2 border border-gray-300 rounded">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Créer le sondage</button>
        </form>
    </AppLayout>
</template>