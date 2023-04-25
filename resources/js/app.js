import './bootstrap';
import { createApp, h } from 'vue'
import { createInertiaApp,Link,Head } from '@inertiajs/vue3'
// import FrontendLayout from './Layout/Frontend/Layout.vue';
// const FrontendLayout = () => import('./Layout/Frontend/Layout.vue')
// import AdminLayout from './Layout/Admin/Layout.vue';
import { createPinia } from 'pinia';

import PerfectScrollbar from 'vue3-perfect-scrollbar'
import 'vue3-perfect-scrollbar/dist/vue3-perfect-scrollbar.css'


import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
const pinia = createPinia();
import { defineAsyncComponent } from 'vue'

import Toaster from './helpers/Toaster';  //--for 'globally' use
window.toaster = Toaster;

import Service from './helpers/service';  //--for 'globally' use
window.service = Service;

import SweetAlert from './helpers/SweetAlert';  //--for 'globally' use
window.sw = SweetAlert;

import emitter from 'tiny-emitter/instance';
window.emit = emitter;

const AdminLayout = defineAsyncComponent(() =>
  import('./Layout/Admin/Layout.vue')
)

const FrontendLayout = defineAsyncComponent(() =>
  import('./Layout/Frontend/Layout.vue')
)

createInertiaApp({

  // progress: {
  //   // delay: 5,
  //   color: '#29d',
  //   includeCSS: true,
  //   showSpinner: false,
  // },


  title: title => `${title} - My App`,
  resolve: async name => {

    const pages = import.meta.glob('./Pages/**/*.vue', { eager: false })
    let page = await pages[`./Pages/${name}.vue`]()
        
    if(name.startsWith('Admin/')){
      page.default.layout = AdminLayout;
      // page.default.layout = './Layout/Admin/Layout.vue';
    //   page.default.layout = defineAsyncComponent(() =>
    //   import('./Layout/Admin/Layout.vue')
    // );
    } else if(name.startsWith('Frontend/')){

      page.default.layout = FrontendLayout;
    //   page.default.layout = defineAsyncComponent(() =>
    //   import('./Layout/Frontend/Layout.vue')
    // );
      
    }

    return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(pinia)
      .use(PerfectScrollbar)
      .use(ZiggyVue, Ziggy)
      .component('Link',Link)
      .component('Head',Head)
      .mount(el)
  },
})