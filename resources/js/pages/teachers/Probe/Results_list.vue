<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import ResultsListItem from '@/components/teachers/probe/results/results_list_item.vue';
import { onMounted, ref } from 'vue';
import axios from 'axios';

const props = defineProps({
    sessionId: Number
});

const remarks = ref([]);
const filteredRemarks = ref([]);
const privateMode = ref(false);
const survey = ref({});
const session = ref({});

onMounted(() => {
    axios.get('/teachers/probe/session/' + props.sessionId)
        .then(response => {
            console.log('Données de la session récupérées avec succès:', response.data);
            session.value = response.data;

            axios.get('/teachers/survey/' + session.value.survey_id)
                .then(response => {
                    console.log('Données du sondage récupérées avec succès:', response.data);
                    survey.value = response.data;
                })
                .catch(error => {
                    console.error('Erreur lors de la récupération du sondage:', error);
                });
        })
        .catch(error => {
            console.error('Erreur lors de la récupération de la session:', error);
        });



    axios.get('/teachers/probe/session/' + props.sessionId + '/results')
        .then(response => {
            console.log('Données des résultats récupérées avec succès:', response.data);
            remarks.value = response.data;
            filteredRemarks.value = response.data.filter(remark => remark.private == false);
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des résultats:', error);
        });
});

function filterRemarks() {
    if (privateMode.value) {
        privateMode.value = !privateMode.value;
        filteredRemarks.value = remarks.value.filter(remark => remark.private == false);
    } else {
        privateMode.value = !privateMode.value;
        filteredRemarks.value = remarks.value;
    }
}

function generatePdf() {
    // const likes = remarks.value.votes.filter(vote => vote.type === 'like').length;
    // const dislikes = remarks.value.votes.filter(vote => vote.type === 'dislike').length;
    // alert(likes + ' ' + dislikes);
    axios.post('/teachers/probe/session/' + props.sessionId + '/results/pdf', { session: session.value, survey: survey.value, remarks: remarks.value }, { responseType: 'blob' })
        .then(response => {
            const url = window.URL.createObjectURL(new Blob([response.data]));
            window.open(url);
        })
        .catch(error => {
            console.error('Erreur lors de la génération du PDF:', error);
        });
}
</script>

<template>

    <Head title="Résultats" />
    <AppLayout>
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-24 mb-10">
            <h2 class="text-2xl md:text-3xl font-bold">Enseignant - Sonder <br>Résultats</h2>
            <div class="mt-2 h-px flex-grow bg-gradient-to-r from-gray-500 to-transparent"></div>

            <div class="mt-8">
                <ResultsListItem v-for="remark in filteredRemarks" :key="remark.id" :remark="remark" />
            </div>
            <div class="space-x-3">
                <button class="border p-2" @click="generatePdf">Générer et archiver le PDF</button>
                <button v-if="remarks.some(r => r.private)" @click="filterRemarks()"
                    class="border p-2 bg-red-500 text-white">{{ privateMode ? 'Cacher' : 'Afficher' }} les remarques
                    privées</button>
            </div>
        </div>
    </AppLayout>
</template>