import Echo from 'laravel-echo'

window.Echo = new Echo({
  broadcaster: 'pusher',
  key: '20e31dd6a985852b03a5',
  cluster: 'us2',
  forceTLS: true
});


// Agregar logs para debugging
window.Echo.connector.pusher.connection.bind('connected', () => {
    console.log('Connected to Pusher!');
});

window.Echo.connector.pusher.connection.bind('error', (err) => {
    console.error('Pusher connection error:', err);
    // Attempt to reconnect
    window.Echo.connector.pusher.connect();
});

console.log(window.Echo.options);
