<script setup>
import { defineProps } from 'vue';
import axios from 'axios';
import { ref } from 'vue';

const props = defineProps({
    remark: Object,
    ip: String,
    vote: Object
});

const err = ref('');

function positiveVote() {
    // props.vote.type = 'like';
    axios.post(`/students/survey/remark/${props.remark.id}/vote`, { type: 'like' })
    .then(response => {
            props.vote.type = 'like';
            console.log('Remarque likée :', response.data);
            err.value = '';
        })
        .catch(error => {
            console.error('Erreur lors du like de la remarque :', error.response.data);
            err.value = error.response.data.message;
        });
}

function negativeVote() {
    // props.vote.type = 'dislike';
    axios.post(`/students/survey/remark/${props.remark.id}/vote`, { type: 'dislike' })
        .then(response => {
            props.vote.type = 'dislike';
            err.value = '';
            console.log('Remarque dislikée :', response.data);
        })
        .catch(error => {
            console.error('Erreur lors du dislike de la remarque :', error.response.data);
            err.value = error.response.data.message;
        });
}
</script>
<template>
    <div class="group flex items-center justify-between bg-white p-4 mb-3 rounded-xl shadow-sm border-l-4 transition-all hover:shadow-md"
        :class="props.remark.status === 'positive' ? 'border-green-500' : 'border-red-500'">
        
        <div class="flex items-center gap-3 overflow-hidden">
            <div v-if="props.remark.private" class="shrink-0">
                <img src="/icons/lock.png" class="h-4 w-4 opacity-40" alt="Privé">
            </div>

            <span class="text-lg md:text-xl font-medium text-gray-800 truncate">
                {{ props.remark.value }}
            </span>
        </div>

        <div class="flex items-center gap-2 shrink-0 ml-4">
            <template v-if="props.remark.ip_address !== props.ip">
                <button @click="positiveVote" 
                    :class="[props.vote?.type === 'like' ? 'bg-green-500 scale-110' : 'bg-gray-100 hover:bg-green-100', 'p-2 rounded-lg transition-all active:scale-95']">
                    <img src="/icons/like.png" :class="props.vote?.type === 'like' ? 'brightness-0 invert' : ''" class="h-5 w-5" alt="Like">
                </button>

                <button @click="negativeVote" 
                    :class="[props.vote?.type === 'dislike' ? 'bg-red-500 scale-110' : 'bg-gray-100 hover:bg-red-100', 'p-2 rounded-lg transition-all active:scale-95']">
                    <img src="/icons/dislike.png" :class="props.vote?.type === 'dislike' ? 'brightness-0 invert' : ''" class="h-5 w-5" alt="Dislike">
                </button>
            </template>

            <span v-else class="text-xs font-bold text-gray-400 uppercase tracking-widest bg-gray-50 px-2 py-1 rounded">
                Moi
            </span>
        </div>

        <p v-if="err" class="absolute -bottom-5 right-0 text-xs text-red-500">{{ err }}</p>
    </div>
</template>