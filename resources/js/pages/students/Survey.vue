<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import MessageListItem from '@/components/students/Survey/message_list_item.vue';

const props = defineProps({
    code: String
});
</script>

<template>
    <AppLayout>
        <div class="flex-col items-center mb-10 mt-24">
            <h2 class="text-2xl md:text-3xl font-bold">Sondage</h2>

            <MessageListItem></MessageListItem>

            <div
                class="fixed bottom-0 border-t border-gray-200 h-16 px-4 flex items-center gap-3">
                <input type="text"
                    class="flex-1 h-10 px-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Votre remarque...">

                <div class="flex gap-2">
                    <button
                        class="rounded-full bg-green-500 hover:bg-green-600 h-10 w-10 transition">
                        <img src="/icons/checkmark.png" class="p-2.5" alt="Validation">
                    </button>
                    <button
                        class="rounded-full bg-red-500 hover:bg-red-600 h-10 w-10 transition">
                        <img src="/icons/close.png" class="p-3" alt="Fermeture">
                    </button>
                    <button
                        class="rounded-full bg-gray-400 hover:bg-gray-500 h-10 w-10 transition">
                        <img src="/icons/lock.png" class="p-2" alt="Verrouillage">
                    </button>
                    <button class="ms-8 rounded-full hover:bg-gray-200 h-10 w-10 transition">
                        <img src="/icons/message.png" class="p-2" alt="Message">
                    </button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>