<script setup>
import AppLayout from '@/layouts/AppLayout.vue';

const id = window.location.pathname.split('/')[4];

function setUp() {
    window.location.href = '/teachers/probe/display';
}
</script>

<template>
    <AppLayout>
        <div class="flex-col items-center mb-10 mt-24">
            <h2 class="text-2xl md:text-3xl font-bold">Enseignant - Sonder</h2>
        </div>
        <div>
            <label for="class">Classe : </label>
            <input type="text" id="class" name="class" class="border border-gray-300 rounded-md p-2 w-full">

            <label for="remark">Remarque : </label>
            <input type="text" id="remark" name="remark" class="border border-gray-300 rounded-md p-2 w-full">
        </div>
        <div class="mx-auto mt-40">
            <button @click="setUp()"
                class="bg-green-500 hover:bg-green-700 text-white font-bold px-12 py-6 rounded text-8xl">Valider</button>
        </div>
    </AppLayout>
</template>