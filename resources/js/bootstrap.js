window._ = require('lodash');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    wsHost: window.location.hostname,
    wsPort: 6001,
    forceTLS: false,
    disableStats: true,
});

// Test üçün realtime reservation listener
const COMPANY_ID = 7; // dəyişəcək, real şirkət ID-si

window.Echo.private(`company.${COMPANY_ID}`)
    .listen('.ReservationCreated', (payload) => {
        console.log('Yeni rezervasiya gəldi:', payload);

        const wrapper = document.querySelector(`.reservation-wrapper[data-company-id="${payload.reservation.company_id}"] .reservation-list`);
        if (!wrapper) return;

        let status = 'Baxılmayıb';
        if (payload.reservation.status === 1) status = 'Qəbul edildi';
        else if (payload.reservation.status === 2) status = 'Qəbul edilmədi';

        const item = document.createElement('div');
        item.className = 'card mb-3 reservation-card';
        item.innerHTML = `
            <div class="card-body">
                <h5 class="card-title mb-2">🗓️ ${new Date(payload.reservation.date).toLocaleDateString()} ⏰ ${new Date(payload.reservation.date).toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'})}</h5>
                <p class="mb-1"><strong>Ad Soyad:</strong> ${payload.reservation.full_name}</p>
                <p class="mb-1"><strong>Əlaqə nömrəsi:</strong> ${payload.reservation.phone}</p>
                <p class="mb-1"><strong>Adam sayı:</strong> ${payload.reservation.person_count}</p>
                <p class="mb-0"><strong>Əlavə məlumat:</strong> ${payload.reservation.text || '-'}</p>
                <p><strong>Rezervasiya cavabı:</strong> <span class="text-muted">${payload.reservation.company_text || 'Rezervasiya cavablandırılmayıb.'}</span></p>
                <p><strong>Status:</strong> <span class="text-muted">${status}</span></p>
            </div>
        `;

        wrapper.prepend(item);
    });
