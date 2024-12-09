import axios from 'axios';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Import Echo after window.Pusher is defined
import Pusher from 'pusher-js';
window.Pusher = Pusher;

import './echo';
