<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    archive: {
        type: Object,
        required: true
    }
});

function downloadPdf() {
    const url = `/storage/archives/${props.archive.file_name}`;
    const link = document.createElement('a');
    link.href = url;
    link.download = props.archive.file_name;
    link.click();
}
</script>

<template>
    <tr class="hover:bg-amber-50/50 transition-colors duration-200">
        <td class="px-6 py-4 font-medium text-gray-900 hidden md:table-cell">{{ archive.file_name || '-' }}</td>
        <td class="px-6 py-4 text-gray-600">{{ archive.adding_date || '-' }}</td>
        <td class="px-6 py-4 text-gray-600">{{ archive.survey_name || '-' }}</td>
        <td class="px-6 py-4 text-gray-600 hidden md:table-cell">{{ archive.survey_question || '-' }}</td>
        <td class="px-6 py-4 text-gray-600">{{ archive.session_class || '-' }}</td>

        <td class="px-6 py-4 text-right">
            <button @click="downloadPdf()"
                class="inline-flex items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold uppercase tracking-widest rounded-lg transition-all shadow-md hover:shadow-amber-200">
                Télécharger
            </button>
        </td>
    </tr>
</template>