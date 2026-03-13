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
        <div class="mb-10">
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Espace Enseignant</h2>
            <div class="mt-3 h-1.5 w-20 bg-amber-500 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-16">
            <Link href="/teachers/create_survey" class="group">
                <div
                    class="bg-white border border-gray-100 hover:border-amber-500 rounded-2xl shadow-sm p-8 transition-all hover:shadow-md hover:-translate-y-1 flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Créer un sondage</h3>
                        <p class="text-gray-500 mt-1 text-sm">Lancez une nouvelle évaluation en direct.</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-xl">
                        <img src="/icons/survey.png" alt="Icon" class="w-10 h-10">
                    </div>
                </div>
            </Link>

            <Link href="/teachers/archives" class="group">
                <div
                    class="bg-white border border-gray-100 hover:border-amber-500 rounded-2xl shadow-sm p-8 transition-all hover:shadow-md hover:-translate-y-1 flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Consulter les archives</h3>
                        <p class="text-gray-500 mt-1 text-sm">Retrouvez les résultats de vos anciennes sessions.</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-xl">
                        <img src="/icons/archive.png" alt="Icon" class="w-10 h-10">
                    </div>
                </div>
            </Link>
        </div>

        <section>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                    Vos sondages
                    <span class="bg-gray-100 text-gray-600 text-xs px-2.5 py-1 rounded-full">{{ surveys.length }}</span>
                </h2>
            </div>

            <div v-if="surveys.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <SurveyListItem v-for="survey in surveys" :key="survey.id" :survey="survey" />
            </div>

            <div v-else class="bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl p-12 text-center">
                <p class="text-gray-500">Vous n'avez pas encore créé de sondages.</p>
                <Link href="/teachers/create_survey"
                    class="text-amber-500 font-semibold mt-2 inline-block hover:underline">Créer mon premier sondage →
                </Link>
            </div>
        </section>
    </AppLayout>
</template>