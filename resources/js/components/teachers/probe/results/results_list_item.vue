<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    remark: Object
});

const likes = props.remark.votes.filter(vote => vote.type === 'like').length;
const dislikes = props.remark.votes.filter(vote => vote.type === 'dislike').length;
</script>
<template>
    <div class="flex items-center gap-4 p-6 mb-4 rounded-lg">
        <div class="flex-1">
            <h3 :class="[props.remark.status === 'positive' ? 'text-green-500' : 'text-red-500', 'text-xl font-semibold']">{{ props.remark.value }}</h3>
        </div>

        <div class="flex items-center gap-2" v-if="!props.remark.private">
            <span class="text-sm font-medium">{{ likes }}</span>
            <div class="rounded-full bg-green-500 w-10 h-10 flex items-center justify-center">
                <img src="/icons/like.png" alt="icone de like" class="w-5 h-5 brightness-0 invert">
            </div>
        </div>

        <div class="flex items-center gap-2" v-if="!props.remark.private">
            <span class="text-sm font-medium">{{ dislikes }}</span>
            <div class="rounded-full bg-red-500 w-10 h-10 flex items-center justify-center">
                <img src="/icons/dislike.png" alt="icone de dislike" class="w-5 h-5 brightness-0 invert">
            </div>
        </div>

        <div class="flex items-center gap-2" v-if="props.remark.private">
            <div class="rounded-full bg-gray-300 w-10 h-10 flex items-center justify-center">
                <img src="/icons/lock.png" alt="icone de lock" class="w-5 h-5 brightness-0 invert">
            </div>
        </div>
    </div>
</template>