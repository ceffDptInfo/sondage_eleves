<script setup>
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps({
    survey: Object,
    code: String
});
</script>

<template>
    <AppLayout>
        <div class="flex-col items-center mb-10 mt-24">
            <h2 class="text-2xl md:text-3xl font-bold">Sondage</h2>
        </div>
        <h2>{{ props.code }}</h2>
    </AppLayout>
</template>