<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>

    <Head title="Welcome" />
    <AppLayout>
        <div class="flex items-center justify-center min-h-screen">
            <div class="grid grid-cols-2 gap-8">
                <Link href="/students/home">
                    <div class="bg-gray-500 text-white flex items-center justify-center">
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
