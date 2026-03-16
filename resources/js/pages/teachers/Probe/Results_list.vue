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
    // axios.get('/teachers/probe/session/' + props.sessionId + '/results/close', { responseType: 'blob' })
    //     .then(response => {
    //         const url = window.URL.createObjectURL(new Blob([response.data]));

    //         let pdf = window.open(url, '_blank');
    //     })
    //     .catch(error => {
    //         console.error('Erreur lors de la génération du PDF:', error);
    //     });
    axios.get('/teachers/probe/session/' + props.sessionId + '/results/close', { responseType: 'blob' })
        .then(response => {
            window.location.href = '/teachers/archives';
            const url = window.URL.createObjectURL(new Blob([response.data]));

            let pdf = window.open(url, '_blank');
        })
        .catch(error => {
            console.error('Erreur lors de la génération du PDF:', error.response.data);
        });
}
</script>

<template>
    <AppLayout>
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
                <div class="flex-grow">
                    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">Résultats du sondage</h2>
                    <div class="mt-3 h-1.5 w-20 bg-amber-500 rounded-full"></div>
                </div>
                
                <div class="flex gap-3">
                    <button v-if="remarks.some(r => r.private)" @click="filterRemarks()"
                        :class="[privateMode ? 'bg-gray-800' : 'bg-amber-500']"
                        class="flex items-center gap-2 text-white font-bold px-5 py-2.5 rounded-xl transition-all shadow-sm active:scale-95">
                        {{ privateMode ? 'Cacher' : 'Afficher' }} les privées
                    </button>
                    
                    <button @click="generatePdf"
                        class="flex items-center gap-2 bg-white border border-1 border-black text-black hover:bg-black/5 font-bold px-5 py-2.5 rounded-xl transition-all active:scale-95">
                        <img src="/icons/archive.png" class="w-5 h-5 opacity-70" alt="">
                        PDF & Archiver
                    </button>
                </div>
            </div>

            <div class="space-y-4">
                <ResultsListItem v-for="remark in filteredRemarks" :key="remark.id" :remark="remark" />
            </div>
    </AppLayout>
</template>