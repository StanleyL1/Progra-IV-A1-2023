import 'bootstrap';

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Importa las bibliotecas necesarias para el uso de Laravel Echo con Socket.IO
import Echo from 'laravel-echo';

window.io = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':3000'
});
