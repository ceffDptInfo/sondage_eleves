<script setup>
import { Download } from 'lucide-vue-next';
import { defineProps } from 'vue';

const props = defineProps({
    archive: {
        type: Object,
        required: true
    }
});

function downloadPdf(filename = "document.pdf") {
    const link = document.createElement('a');
    link.href = "data:application/pdf;base64," + props.archive.document;
    link.download = filename;
    link.click();
}
</script>

<template>
    <tr>
        <td>{{ props.archive.file_name }}</td>
        <td>{{ props.archive.adding_date }}</td>
        <td>{{ props.archive.teacher_name }}</td>
        <td>{{ props.archive.teacher_email }}</td>
        <td>{{ props.archive.survey_name }}</td>
        <td>{{ props.archive.survey_description }}</td>
        <td>{{ props.archive.survey_question }}</td>
        <td>{{ props.archive.session_class }}</td>
        <td>{{ props.archive.session_remark }}</td>
        <td><button @click="downloadPdf(props.archive.file_name)">Télécharger</button></td>
    </tr>
</template>