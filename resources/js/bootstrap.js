window._ = require("lodash");

try {
    window.$ = window.jQuery = require("jquery");
    require("jquery.easing");
    
    // Supaya plugin bootstrap-selectnya bisa jalan harus disimpan ke dalam window.bootstrap
    window.bootstrap = require("bootstrap/dist/js/bootstrap.bundle");
    require("datatables.net-buttons-bs5");
    require("datatables.net-buttons/js/buttons.html5.js");
    require("datatables.net-buttons/js/buttons.print.js");
    require("datatables.net-responsive-bs5");
    require("datatables.net-select-bs5");
    // require("select2");
    require("bootstrap-select/dist/js/bootstrap-select.min.js");
    require("bootstrap-input-spinner/src/bootstrap-input-spinner.js")
    require("./script");
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require("axios");

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
