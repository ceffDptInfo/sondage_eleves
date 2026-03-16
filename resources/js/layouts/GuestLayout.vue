<script setup>
import ApplicationLogo from '@/Components/base/ApplicationLogo.vue';
import Header from '@/components/navigation/Header.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Header />
    <div
        class="flex min-h-screen flex-col items-center justify-center px-6">
        <div>
            <Link href="/">
                <ApplicationLogo class="lg:h-20 lg:w-20 h-10 w-10 fill-current text-gray-500" />
            </Link>
        </div>

        <div
            class="lg:mt-6 w-full overflow-hidden px-6 py-4 sm:max-w-md sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
