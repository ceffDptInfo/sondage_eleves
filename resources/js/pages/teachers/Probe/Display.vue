<script setup>
import AppLayout from '@/layouts/AppLayout.vue';

function end() {
    window.location.href = '/teachers/probe/results';
}
</script>

<template>
    <AppLayout>
        <div class="flex-col items-center mb-10 mt-24">
            <h2 class="text-2xl md:text-3xl font-bold">Enseignant - Sonder <br>Affichage</h2>
        </div>
        <div>

            <div class="flex">
                <span>Le nom du sondage :</span>
                <h3>Exemple de sondage</h3>
            </div>

            <div class="flex">
                <span>La question du sondage :</span>
                <h3>Exemple de question</h3>
            </div>

            <div class="flex">
                <span>Le code du sondage :</span>
                <h3>Exemple de code</h3>
            </div>

            <div class="flex">
                <span>Le mot de passe du sondage :</span>
                <h3>Exemple de mot de passe</h3>
            </div>

            <button @click="end()"
                class="bg-red-500 hover:bg-red-700 text-white font-bold px-4 py-2 rounded mt-4">Terminer</button>
        </div>
    </AppLayout>
</template>