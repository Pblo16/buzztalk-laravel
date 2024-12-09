import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER, // Make sure the cluster is set
    forceTLS: true,
    encrypted: true,
    enabledTransports: ['ws', 'wss'],
});

console.log(window.Echo.options);