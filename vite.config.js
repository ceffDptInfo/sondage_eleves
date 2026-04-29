import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig(({ mode }) => {
    const env = loadEnv(mode, process.cwd(), '');

    let hmrHost = 'localhost';
    try {
        hmrHost = new URL(env.APP_URL || 'http://localhost').hostname;
    } catch {
        // Keep localhost when APP_URL is missing or invalid.
    }

    return {
        plugins: [
            laravel({
                input: 'resources/js/app.js',
                refresh: true,
            }),
            vue({
                template: {
                    transformAssetUrls: {
                        base: null,
                        includeAbsolute: false,
                    },
                },
            }),
        ],
        server: {
            host: '0.0.0.0',
            hmr: {
                host: hmrHost,
            },
        },
    };
});
