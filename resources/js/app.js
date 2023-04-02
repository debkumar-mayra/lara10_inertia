import './bootstrap';
import { createApp, h } from 'vue'
import { createInertiaApp,Link } from '@inertiajs/vue3'
import FrontendLayout from './Layout/Frontend/Layout.vue';
// const FrontendLayout = () => import('./Layout/Frontend/Layout.vue')
import AdminLayout from './Layout/Admin/Layout.vue';
import { createPinia } from 'pinia';
const pinia = createPinia();
import { defineAsyncComponent } from 'vue'

import Toaster from './helpers/Toaster';  //--for 'globally' use
window.toaster = Toaster;

import Service from './helpers/service';  //--for 'globally' use
window.service = Service;

import SweetAlert from './helpers/SweetAlert';  //--for 'globally' use
window.sw = SweetAlert;

// import VueSweetalert2 from 'vue-sweetalert2';
// import 'sweetalert2/dist/sweetalert2.min.css';



createInertiaApp({

  progress: {
    // delay: 5,
    color: '#29d',
    includeCSS: true,
    showSpinner: false,
  },


  title: title => `${title} - My App`,
  resolve: async name => {

    const pages = import.meta.glob('./Pages/**/*.vue', { eager: false })
    let page = await pages[`./Pages/${name}.vue`]()
        
    if(name.startsWith('Admin/')){
      page.default.layout = AdminLayout;
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
      // .use(VueSweetalert2)
      .component('Link',Link)
      .mount(el)
  },
})