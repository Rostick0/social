import { createApp } from 'vue';
import App from './App.vue';
import router from '@/app/router';
import VueLazyLoad from 'vue-lazyload';
import store from '@/app/store';
// import { authTokenLocal } from '@/app/store';

const app = createApp(App);

// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY ?? 'local',
//     wsHost: (import.meta.env.VITE_PUSHER_HOST ?? 'localhost'),
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 6001,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     // wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     // wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     // wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     // forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'http') === 'http',
//     forceTLS: false,
//     enabledTransports: ['ws', 'wss'],
//     auth: {
//         headers: authTokenLocal()
//     },
// });


app
    .use(router)
    .use(VueLazyLoad)
    .use(store)
    .mount('#app')