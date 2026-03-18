<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { ref } from 'vue';
import axios from 'axios';

const credentials = ref({
    code: '',
    password: ''
});

const errorMsg = ref('');

function submitForm() {
    axios.post('/students/connection', credentials.value)
        .then(response => {
            console.log('Connexion réussie:', response.data);
            window.location.href = `/students/survey/${credentials.value.code}`;
        })
        .catch(error => {
            console.error('Erreur lors de la connexion:', error);
            errorMsg.value = error.response.data.message || 'Une erreur est survenue lors de la connexion.';
        });
}
</script>

<template>

    <Head title="Portail" />
    <AppLayout>
            <div>
                <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">Espace élèves - Portail
                </h2>
                <p class="text-gray-500 mt-1">Entrez les informations de connexion.</p>
                <div class="mt-3 h-1.5 w-20 bg-amber-500 rounded-full"></div>
            </div>

            <div class="w-full mx-auto max-w-md p-8 my-auto mt-24 -translate-y-8 rounded-lg">
                <form @submit.prevent="submitForm" autocomplete="off">
                    <div class="mb-6">
                        <label for="inputCode" class="block text-sm font-medium text-gray-700 mb-2">
                            Entrez le code du sondage
                        </label>
                        <input type="text" id="inputCode" name="inputCode" v-model="credentials.code" placeholder="Code"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>

                    <div class="mb-6">
                        <label for="inputPassword" class="block text-sm font-medium text-gray-700 mb-2">
                            Entrez le mot de passe du sondage
                        </label>
                        <input type="password" id="inputPassword" name="inputPassword" v-model="credentials.password"
                            placeholder="Mot de passe" autocomplete="new-password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>

                    <button
                        class="w-full px-4 py-2 bg-amber-500 text-white font-medium rounded-xl hover:bg-amber-700 transition">
                        Ouvrir le sondage
                    </button>
                </form>
                <div v-if="errorMsg" class="mt-4 text-red-600">{{ errorMsg }}</div>
            </div>
    </AppLayout>
</template>