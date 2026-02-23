<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { ref } from 'vue';
import axios from 'axios';

const id = window.location.pathname.split('/')[4];

let session = ref({
    survey_id: id,
    status: 'created',
    class: '',
    remark: '',
    code: Math.floor(Math.random() * 1000000),
    password: ''
});

function setUp() {
    axios.post(`/teachers/probe/session`, session.value)
        .then(response => {
            console.log('Sondage configuré avec succès:', response.data);
            window.location.href = '/teachers/probe/display/' + response.data.session.id;
        })
        .catch(error => {
            console.error('Erreur lors de la configuration du sondage:', error);
        });
}
</script>

<template>
    <AppLayout>
        <div class="flex-col items-center mb-10 mt-24">
            <h2 class="text-2xl md:text-3xl font-bold">Enseignant - Sonder</h2>
        </div>
        <div>
            <label for="class">Classe : </label>
            <input type="text" id="class" name="class" v-model="session.class" class="border border-gray-300 rounded-md p-2 w-full">

            <label for="remark">Remarque : </label>
            <input type="text" id="remark" name="remark" v-model="session.remark" class="border border-gray-300 rounded-md p-2 w-full">

            <label for="password">Mot de passe : </label>
            <input type="password" id="password" name="password" v-model="session.password" class="border border-gray-300 rounded-md p-2 w-full">
        </div>
        <div class="mx-auto mt-40">
            <button @click="setUp()"
                class="bg-green-500 hover:bg-green-700 text-white font-bold px-12 py-6 rounded text-8xl">Valider</button>
        </div>
    </AppLayout>
</template>