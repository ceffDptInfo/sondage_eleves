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
            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">Espace enseignant - Archives
            </h2>
            <div class="mt-3 h-1.5 w-20 bg-amber-500 rounded-full"></div>
        </div>

        <div>
            <table>
                <tr>
                    <th>Nom du fichier</th>
                    <th>Date de l'ajout</th>
                    <th>Nom de l'enseignant</th>
                    <th>Email de l'enseignant</th>
                    <th>Nom du sondage</th>
                    <th>Description du sondage</th>
                    <th>Question du sondage</th>
                    <th>Classe</th>
                    <th>Remarque</th>
                </tr>
                <ArchiveListItem v-for="archive in archives" :archive="archive" />
            </table>
        </div>

    </AppLayout>
</template>