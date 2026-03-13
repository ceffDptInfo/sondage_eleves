<script setup lang="ts">
import AppContent from '@/components/base/AppContent.vue';
import Header from '@/components/navigation/Header.vue';
import AppShell from '@/components/base/AppShell.vue';
import type { BreadcrumbItem } from '@/types';

type Props = {
    breadcrumbs?: BreadcrumbItem[];
};

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <AppShell class="flex-col">
        <Header />
        <AppContent class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-32 mb-10">
            <slot />
        </AppContent>
    </AppShell>
</template>
