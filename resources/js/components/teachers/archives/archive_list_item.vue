<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    archive: {
        type: Object,
        required: true
    }
});
</script>

<template>
    <div class="flex space-x-2">
        <span>Nom : {{ props.archive.survey_name }}</span>
        <span>Date : {{ props.archive.adding_date }}</span>
        <span>Classe : {{ props.archive.session_class }}</span>
        <button>Télécharger les résultats</button>
    </div>
</template>