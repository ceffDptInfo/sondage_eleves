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
        <td><button @click="downloadPdf()">Télécharger</button></td>
    </tr>
</template>