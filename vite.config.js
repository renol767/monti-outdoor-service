import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/css/landing-ui-fixes.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
