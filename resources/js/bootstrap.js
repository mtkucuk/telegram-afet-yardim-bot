window._ = require('lodash');


import Echo from 'laravel-echo';


/*
let json = require('./config.json');
*/


// axios ayarları
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
/*

// socket io ve echo server ayarları
window.io = require('socket.io-client')

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: json.socket_url
})*/

