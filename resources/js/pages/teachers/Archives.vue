<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import ArchiveListItem from '@/components/teachers/archives/archive_list_item.vue';
import { onMounted, ref } from 'vue';
import axios from 'axios';

const archives = ref([]);
onMounted(() => {
    axios.get('/teachers/archives/list')
        .then(response => {
            archives.value = response.data;
        })
        .catch(error => {
            console.error('Error fetching archives:', error);
        });
});
</script>

<template>

    <Head title="Archives" />
    <AppLayout>
        <div class="mb-10">
            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
                Espace enseignant - Archives
            </h2>
            <div class="mt-3 h-1.5 w-20 bg-amber-500 rounded-full"></div>
        </div>

        <div class="overflow-x-auto rounded-xl" v-if="archives.length > 0">
            <table class="w-full text-left border-collapse bg-white text-sm">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="px-6 py-4 font-semibold text-gray-900 whitespace-nowrap hidden md:table-cell">Nom du
                            fichier</th>
                        <th class="px-6 py-4 font-semibold text-gray-900 whitespace-nowrap">Date de l'ajout</th>
                        <th class="px-6 py-4 font-semibold text-gray-900 whitespace-nowrap">Enseignant</th>
                        <th class="px-6 py-4 font-semibold text-gray-900 whitespace-nowrap">Sondage</th>
                        <th class="px-6 py-4 font-semibold text-gray-900 whitespace-nowrap hidden md:table-cell">
                            Question</th>
                        <th class="px-6 py-4 font-semibold text-gray-900 whitespace-nowrap">Classe
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <ArchiveListItem v-for="archive in archives" :key="archive.id" :archive="archive" />
                </tbody>
            </table>
        </div>
        <div v-else class="text-center py-12">
            <p class="text-gray-500 text-lg">Aucune archive disponible pour le moment.</p>
        </div>
    </AppLayout>
</template>