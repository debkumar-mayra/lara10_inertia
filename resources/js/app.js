import './bootstrap';
import { createApp, h } from 'vue'
import { createInertiaApp,Link,Head, usePage } from '@inertiajs/vue3'
// import { createPinia } from 'pinia';

import PerfectScrollbar from 'vue3-perfect-scrollbar'
import 'vue3-perfect-scrollbar/dist/vue3-perfect-scrollbar.css'


import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
// const pinia = createPinia();
import { defineAsyncComponent } from 'vue'

import Toaster from './helpers/Toaster';  //--for 'globally' use
window.toaster = Toaster;

import Service from './helpers/service';  //--for 'globally' use
window.service = Service;

import SweetAlert from './helpers/SweetAlert';  //--for 'globally' use
window.sw = SweetAlert;

import emitter from 'tiny-emitter/instance'; //--for 'globally' use
window.emit = emitter;

const urlParams = new URLSearchParams(window.location.search)
window.urlParams = urlParams;

import CKEditor from '@ckeditor/ckeditor5-vue';

const AdminLayout = defineAsyncComponent(() =>
  import('./Layout/Admin/Layout.vue')
)

const FrontendLayout = defineAsyncComponent(() =>
  import('./Layout/Frontend/Layout.vue')
)

import { autoAnimatePlugin } from '@formkit/auto-animate/vue'

import { Icon } from '@iconify/vue'; // https://iconify.design/docs/icon-components/vue/

// import { MotionPlugin } from '@vueuse/motion'  // https://motion.vueuse.org/features/presets





const myPlugin = ['PerfectScrollbar'];

createInertiaApp({

  // progress: {
  //   // delay: 5,
  //   color: '#29d',
  //   includeCSS: true,
  //   showSpinner: false,
  // },


  title: title => `${title} ${usePage().props.appName}`,
  resolve: async name => {

    const pages = import.meta.glob('./Pages/**/*.vue', { eager: false })
    let page = await pages[`./Pages/${name}.vue`]()
        
    if(name.startsWith('Admin/')){
      page.default.layout = AdminLayout;
    } else if(name.startsWith('Frontend/')){
      page.default.layout = FrontendLayout;
    }

    return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      // .use(pinia)
      .use(autoAnimatePlugin)
      // .use(MotionPlugin)
      .use(PerfectScrollbar)
      .use(CKEditor)
      .use(ZiggyVue, Ziggy)
      .component('Link',Link)
      .component('Head',Head)
      .component('Icon',Icon)
      .mount(el)
  },
})