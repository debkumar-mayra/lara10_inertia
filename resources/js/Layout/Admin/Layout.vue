<template lang="">
<loading :active="isLoading" :can-cancel="true" :is-full-page="true" :loader="'dots'"/>

<div class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed " :class="menuHideShow ? 'kt-aside--minimize':''">


<!-- begin:: Page -->
<!-- <x-admin-mobile-header /> -->
<mobile-nav/>
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        
        <!-- <x-admin-left-bar /> -->
        <Nav/>

        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
            <!-- <x-admin-header :title="$title" /> -->
          <Header/>
          
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
                <!-- {{ $subHeader }} -->
                <sub-header/>

                 <!-- <div v-if="$page.props.flash.success" class="alert">
        {{ $page.props.flash.success }}
      </div> -->
                <!-- begin:: Content -->
                <div class="kt-content  kt-grid__item kt-grid__item--fluid">
                    <!-- {{ $slot }} -->

                      <!-- <div v-if="$page.props.flash.success" class="alert">
        {{ $page.props.flash.success }}
      </div> -->

                    <slot/>
                </div>
                <!-- end:: Content -->
            </div>
            <!-- <x-admin-footer /> -->
            <Footer/>

        </div>
    </div>
</div>
<!-- end:: Page -->
<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>
<!-- end::Scrolltop -->


</div>


    <!-- <div>
        <div class="container-fluid">
            <Nav/>
            <slot/>
            <Footer/>
        </div>
    </div> -->
</template>
<script setup>
// import '/public/admin_assets/vendors/general/popper.js/dist/umd/popper.min.js';
import '/public/admin_assets/vendors/general/bootstrap/dist/js/bootstrap.min.js';
// import '/public/admin_assets/vendors/general/tooltip.js/dist/umd/tooltip.min.js';
// import '/public/admin_assets/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.min.js';
// import '/public/admin_assets/vendors/general/sticky-js/dist/sticky.min.js';
// import '/public/admin_assets/demo/default/base/scripts.bundle.min.js';
// import '/public/admin_assets/app/bundle/app.bundle.min.js';
// import '/public/admin_assets/custom/js/custom.js';




import Nav from './Nav.vue';
import Footer from './Footer.vue';
import Header from './Header.vue';
import SubHeader from './SubHeader.vue';
import MobileNav from './MobileNav.vue';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';
import { computed, onBeforeMount, onBeforeUpdate, onMounted,onUnmounted,onUpdated,ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import NProgress from 'nprogress'
import { router } from '@inertiajs/vue3'

const isLoading = ref(false);
const menuHideShow = ref(false);

  router.on('start', () => {
    isLoading.value = true;
    })

    router.on('finish', () => {
    isLoading.value = false;
    if(usePage().props.flash.success){
        toaster.success(usePage().props.flash.success)
    }

    if(usePage().props.flash.error){
        toaster.error(usePage().props.flash.error)
    }
    if(usePage().props.flash.warning){
        toaster.warning(usePage().props.flash.warning)
    }

    if(usePage().props.flash.info){
        toaster.info(usePage().props.flash.info)
    }
    })

    const flash = computed(()=>{
        return usePage().props.flash;
    });


onMounted(() => {
    emit.on('toggleSideMenu', function (arg1) {
        menuHideShow.value = arg1;
    });
    
})


</script>

<style>



/* @import '../../assets/admin_asset/css/style.css';
@import '../../assets/admin_asset/css/skins/header/base/light.css';
@import '../../assets/admin_asset/css/skins/header/menu/light.css';
@import '../../assets/admin_asset/css/skins/brand/dark.css'; */


@import '/public/admin_assets/vendors/general/perfect-scrollbar/css/perfect-scrollbar.min.rtl.css';
@import '/public/admin_assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.min.css';
@import '/public/admin_assets/vendors/general/socicon/css/socicon.css';
@import '/public/admin_assets/vendors/custom/vendors/line-awesome/css/line-awesome.css';
@import '/public/admin_assets/vendors/custom/vendors/flaticon/flaticon.css';
@import '/public/admin_assets/vendors/custom/vendors/flaticon2/flaticon.css';
@import '/public/admin_assets/vendors/custom/vendors/fontawesome5/css/all.min.css';
@import '/public/admin_assets/demo/default/base/style.bundle.min.css';
@import '/public/admin_assets/demo/default/skins/header/base/light.css';
@import '/public/admin_assets/demo/default/skins/header/menu/light.css';
@import '/public/admin_assets/demo/default/skins/brand/dark.css';
@import '/public/admin_assets/demo/default/skins/aside/dark.css';
@import '/public/admin_assets/vendors/custom/datatables/datatables.bundle.css';
@import '/public/admin_assets/custom.css';

/* @import '../../assets/admin_asset/js/bundle/app.bundle.js'; */
/* @import './css/style.css'; */

</style>