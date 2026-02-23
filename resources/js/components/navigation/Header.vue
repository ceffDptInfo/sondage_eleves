<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const linksVisitor = ref([
    { name: 'Accueil', to: '/', method: 'get' },
    { name: 'Élèves', to: '/students/home', method: 'get' },
    { name: 'Enseignants', to: '/teachers/home', method: 'get' },
]);
const linksAuth = ref([
    { name: 'Login', to: '/login', method: 'get' },
    { name: 'Register', to: '/register', method: 'get' },
]);
const linksStudent = ref([
    { name: 'Accueil', to: '/', method: 'get' },
]);
const linksTeacher = ref([
    { name: 'Accueil', to: '/teachers/home', method: 'get' },
    { name: 'Création', to: '/teachers/create_survey', method: 'get' },
    { name: 'Archives', to: '/teachers/archives', method: 'get' },
]);
const linksProbe = ref([
    { name: 'Accueil', to: '/teachers/home', method: 'get',},
    { name: 'Sondages', method: 'get' },
    { name: 'Création', to: '/teachers/create_survey', method: 'get' },
    { name: 'Archives', to: '/teachers/archives', method: 'get' },
]);
</script>

<template>
    <header
        class="flex items-center justify-between px-8 py-4 z-[1001] fixed top-0 left-0 right-0 bg-zinc-950/95 dark:bg-zinc-50/95 backdrop-blur-md border-b border-zinc-800 dark:border-zinc-200 transition">
        <div class="flex items-center gap-3 flex-1">
            <span class="font-semibold text-xl tracking-tight text-zinc-100 dark:text-zinc-900">
                <Link href="/">Sondage Élèves</Link>
            </span>
        </div>

        <nav class="hidden md:flex items-center gap-8 flex-none">
            <template v-if="$page.url == '/login' || $page.url == '/register'">
                <Link v-for="link in linksAuth" :key="link.name" :href="link.to" :method="link.method"
                    v-on:finish="link.action" :class="[
                        'hidden text-md md:flex mx-4 py-3 relative after:absolute after:left-0 after:bottom-0 after:w-full after:h-0.5 after:bg-amber-500 after:origin-left after:transition-transform after:duration-300',
                        $page.url === link.to
                            ? 'after:scale-x-100 text-amber-500 font-medium'
                            : 'after:scale-x-0 hover:after:scale-x-100 text-zinc-400 hover:text-zinc-100 dark:text-zinc-600 dark:hover:text-zinc-900'
                    ]">
                    {{ link.name }}
                </Link>
                
            </template>
            <template v-else-if="$page.url.includes('probe') && $page.props.auth.user">
                <Link v-for="link in linksProbe" :key="link.name" :href="link.to" :method="link.method"
                    v-on:finish="link.action" :class="[
                        'hidden text-md md:flex mx-4 py-3 relative after:absolute after:left-0 after:bottom-0 after:w-full after:h-0.5 after:bg-amber-500 after:origin-left after:transition-transform after:duration-300',
                            link.name === 'Sondages'
                            ? 'after:scale-x-100 text-amber-500 font-medium'
                            : 'after:scale-x-0 hover:after:scale-x-100 text-zinc-400 hover:text-zinc-100 dark:text-zinc-600 dark:hover:text-zinc-900'
                    ]">
                    {{ link.name }}
                </Link>
            </template>
            <template v-else-if="$page.props.auth.user">
                <Link v-for="link in linksTeacher" :key="link.name" :href="link.to" :method="link.method"
                    v-on:finish="link.action" :class="[
                        'hidden text-md md:flex mx-4 py-3 relative after:absolute after:left-0 after:bottom-0 after:w-full after:h-0.5 after:bg-amber-500 after:origin-left after:transition-transform after:duration-300',
                        $page.url === link.to
                            ? 'after:scale-x-100 text-amber-500 font-medium'
                            : 'after:scale-x-0 hover:after:scale-x-100 text-zinc-400 hover:text-zinc-100 dark:text-zinc-600 dark:hover:text-zinc-900'
                    ]">
                    {{ link.name }}
                </Link>
            </template>
            <template v-else>
                <Link v-for="link in linksVisitor" :key="link.name" :href="link.to" :method="link.method"
                    v-on:finish="link.action" :class="[
                        'hidden text-md md:flex mx-4 py-3 relative after:absolute after:left-0 after:bottom-0 after:w-full after:h-0.5 after:bg-amber-500 after:origin-left after:transition-transform after:duration-300',
                        $page.url === link.to
                            ? 'after:scale-x-100 text-amber-500 font-medium'
                            : 'after:scale-x-0 hover:after:scale-x-100 text-zinc-400 hover:text-zinc-100 dark:text-zinc-600 dark:hover:text-zinc-900'
                    ]">
                    {{ link.name }}
                </Link>
            </template>
        </nav>

        <div class="flex items-center justify-end gap-6 flex-1">
            <div class="flex items-center gap-4" v-if="$page.props.auth.user">
                <Link href="/logout" method="post" as="button"
                    class="p-2 rounded-lg text-zinc-400 dark:text-zinc-600 hover:text-zinc-100 dark:hover:text-zinc-900 hover:bg-zinc-800 dark:hover:bg-zinc-200 transition-all"
                    aria-label="Logout" title="Logout">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" aria-hidden="true">
                        <path
                            d="M12.9999 2C10.2385 2 7.99991 4.23858 7.99991 7C7.99991 7.55228 8.44762 8 8.99991 8C9.55219 8 9.99991 7.55228 9.99991 7C9.99991 5.34315 11.3431 4 12.9999 4H16.9999C18.6568 4 19.9999 5.34315 19.9999 7V17C19.9999 18.6569 18.6568 20 16.9999 20H12.9999C11.3431 20 9.99991 18.6569 9.99991 17C9.99991 16.4477 9.55219 16 8.99991 16C8.44762 16 7.99991 16.4477 7.99991 17C7.99991 19.7614 10.2385 22 12.9999 22H16.9999C19.7613 22 21.9999 19.7614 21.9999 17V7C21.9999 4.23858 19.7613 2 16.9999 2H12.9999Z"
                            fill="currentColor" transform="rotate(180 12 12)"></path>
                        <path
                            d="M13.9999 11C14.5522 11 14.9999 11.4477 14.9999 12C14.9999 12.5523 14.5522 13 13.9999 13V11Z"
                            fill="currentColor" transform="rotate(180 12 12)"></path>
                        <path
                            d="M5.71783 11C5.80685 10.8902 5.89214 10.7837 5.97282 10.682C6.21831 10.3723 6.42615 10.1004 6.57291 9.90549C6.64636 9.80795 6.70468 9.72946 6.74495 9.67492L6.79152 9.61162L6.804 9.59454L6.80842 9.58848C6.80846 9.58842 6.80892 9.58778 5.99991 9L6.80842 9.58848C7.13304 9.14167 7.0345 8.51561 6.58769 8.19098C6.14091 7.86637 5.51558 7.9654 5.19094 8.41215L5.18812 8.41602L5.17788 8.43002L5.13612 8.48679C5.09918 8.53682 5.04456 8.61033 4.97516 8.7025C4.83623 8.88702 4.63874 9.14542 4.40567 9.43937C3.93443 10.0337 3.33759 10.7481 2.7928 11.2929L2.08569 12L2.7928 12.7071C3.33759 13.2519 3.93443 13.9663 4.40567 14.5606C4.63874 14.8546 4.83623 15.113 4.97516 15.2975C5.04456 15.3897 5.09918 15.4632 5.13612 15.5132L5.17788 15.57L5.18812 15.584L5.19045 15.5872C5.51509 16.0339 6.14091 16.1336 6.58769 15.809C7.0345 15.4844 7.13355 14.859 6.80892 14.4122L5.99991 15C6.80892 14.4122 6.80897 14.4123 6.80892 14.4122L6.804 14.4055L6.79152 14.3884L6.74495 14.3251C6.70468 14.2705 6.64636 14.1921 6.57291 14.0945C6.42615 13.8996 6.21831 13.6277 5.97282 13.318C5.89214 13.2163 5.80685 13.1098 5.71783 13H13.9999V11H5.71783Z"
                            fill="currentColor" transform="rotate(180 12 12)"></path>
                    </svg>
                </Link>
            </div>
        </div>
    </header>
</template>