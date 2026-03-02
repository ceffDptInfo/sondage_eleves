<script setup>
import { Head } from '@inertiajs/vue3';
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
    <Head title="Mise en place" />
    <AppLayout>
        <div class="flex-col items-center mb-10 mt-24">
            <h2 class="text-2xl md:text-3xl font-bold">Enseignant - Sonder</h2>
        </div>
        <form method="POST" @submit.prevent="setUp" class="max-w-2xl mx-auto" autocomplete="off">
            <div>
                <label for="class">Classe : </label>
                <input type="text" id="class" name="class" v-model="session.class" placeholder="Classe"
                    class="border border-gray-300 rounded-md p-2 w-full">

                <label for="remark">Remarque : </label>
                <input type="text" id="remark" name="remark" v-model="session.remark" placeholder="Remarque"
                    class="border border-gray-300 rounded-md p-2 w-full">

                <label for="survey_password">Mot de passe : </label>
                <input type="password" id="survey_password" name="survey_password" v-model="session.password" required="true" placeholder="Mot de passe"
                    class="border border-gray-300 rounded-md p-2 w-full">
            </div>
            <div class="mx-auto mt-40">
                <button type="submit"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold px-12 py-6 rounded text-8xl">Valider</button>
            </div>
        </form>
    </AppLayout>
</template>