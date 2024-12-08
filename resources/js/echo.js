import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    wsHost: import.meta.env.VITE_PUSHER_HOST || `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
    wsPort: import.meta.env.VITE_PUSHER_PORT || 443,
    forceTLS: true,
    encrypted: true,
    disableStats: true,
    enabledTransports: ['ws', 'wss'],
    auth: {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    }
});

// Add enhanced error handling
window.Echo.connector.pusher.connection.bind('state_change', states => {
    console.log('Pusher state changed:', states);
});

window.Echo.connector.pusher.connection.bind('connected', () => {
    console.log('Successfully connected to Pusher');
});

window.Echo.connector.pusher.connection.bind('error', error => {
    console.error('Pusher connection error:', error);
    if (error.error.data?.code === 4004) {
        console.log('Attempting to reconnect...');
        window.Echo.connector.pusher.connect();
    }
});
