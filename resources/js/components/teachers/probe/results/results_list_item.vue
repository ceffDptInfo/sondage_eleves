<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    remark: Object
});

const likes = props.remark.votes.filter(vote => vote.type === 'like').length;
const dislikes = props.remark.votes.filter(vote => vote.type === 'dislike').length;
</script>
<template>
    <div class="bg-white border-l-4 rounded-2xl p-5 shadow-sm flex items-center gap-6 hover:border-gray-200 transition-all" :class="props.remark.status === 'positive' ? 'border-green-500' : 'border-red-500'">
        <div class="flex-1">
            <h3 class="'text-lg font-bold leading-tight'">
                {{ props.remark.value }}
            </h3>
        </div>

        <div class="flex items-center gap-4">
            <div v-if="!props.remark.private" class="flex items-center gap-2 bg-green-50 px-3 py-1.5 rounded-xl">
                <span class="text-green-700 font-bold text-sm">{{ likes }}</span>
                <div class="bg-green-500 p-1.5 rounded-full shadow-sm shadow-green-200">
                    <img src="/icons/like.png" alt="Like" class="w-4 h-4 brightness-0 invert">
                </div>
            </div>

            <div v-if="!props.remark.private" class="flex items-center gap-2 bg-red-50 px-3 py-1.5 rounded-xl">
                <span class="text-red-700 font-bold text-sm">{{ dislikes }}</span>
                <div class="bg-red-500 p-1.5 rounded-full shadow-sm shadow-red-200">
                    <img src="/icons/dislike.png" alt="Dislike" class="w-4 h-4 brightness-0 invert">
                </div>
            </div>

            <div v-if="props.remark.private" class="flex items-center gap-2 bg-gray-100 px-3 py-1.5 rounded-xl">
                <span class="text-gray-500 font-bold text-xs uppercase">Privé</span>
                <div class="bg-gray-400 p-1.5 rounded-full">
                    <img src="/icons/lock.png" alt="Lock" class="w-4 h-4 brightness-0 invert">
                </div>
            </div>
        </div>
    </div>
</template>