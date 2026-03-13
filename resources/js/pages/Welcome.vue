<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
</script>

<template>

    <Head title="Accueil" />
    <AppLayout>
        <div class="flex items-center justify-center min-h-screen bg-white p-8 -mt-32">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 w-full max-w-5xl">

                <Link href="/students/home" class="group">
                    <div
                        class="border border-gray-200 p-16 flex flex-col items-center justify-center transition-all duration-300 hover:border-black hover:bg-gray-50">
                        <h1
                            class="text-6xl font-light tracking-tighter text-black group-hover:scale-[1.02] transition-transform">
                            Élèves
                        </h1>
                        <span
                            class="mt-4 text-xs uppercase tracking-[0.3em] text-gray-400 group-hover:text-black transition-colors">
                            Espace accessible
                        </span>
                    </div>
                </Link>

                <Link href="/teachers/home" class="group">
                    <div
                        class="border border-gray-200 p-16 flex flex-col items-center justify-center transition-all duration-300 hover:border-black hover:bg-gray-50">
                        <h1
                            class="text-6xl font-light tracking-tighter text-black group-hover:scale-[1.02] transition-transform">
                            Enseignants
                        </h1>
                        <span
                            class="mt-4 text-xs uppercase tracking-[0.3em] text-gray-400 group-hover:text-black transition-colors">
                            Login nécessaire
                        </span>
                    </div>
                </Link>

            </div>
        </div>
    </AppLayout>
</template>
