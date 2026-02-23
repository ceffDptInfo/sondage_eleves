<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { onMounted, ref } from 'vue';
import axios from 'axios';

const id = window.location.pathname.split('/')[4];
const session = ref(null);
const survey = ref(null);

onMounted(() => {
    axios.get(`/teachers/probe/session/${id}`)
        .then(response => {
            console.log('Données du sondage récupérées avec succès:', response.data);
            session.value = response.data;
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des données du sondage:', error);
        });

    axios.get(`/teachers/survey/${id}`)
        .then(response => {
            console.log('Données du sondage récupérées avec succès:', response.data);
            survey.value = response.data;
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des données du sondage:', error);
        });
});

function end() {
    window.location.href = '/teachers/probe/results';
}
</script>

<template>
    <AppLayout>
        <div class="flex-col items-center mb-10 mt-24">
            <h2 class="text-2xl md:text-3xl font-bold">Enseignant - Sonder <br>Affichage</h2>
        </div>
        <div>

            <div class="flex">
                <span>Le nom du sondage : </span>
                <h3>{{ survey?.name }}</h3>
            </div>

            <div class="flex">
                <span>La question du sondage : </span>
                <h3>{{ survey?.question }}</h3>
            </div>

            <div class="flex">
                <span>Le code du sondage : </span>
                <h3>{{ session?.code }}</h3>
            </div>

            <div class="flex">
                <span>Le mot de passe du sondage : </span>
                <h3>{{ session?.password }}</h3>
            </div>

            <button @click="end()"
                class="bg-red-500 hover:bg-red-700 text-white font-bold px-4 py-2 rounded mt-4">Terminer</button>
        </div>
    </AppLayout>
</template>