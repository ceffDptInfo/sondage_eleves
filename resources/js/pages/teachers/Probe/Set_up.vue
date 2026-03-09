<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { ref } from 'vue';
import axios from 'axios';

const props = defineProps({
    surveyId: Number
});

let session = ref({
    survey_id: props.surveyId,
    status: 'active',
    class: '',
    remark: '',
    code: Math.floor(Math.random() * 1000000),
    password: ''
});

const errorMsg = ref('');

function setUp() {
    axios.post(`/teachers/probe/session`, session.value)
        .then(response => {
            console.log('Sondage configuré avec succès:', response.data);
            window.location.href = '/teachers/probe/display/' + response.data.session.id;
        })
        .catch(error => {
            console.error('Erreur lors de la configuration du sondage:', error);
            errorMsg.value = error.response.data.message || 'Une erreur est survenue lors de la configuration du sondage.';
        });
}
</script>

<template>

    <Head title="Mise en place" />
    <AppLayout>
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-24 mb-10">
            <h2 class="text-2xl md:text-3xl font-bold">Enseignant - Sonder</h2>
            <div class="mt-2 h-px flex-grow bg-gradient-to-r from-gray-500 to-transparent"></div>

            <form method="POST" @submit.prevent="setUp" class="max-w-2xl mx-auto mt-8" autocomplete="off">
                <div>
                    <label for="class">Classe : </label>
                    <input type="text" id="class" name="class" v-model="session.class" placeholder="Classe"
                        class="border border-gray-300 rounded-md p-2 w-full">

                    <label for="remark">Remarque : </label>
                    <input type="text" id="remark" name="remark" v-model="session.remark" placeholder="Remarque"
                        class="border border-gray-300 rounded-md p-2 w-full">

                    <label for="survey_password">Mot de passe : </label>
                    <input type="password" id="survey_password" name="survey_password" v-model="session.password"
                        required="true" placeholder="Mot de passe" class="border border-gray-300 rounded-md p-2 w-full">
                </div>
                <div class="mx-auto mt-8">
                    <button type="submit"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold px-4 py-2 rounded text-xl">Valider</button>
                </div>
            </form>
            <div class="text-red-500 text-center mt-8">{{ errorMsg }}</div>
        </div>

    </AppLayout>
</template>