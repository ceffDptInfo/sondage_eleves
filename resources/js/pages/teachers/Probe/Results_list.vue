<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import ResultsListItem from '@/components/teachers/probe/results/results_list_item.vue';
import { computed, onMounted, ref } from 'vue';
import axios from 'axios';

const props = defineProps({
    sessionId: Number
});

const remarks = ref([]);
const filteredRemarks = ref([]);
const privateMode = ref(false);

onMounted(() => {
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
</script>

<template>

    <Head title="Résultats" />
    <AppLayout>
        <div class="flex-col items-center mb-10 mt-24">
            <h2 class="text-2xl md:text-3xl font-bold">Enseignant - Sonder <br>Résultats</h2>
        </div>
        <div>
            <ResultsListItem v-for="remark in filteredRemarks" :key="remark.id" :remark="remark" />
        </div>
        <div class="space-x-3">
            <button class="border p-2" @click="">Archiver et enregistrer</button>
            <button @click="filterRemarks()" class="border p-2 bg-red-500 text-white">{{ privateMode ? 'Cacher' : 'Afficher' }} les remarques privées</button>
        </div>
    </AppLayout>
</template>