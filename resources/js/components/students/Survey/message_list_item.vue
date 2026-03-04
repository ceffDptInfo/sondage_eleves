<script setup>
import { defineProps } from 'vue';
const props = defineProps({
    remark: Object,
    ip: String
});
</script>
<template>
    <div class="flex items-center mb-4 space-x-4 border-b pb-2">
        <span :class="[props.remark.status === 'positive' ? 'text-green-500' : 'text-red-500', 'text-2xl']">{{ props.remark.value }}</span>
        <button v-if="props.remark.ip_address !== props.ip" class="rounded-full bg-green-500 h-8 w-8">
            <img src="/icons/like.png" class="p-2" alt="Icone de like">
        </button>
        <button v-if="props.remark.ip_address !== props.ip" class="rounded-full bg-red-500 h-8 w-8">
            <img src="/icons/dislike.png" class="p-2" alt="Icone de dislike">
        </button>
        <button v-if="props.remark.private" class="h-6 w-6">
            <img src="/icons/lock.png" alt="Icone de verrouillage">
        </button>
    </div>
</template>