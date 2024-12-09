import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    wsHost: import.meta.env.VITE_PUSHER_HOST,
    wsPort: parseInt(import.meta.env.VITE_PUSHER_PORT),
    wssPort: parseInt(import.meta.env.VITE_PUSHER_PORT),
    forceTLS: true,
    encrypted: true,
    enabledTransports: ['ws', 'wss'],
    disableStats: true
});

// Add debug logging
console.log('Pusher Config:', {
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    host: import.meta.env.VITE_PUSHER_HOST,
    port: import.meta.env.VITE_PUSHER_PORT
});

console.log(window.Echo.options);