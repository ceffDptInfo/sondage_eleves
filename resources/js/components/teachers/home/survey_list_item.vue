<script setup>
const props = defineProps({
    survey: {
        type: Object,
        required: true
    }
});

const navigateToSetup = () => {
    window.location.href = '/teachers/probe/set_up/' + props.survey.id;
};
</script>

<template>
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-xl font-semibold mb-4">{{ props.survey.name }}</h3>
        <p class="text-gray-600 mb-4">Créé le {{ new Date(props.survey.created_at).toLocaleDateString() }}</p>
        <button @click="navigateToSetup" class="border rounded-lg p-2">Effectuer</button>
    </div>
</template>