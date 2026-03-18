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
    axios.post(`/students/survey/remark/${props.remark.id}/vote`, { type: 'like' })
        .then(response => {
            console.log('Remarque likée :', response.data);
            err.value = '';
            props.vote.type = 'like';
        })
        .catch(error => {
            console.error('Erreur lors du like de la remarque :', error.response.data);
            err.value = error.response.data.message;
        });
}

function negativeVote() {
    axios.post(`/students/survey/remark/${props.remark.id}/vote`, { type: 'dislike' })
        .then(response => {
            err.value = '';
            console.log('Remarque dislikée :', response.data);
            props.vote.type = 'dislike';
        })
        .catch(error => {
            console.error('Erreur lors du dislike de la remarque :', error.response.data);
            err.value = error.response.data.message;
        });
}
</script>
<template>
    <div class="flex items-center mb-4 space-x-4 border-b pb-2">
        <span :class="[props.remark.status === 'positive' ? 'text-green-500' : 'text-red-500', 'text-2xl overflow-auto']">{{
            props.remark.value }}</span>
        <button @click="positiveVote" v-if="props.remark.ip_address !== props.ip"
            :class="[props.vote?.type === 'like' ? 'bg-green-400' : 'bg-green-200', 'rounded-full h-8 w-8']">
            <!-- ?? ne bascule sur la seconde que si elle est null ou undefined -->
            <img src="/icons/like.png" class="p-2" alt="Icone de like">
        </button>
        <button @click="negativeVote" v-if="props.remark.ip_address !== props.ip"
            :class="[props.vote?.type === 'dislike' ? 'bg-red-400' : 'bg-red-200', 'rounded-full h-8 w-8']">
            <img src="/icons/dislike.png" class="p-2" alt="Icone de dislike">
        </button>

        <img src="/icons/lock.png" v-if="props.remark.private" class="h-6 w-6" alt="Icone de verrouillage">

        <span class="text-red-500">{{ err }}</span>
    </div>
</template>