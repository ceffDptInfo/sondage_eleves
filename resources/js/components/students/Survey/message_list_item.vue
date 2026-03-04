<script setup>
import { defineProps } from 'vue';
import axios from 'axios';
import { ref } from 'vue';

const props = defineProps({
    remark: Object,
    ip: String
});

const err = ref('');

function positiveVote() {
    axios.post(`/students/survey/${props.remark.survey_code}/remark/${props.remark.id}/vote`, { type: 'like' })
        .then(response => {
            console.log('Remarque likée :', response.data);
        })
        .catch(error => {
            console.error('Erreur lors du like de la remarque :', error.response.data);
            err.value = error.response.data.message;
        });
}

function negativeVote() {
    axios.post(`/students/survey/${props.remark.survey_code}/remark/${props.remark.id}/vote`, { type: 'dislike' })
        .then(response => {
            console.log('Remarque dislikée :', response.data);
        })
        .catch(error => {
            console.error('Erreur lors du dislike de la remarque :', error.response.data);
            err.value = error.response.data.message;
        });
}
</script>
<template>
    <div class="flex items-center mb-4 space-x-4 border-b pb-2">
        <span :class="[props.remark.status === 'positive' ? 'text-green-500' : 'text-red-500', 'text-2xl']">{{
            props.remark.value }}</span>
        <button @click="positiveVote" v-if="props.remark.ip_address !== props.ip"
            class="rounded-full bg-green-500 h-8 w-8">
            <img src="/icons/like.png" class="p-2" alt="Icone de like">
        </button>
        <button @click="negativeVote" v-if="props.remark.ip_address !== props.ip"
            class="rounded-full bg-red-500 h-8 w-8">
            <img src="/icons/dislike.png" class="p-2" alt="Icone de dislike">
        </button>

        <img src="/icons/lock.png" v-if="props.remark.private" class="h-6 w-6" alt="Icone de verrouillage">

        <span class="text-red-500">{{ err }}</span>
    </div>
</template>