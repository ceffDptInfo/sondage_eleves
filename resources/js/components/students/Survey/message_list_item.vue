<script setup>
import { defineProps } from 'vue';
const props = defineProps({
    message: Object
});
</script>
<template>
    <div class="flex items-center mb-4 space-x-4">
        <span class="text-2xl">Message</span>
        <button class="rounded-full bg-green-500 h-8 w-8">
            <img src="/icons/like.png" class="p-2" alt="Icone de like">
        </button>
        <button class="rounded-full bg-red-500 h-8 w-8">
            <img src="/icons/dislike.png" class="p-2" alt="Icone de dislike">
        </button>
    </div>
</template>