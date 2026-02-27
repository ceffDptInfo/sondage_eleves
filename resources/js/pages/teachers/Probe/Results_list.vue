<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import ResultsListItem from '@/components/teachers/probe/results/results_list_item.vue';
</script>

<template>
    <Head title="Résultats" />
    <AppLayout>
        <div class="flex-col items-center mb-10 mt-24">
            <h2 class="text-2xl md:text-3xl font-bold">Enseignant - Sonder <br>Résultats</h2>
        </div>
        <div>
            <ResultsListItem />
            <ResultsListItem />
            <ResultsListItem />
        </div>
        <div class="space-x-3">
            <button class="border p-2" @click="">Archiver et enregistrer</button>
            <button class="border p-2">Afficher les messages privés</button>
        </div>
    </AppLayout>
</template>