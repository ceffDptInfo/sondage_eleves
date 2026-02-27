<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
</script>

<template>

    <Head title="Accueil" />
    <AppLayout>
        <div class="flex items-center justify-center min-h-screen">
            <div class="grid grid-cols-2 gap-8">
                <Link href="/students/home">
                    <div class="bg-gray-500 text-white flex items-center justify-center p-8">
                        <h1 class="text-8xl font-bold">Élèves</h1>
                    </div>
                </Link>
                <Link href="/teachers/home">
                    <div class="bg-gray-500 text-white flex items-center justify-center p-8">
                        <h1 class="text-8xl font-bold">Enseignants</h1>
                    </div>
                </Link>
            </div>
        </div>
    </AppLayout>
</template>
