import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '20e31dd6a985852b03a5',
    cluster: 'us2',
    forceTLS: true,
    encrypted: true,
    enabledTransports: ['ws', 'wss'],
});

console.log(window.Echo.options);