require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { autoAnimatePlugin } from '@formkit/auto-animate/vue'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

var time = 0

const startSessionTimer = setInterval(() => {
    time++
    if (time >= 900000) {
        window.location.href = '/';
        clearInterval(startSessionTimer)
    }
}, 1000);

function resetSessionTimer() {
    time = 0
}


createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin, autoAnimatePlugin)
            .mixin({
                methods: { route },
                mounted() {
                    window.addEventListener('mousemove', resetSessionTimer);
                    window.addEventListener('mousedown', resetSessionTimer);
                    window.addEventListener('keypress', resetSessionTimer);
                    window.addEventListener('touchmove', resetSessionTimer);
                    window.addEventListener('scroll', resetSessionTimer);
                },
                beforeUnmount() {
                    window.removeEventListener('mousemove', resetSessionTimer);
                    window.removeEventListener('mousedown', resetSessionTimer);
                    window.removeEventListener('keypress', resetSessionTimer);
                    window.removeEventListener('touchmove', resetSessionTimer);
                    window.removeEventListener('scroll', resetSessionTimer);
                },
            })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
