import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/sass/admin.scss',
                'resources/js/admin/main.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '~simplebar': path.resolve(__dirname, 'node_modules/simplebar'),
            '~feather-icons': path.resolve(__dirname, 'node_modules/feather-icons')
        }
    },
});
