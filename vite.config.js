import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/assets/scripts/menu.js',
                'resources/assets/scripts/app/clinica/core.js',
                'resources/js/clinica/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
