<script setup>
import { now } from '@vueuse/core';
</script>

<template>
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-xl font-semibold mb-4">Test</h3>
        <p class="text-gray-600 mb-4">Créé le {{ new Date(now()).toLocaleDateString() }}</p>
        <Link :href="`/teachers/surveys/$id`" class="text-blue-500 hover:underline">Voir les détails</Link>
    </div>
</template>