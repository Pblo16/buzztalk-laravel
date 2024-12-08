import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    encrypted: true,
    forceTLS: true,
    // Asegúrate de que las solicitudes de autenticación usen HTTPS en producción
    authorizer: (channel, options) => {
        return {
            authorize: (socketId, callback) => {
                fetch('/broadcasting/auth', {
                    method: 'POST',
                    body: JSON.stringify({
                        socket_id: socketId,
                        channel_name: channel.name
                    }),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    credentials: 'same-origin',
                })
                .then(response => response.json())
                .then(response => {
                    callback(false, response);
                })
                .catch(error => {
                    callback(true, error);
                });
            }
        };
    }
});