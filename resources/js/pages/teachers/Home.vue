<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import axios from 'axios';

import SurveyListItem from '@/components/teachers/home/survey_list_item.vue';

const surveys = ref([]);

onMounted(() => {
    axios.get('/teachers/surveys')
        .then(data => {
            surveys.value = data.data;
            console.log('Sondages récupérés:', surveys.value);
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des sondages:', error);
        });
});
</script>

<template>
    <Head title="Tableau de bord" />
    <AppLayout>
        <div class="flex-col items-center mb-10 mt-24">
            <h2 class="text-2xl md:text-3xl font-bold">Page d'accueil enseignant</h2>

            <div class="grid grid-cols-2 gap-8 mt-20">
                <Link href="/teachers/create_survey">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-xl font-semibold mb-4">Créer un sondage</h3>
                        <img src="/icons/survey.png" alt="Créer un sondage" class="w-20 h-20">
                    </div>
                </Link>
                <Link href="/teachers/archives">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-xl font-semibold mb-4">Consulter les archives</h3>
                        <img src="/icons/archive.png" alt="Consulter les archives" class="w-20 h-20">
                    </div>
                </Link>
            </div>

            <div class="mt-20">
                <h2 class="text-xl font-semibold">Vos sondages :</h2>
                <div v-if="surveys.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                    <SurveyListItem v-for="survey in surveys.slice(0,6)" :key="survey.id" :survey="survey" />
                </div>
                <p v-else class="mt-4 text-gray-500">Vous n'avez pas encore créé de sondages.</p>
            </div>
        </div>
    </AppLayout>
</template>