<script setup>
import { router } from '@inertiajs/vue3';

const props = defineProps({
    survey: { type: Object, required: true }
});

const navigateToSetup = () => {
    router.visit('/teachers/probe/set_up/' + props.survey.id);
};
</script>

<template>
    <div
        class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm flex flex-col justify-between group">
        <div>
            <h3 class="text-xl font-bold text-gray-900 leading-tight mb-2">
                {{ props.survey.name }}
            </h3>

            <p class="text-sm text-gray-500 flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                {{ new Date(props.survey.created_at).toLocaleDateString() }}
            </p>
        </div>

        <button @click="navigateToSetup"
            class="mt-6 w-full bg-gray-50 group-hover:bg-blue-600 text-gray-700 group-hover:text-white font-bold py-3 px-4 rounded-xl transition-all flex items-center justify-center gap-2">
            Lancer la session
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
        </button>
    </div>
</template>