<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { onMounted, ref } from 'vue';
import axios from 'axios';

const props = defineProps({
    surveyId: Number
});

const session = ref({
    survey_id: props.surveyId,
    status: 'active',
    class: '',
    remark: '',
    code: Math.floor(Math.random() * 1000000),
    password: ''
});

const errorMsg = ref('');

onMounted(() => {
    axios.get('/teachers/surveys')
        .then(response => {
            if (!response.data.some(survey => survey.id == props.surveyId)) {
                console.error('Sondage non trouvé ou accès refusé');
                window.location.href = '/teachers/home';
            }
        })
        .catch(error => {
            console.error('Erreur lors de la récupération du sondage:', error);
            errorMsg.value = error.response.data.message || 'Une erreur est survenue lors de la récupération du sondage.';
        });
});

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
            <div class="mb-10">
                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Enseignant - Sonder</h2>
                <div class="mt-3 h-1.5 w-20 bg-green-500 rounded-full"></div>
            </div>

            <div class="max-w-4xl mx-auto">
                <form @submit.prevent="setUp" class="bg-white border border-gray-100 shadow-sm rounded-2xl p-8 space-y-6" autocomplete="off">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="class" class="block text-sm font-semibold text-gray-700 mb-1">Classe</label>
                            <input type="text" id="class" v-model="session.class" placeholder="Ex: Terminale G1"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none transition-all">
                        </div>

                        <div>
                            <label for="survey_password" class="block text-sm font-semibold text-gray-700 mb-1">Mot de passe de session</label>
                            <input type="text" id="survey_password" v-model="session.password" required
                                placeholder="Définit l'accès pour les élèves"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none transition-all">
                        </div>
                    </div>

                    <div>
                        <label for="remark" class="block text-sm font-semibold text-gray-700 mb-1">Remarque (optionnel)</label>
                        <input type="text" id="remark" v-model="session.remark" placeholder="Ex: Séance de révision"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none transition-all">
                    </div>

                    <div class="pt-4 flex justify-center">
                        <button type="submit"
                            class="w-full md:w-1/2 bg-green-600 hover:bg-green-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-green-100 transition-all active:scale-[0.98]">
                            Ouvrir le sondage
                        </button>
                    </div>
                </form>

                <p v-if="errorMsg" class="text-red-500 text-sm font-medium text-center mt-6 bg-red-50 py-2 rounded-lg">
                    {{ errorMsg }}
                </p>
            </div>
    </AppLayout>
</template>