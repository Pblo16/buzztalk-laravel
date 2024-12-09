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
        'process.env.VITE_PUSHER_APP_KEY': JSON.stringify(process.env.VITE_PUSHER_APP_KEY),
        'process.env.VITE_PUSHER_APP_CLUSTER': JSON.stringify(process.env.VITE_PUSHER_APP_CLUSTER),
        'process.env.VITE_PUSHER_SCHEME': JSON.stringify(process.env.VITE_PUSHER_SCHEME || 'https'),
        'process.env.VITE_PUSHER_HOST': JSON.stringify(process.env.VITE_PUSHER_HOST),
        'process.env.VITE_PUSHER_PORT': JSON.stringify(process.env.VITE_PUSHER_PORT || 443),
    }
});
