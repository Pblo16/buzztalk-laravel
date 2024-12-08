import axios from 'axios';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Pusher = Pusher;  // Add this line before Echo import

import './echo';  // Ensure Echo is imported before any usage
