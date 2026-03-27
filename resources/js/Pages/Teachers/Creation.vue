<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { ref } from 'vue';
import axios from 'axios';

const survey = ref({
    name: '',
    creation_date: '',
    description: '',
    question: '',
});

const errorMsg = ref('');

function submit() {
    if (survey.value.creation_date == "") {
        survey.value.creation_date = new Date().toISOString().split('T')[0];
    }
    axios.post('/teachers/survey', survey.value)
        .then(response => {
            console.log('Sondage créé avec succès:', response.data);
            window.location.href = '/teachers/home';
        })
        .catch(error => {
            console.error('Erreur lors de la création du sondage:', error);
            errorMsg.value = error.response.data.message || 'Une erreur est survenue lors de la création du sondage.';
        });
}
</script>

<template>

    <Head title="Conception" />
    <AppLayout>
        <div>
            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">Espace enseignant - Conception</h2>
            <div class="mt-3 h-1.5 w-20 bg-amber-500 rounded-full"></div>
        </div>

        <div class="rounded-2xl w-full lg:max-w-5xl mx-auto mt-16">
            <form class="space-y-6" @submit.prevent="submit()" autocomplete="off">
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nom du sondage*</label>
                    <input type="text" id="name" v-model="survey.name" placeholder="Ex: ICH-0183"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-transparent outline-none transition-all">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="creation_date" class="block text-sm font-semibold text-gray-700 mb-1">Date (par défaut : aujourd'hui)</label>
                        <input type="date" id="creation_date" v-model="survey.creation_date"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-transparent outline-none transition-all">
                    </div>
                </div>

                <div>
                    <label for="question" class="block text-sm font-semibold text-gray-700 mb-1">Question
                        principale*</label>
                    <input type="text" id="question" v-model="survey.question" placeholder="Quelle est votre question ?"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-transparent outline-none transition-all">
                </div>

                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                    <textarea id="description" v-model="survey.description" rows="3"
                        placeholder="Précisez le contexte du sondage..."
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-transparent outline-none transition-all"></textarea>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-amber-500 hover:bg-amber-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-amber-100 transition-all active:scale-[0.98]">
                        Créer le sondage
                    </button>
                </div>
            </form>

            <p v-if="errorMsg" class="text-red-500 text-sm font-medium text-center mt-6 bg-red-50 py-2 rounded-lg">
                {{ errorMsg }}
            </p>
        </div>
    </AppLayout>
</template>