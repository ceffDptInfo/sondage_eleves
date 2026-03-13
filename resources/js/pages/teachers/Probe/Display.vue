<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { onMounted, ref } from 'vue';
import axios from 'axios';

const props = defineProps({
    sessionId: Number
});

const session = ref(null);
const survey = ref(null);
const timeSeconds = ref(0);
const timer = ref(new Date(0).toISOString().substr(14, 5));

onMounted(() => {
    axios.get(`/teachers/probe/session/${props.sessionId}`)
        .then(response => {
            session.value = response.data;
            return axios.get(`/teachers/survey/${session.value.survey_id}`);
        })
        .then(response => {
            survey.value = response.data;
        })
        .catch(error => console.error('Erreur:', error));

    setInterval(() => {
        if (session.value) {
            timeSeconds.value += 1;
            if (timeSeconds.value >= 3600) {
                timer.value = new Date(timeSeconds.value * 1000).toISOString().substr(11, 8);
            } else {
                timer.value = new Date(timeSeconds.value * 1000).toISOString().substr(14, 5);
            }
        }
    }, 1000);
});

function end() {
    if (confirm('Êtes-vous sûr de vouloir clore cette session ?')) {
        axios.patch(`/teachers/probe/session/${props.sessionId}/complete`)
            .then(response => {
                console.log('Sondage terminé avec succès. Statut : ', response.data.session.status);
                window.location.href = '/teachers/probe/results/' + props.sessionId;
            })
            .catch(error => {
                console.error('Erreur lors de la terminaison du sondage:', error);
            });
    }
}
</script>

<template>

    <Head title="Session en cours" />
    <AppLayout>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-6">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Espace enseignant - Sonder</h2>
                <p class="text-gray-500 mt-1">Diffusez les informations ci-dessous à vos élèves.</p>
                <div class="mt-3 h-1.5 w-20 bg-amber-500 rounded-full"></div>
            </div>
            <div class="flex items-center bg-amber-50 border border-amber-200 px-4 py-2 rounded-full">
                <span class="text-amber-700 font-semibold uppercase text-sm">Temps : {{ timer }}</span>
            </div>
        </div>

        <div class="mt-10">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <label class="text-xs font-bold text-gray-400 uppercase">Question posée</label>
                    <p class="text-2xl font-medium text-gray-800 mt-2">{{ survey?.question || 'Chargement...' }}</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-widest">Sondage</label>
                    <p class="text-lg text-gray-600 mt-1">{{ survey?.name }}</p>
                </div>
            </div>

            <div class="mt-10 gap-10 grid grid-cols-2">
                <div class="p-6 rounded-xl shadow-lg text-white">
                    <label class="text-xs font-bold text-amber-600 uppercase">Code d'accès</label>
                    <p class="text-5xl font-mono font-black text-amber-500 mt-2 text-center">
                        {{ session?.code }}
                    </p>
                </div>

                <div class="p-6 rounded-xl shadow-lg bg-amber-500">
                    <label class="text-xs font-bold text-white uppercase">Mot de passe</label>
                    <p class="text-5xl font-mono font-black text-white mt-2 text-center">
                        {{ session?.password }}
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-12 flex justify-center">
            <button @click="end"
                class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-bold py-4 px-10 rounded-xl transition-all shadow-lg hover:shadow-red-200 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Clore la session
            </button>
        </div>
    </AppLayout>
</template>