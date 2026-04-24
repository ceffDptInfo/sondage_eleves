<script setup>
import axios from 'axios';
const props = defineProps({
    survey: { type: Object, required: true }
});

const navigateToSetup = () => {
    axios.get('/teachers/probe/set_up/' + props.survey.id)
        .then(response => {
            console.log('Navigation vers la configuration du sondage:', response.data);
            window.location.href = '/teachers/probe/set_up/' + props.survey.id;
        })
        .catch(error => {
            console.error('Erreur lors de la navigation vers la configuration du sondage:', error);
        });
};

const deleteSurvey = () => {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce sondage ? Cette action est irréversible.')) {
        axios.delete('/teachers/survey/' + props.survey.id)
            .then(() => {
                console.log('Sondage supprimé avec succès');
                window.location.reload();
            })
            .catch(error => {
                console.error('Erreur lors de la suppression du sondage:', error);
            });
    }
};

const editSurvey = () => {
    window.location.href = '/teachers/survey/' + props.survey.id + '/edit';
};
</script>

<template>
    <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm flex flex-col justify-between group">
        <div>
            <div class="flex justify-between">
                <h3 class="text-xl font-bold text-gray-900 leading-tight mb-2">
                    {{ props.survey.name }}
                </h3>
                <div class="space-x-2">
                    <button @click="editSurvey"
                        class="text-black hover:text-amber-600 hover:scale-110 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </button>
                    <button @click="deleteSurvey"
                        class="text-red-500 hover:text-red-600 hover:scale-110 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <p class="text-sm text-gray-500 flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                {{ new Date(props.survey.creation_date).toLocaleDateString() }}
            </p>
        </div>

        <button @click="navigateToSetup"
            class="mt-6 w-full bg-gray-50 hover:bg-amber-500 hover:text-white text-gray-700 font-bold py-3 px-4 rounded-xl transition flex items-center justify-center gap-2">
            Lancer la session
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
        </button>
    </div>
</template>