<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
</script>

<template>
    <AppLayout>
        <div class="flex-col items-center mb-10 mt-24">
            <h2 class="text-2xl md:text-3xl font-bold">Page d'accueil élèves</h2>
        </div>
        <div class="w-full mx-auto max-w-md p-8 rounded-lg">

            <div class="mb-6">
                <label for="inputCode" class="block text-sm font-medium text-gray-700 mb-2">
                    Entrez le code du sondage
                </label>
                <input type="text" id="inputCode" name="inputCode"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Code">
            </div>

            <div class="mb-6">
                <label for="inputPassword" class="block text-sm font-medium text-gray-700 mb-2">
                    Entrez le mot de passe du sondage
                </label>
                <input type="password" id="inputPassword" name="inputPassword"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Mot de passe">
            </div>

            <button class="w-full px-4 py-2 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition">
                Valider
            </button>
        </div>
    </AppLayout>
</template>