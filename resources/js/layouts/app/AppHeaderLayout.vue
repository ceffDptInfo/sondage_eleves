<script setup lang="ts">
import AppContent from '@/components/base/AppContent.vue';
import Header from '@/components/navigation/header.vue';
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
        <AppContent>
            <slot />
        </AppContent>
    </AppShell>
</template>
