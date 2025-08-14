window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

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
//
// import Echo from 'laravel-echo';
// window.Pusher = require('pusher-js');
//
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'laravel-key', // .env-dəki PUSHER_APP_KEY ilə eyni olmalı
//     wsHost: window.location.hostname,
//     wsPort: 6001,
//     forceTLS: false,
//     disableStats: true,
// });
//
// // Rezervasiyaları realtime əlavə et
// window.Echo.channel('reservations')
//     .listen('.ReservationCreated', (payload) => {
//         const feed = document.getElementById('reservation-feed');
//         if (!feed) return;
//
//         // Statusu JS-də təyin edirik
//         let status = 'Baxılmayıb';
//         if (payload.status === 1) {
//             status = 'Qəbul edildi';
//         } else if (payload.status === 2) {
//             status = 'Qəbul edilmədi';
//         }
//
//         const item = document.createElement('div');
//         item.className = 'card mb-3 reservation-card'; // Bootstrap Card və spacing
//         item.innerHTML = `
//             <div class="card-body">
//                 <h5 class="card-title mb-2">🗓️ ${new Date(payload.date).toLocaleDateString()} ⏰ ${new Date(payload.date).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</h5>
//                 <p class="mb-1"><strong>Ad Soyad:</strong> ${payload.full_name}</p>
//                 <p class="mb-1"><strong>Əlaqə nömrəsi:</strong> ${payload.phone}</p>
//                 <p class="mb-1"><strong>Adam sayı:</strong> ${payload.person_count}</p>
//                 <p class="mb-0"><strong>Əlavə məlumat:</strong> ${payload.text || '-'}</p>
//                 <p><strong>Rezervasiya cavabı:</strong> <span class="text-muted">${payload.company_text || 'Rezervasiya cavablandırılmayıb.'}</span></p>
//                 <p><strong>Status:</strong> <span class="text-muted">${status}</span></p>
//             </div>
//         `;
//
//         // Yeni gələn reservation-i yuxarı əlavə et
//         feed.prepend(item);
//     });

