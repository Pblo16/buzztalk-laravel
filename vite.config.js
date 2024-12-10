import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    define: {
        'import.meta.env.VITE_PUSHER_APP_KEY': JSON.stringify(process.env.VITE_PUSHER_APP_KEY),
        'import.meta.env.VITE_PUSHER_APP_CLUSTER': JSON.stringify(process.env.VITE_PUSHER_APP_CLUSTER),
        'import.meta.env.VITE_PUSHER_SCHEME': JSON.stringify(process.env.VITE_PUSHER_SCHEME),
        'import.meta.env.VITE_PUSHER_HOST': JSON.stringify(process.env.VITE_PUSHER_HOST),
        'import.meta.env.VITE_PUSHER_PORT': JSON.stringify(process.env.VITE_PUSHER_PORT),
    }
});
