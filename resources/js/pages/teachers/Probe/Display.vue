<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { onMounted, ref } from 'vue';
import axios from 'axios';

const props = defineProps({
    sessionId: Number
});

const session = ref(null);
const survey = ref(null);

onMounted(() => {
    axios.get(`/teachers/probe/session/${props.sessionId}`)
        .then(response => {
            console.log('Données de la session récupérées avec succès:', response.data);
            session.value = response.data;
            return axios.get(`/teachers/survey/${session.value.survey_id}`);
        })
        .then(response => {
            console.log('Données du sondage récupérées avec succès:', response.data);
            survey.value = response.data;
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des données:', error);
        });
});

function end() {
    axios.post(`/teachers/probe/session/${props.sessionId}/complete`)
        .then(response => {
            console.log('Sondage terminé avec succès. Statut : ', response.data.session.status);
            window.location.href = '/teachers/probe/results/' + props.sessionId;
        })
        .catch(error => {
            console.error('Erreur lors de la terminaison du sondage:', error);
        });
}
</script>

<template>

    <Head title="Affichage" />
    <AppLayout>
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-24 mb-10">
            <h2 class="text-2xl md:text-3xl font-bold">Enseignant - Sonder <br>Affichage</h2>
            <div class="mt-2 h-px flex-grow bg-gradient-to-r from-gray-500 to-transparent"></div>
            
            <div class="space-y-6 mt-8">
                <div class="border-b pb-4">
                    <p class="text-sm text-gray-600">Nom du sondage</p>
                    <p class="text-lg font-semibold text-gray-900">{{ survey?.name }}</p>
                </div>

                <div class="border-b pb-4">
                    <p class="text-sm text-gray-600">Question</p>
                    <p class="text-lg font-semibold text-gray-900">{{ survey?.question }}</p>
                </div>

                <div class="border-b pb-4">
                    <p class="text-sm text-gray-600">Code d'accès</p>
                    <p class="text-lg font-mono font-bold text-blue-600">{{ session?.code }}</p>
                </div>

                <div class="pb-4">
                    <p class="text-sm text-gray-600">Mot de passe</p>
                    <p class="text-lg font-mono font-bold text-blue-600">{{ session?.password }}</p>
                </div>
            </div>

            <button @click="end()"
                class="bg-red-500 hover:bg-red-700 text-white font-bold px-4 py-2 rounded mt-4">Terminer</button>
        </div>

    </AppLayout>
</template>