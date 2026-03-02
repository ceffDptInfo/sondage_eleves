<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';

const page = usePage();
const user = page.props.auth.user;
</script>

<template>
    <Head title="Tableau de bord" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Tableau de bord
            </h2>
        </template>

        <div class="py-10">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-8">

                <!-- Welcome Banner -->
                <div class="rounded-2xl bg-gradient-to-r from-indigo-500 to-purple-600 p-8 text-white shadow-lg">
                    <h1 class="text-3xl font-bold">
                        Bonjour, {{ user.name }} 👋
                    </h1>
                    <p class="mt-2 text-indigo-100 text-lg">
                        Bienvenue sur <span class="font-semibold">Sondage Élèves</span> — gérez vos sondages facilement.
                    </p>
                </div>

                <!-- Feature Cards -->
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

                    <!-- Surveys -->
                    <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100 flex items-start gap-4">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-2xl">
                            📋
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Sondages</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Créez et gérez vos sondages avec une question et un mot de passe.
                            </p>
                        </div>
                    </div>

                    <!-- Sessions -->
                    <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100 flex items-start gap-4">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-green-50 text-2xl">
                            🏫
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Sessions</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Lancez des sessions par classe pour collecter les réponses des élèves.
                            </p>
                        </div>
                    </div>

                    <!-- Votes -->
                    <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100 flex items-start gap-4">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-yellow-50 text-2xl">
                            ✅
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Votes</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Suivez les votes des élèves en temps réel pour chaque session.
                            </p>
                        </div>
                    </div>

                    <!-- Remarks -->
                    <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100 flex items-start gap-4">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-pink-50 text-2xl">
                            💬
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Remarques</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Consultez les commentaires laissés par les élèves lors des sessions.
                            </p>
                        </div>
                    </div>

                    <!-- Archives -->
                    <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100 flex items-start gap-4">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-gray-100 text-2xl">
                            🗂️
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Archives</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Retrouvez l'historique complet de vos sondages passés.
                            </p>
                        </div>
                    </div>

                    <!-- Profile -->
                    <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100 flex items-start gap-4">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-2xl">
                            👤
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Profil</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Mettez à jour vos informations personnelles et votre mot de passe.
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
