<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
</script>

<template>
    <AppLayout>
        <div class="flex-col items-center mb-10 mt-24">
            <h2 class="text-2xl md:text-3xl font-bold">Création d'un sondage</h2>
        </div>

        <form class="max-w-lg mx-auto space-y-4">
            <div>
            <label for="name" class="block text-sm font-medium">Nom du sondage:</label>
            <input type="text" id="name" name="name" class="w-full px-3 py-2 border border-gray-300 rounded">
            </div>

            <div>
            <label for="password" class="block text-sm font-medium">Mot de passe:</label>
            <input type="password" id="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded">
            </div>

            <div>
            <label for="date" class="block text-sm font-medium">Date:</label>
            <input type="date" id="date" name="date" class="w-full px-3 py-2 border border-gray-300 rounded">
            </div>

            <div>
            <label for="description" class="block text-sm font-medium">Description:</label>
            <textarea id="description" name="description" class="w-full px-3 py-2 border border-gray-300 rounded"></textarea>
            </div>

            <div>
            <label for="question" class="block text-sm font-medium">Question:</label>
            <input type="text" id="question" name="question" class="w-full px-3 py-2 border border-gray-300 rounded">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Créer le sondage</button>
        </form>
    </AppLayout>
</template>