window._ = require('lodash');

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
    require('toastr');
} catch ( e ) {
}

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Echo from 'laravel-echo';

window.io = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'socket.io', host: '127.0.0.1:9003'
});

window.Echo.connector.socket.on('connect', function () {
    console.log('socket connected: ' + window.Echo.socketId());
})

window.Echo.connector.socket.on('disconnect', function () {
    console.log('socket disconnected');
})
// window.Pusher = require('pusher-js');

/*window.Echo = new Echo({
    broadcaster: 'socket',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true
});*/
