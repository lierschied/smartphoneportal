require('./bootstrap');

import {createApp, h} from 'vue';
import {createInertiaApp} from '@inertiajs/inertia-vue3';
import {InertiaProgress} from '@inertiajs/progress';
import {Quasar} from "quasar";
import mitt from 'mitt';

const emitter = mitt();
const appName = 'smp';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({el, app, props, plugin}) {
        const ca = createApp({render: () => h(app, props)});
        ca.config.globalProperties.emitter = emitter;
        ca.use(plugin)
            .use(Quasar)
            .mixin({methods: {route}})
            .mount(el);
        return ca;
    },
},);

InertiaProgress.init({color: '#4B5563',  includeCSS: true, showSpinner: true,});
