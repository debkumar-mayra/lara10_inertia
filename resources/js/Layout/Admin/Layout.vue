<template lang="">
<div>
<!-- <loading :active="isLoading" :can-cancel="true" :is-full-page="true" :loader="'dots'"/> -->

<!-- kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--minimize kt-header__topbar--mobile-on -->
    <div class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed " :class="{ 'kt-aside--minimize': menuHideShow, 'kt-aside--on': mobileMenuHideShow, 'kt-header__topbar--mobile-on':mobileProfileMenuHideShow }" >



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
            <!-- {{theme.mainColor}} -->
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
    </div>

</template>
<script setup>
import '/public/admin_assets/vendors/general/bootstrap/dist/js/bootstrap.min.js';

// import '/public/admin_assets/vendors/general/popper.js/dist/umd/popper.min.js';
// import '/public/admin_assets/vendors/general/tooltip.js/dist/umd/tooltip.min.js';
// import '/public/admin_assets/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.min.js';
// import '/public/admin_assets/vendors/general/sticky-js/dist/sticky.min.js';
// import '/public/admin_assets/demo/default/base/scripts.bundle.min.js';
// import '/public/admin_assets/app/bundle/app.bundle.min.js';
// import '/public/admin_assets/custom/js/custom.js';

import { loadScript } from "vue-plugin-load-script";
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
loadScript('https://cdn.jsdelivr.net/npm/sweetalert2@11');

const isLoading = ref(false);
const menuHideShow = ref(false);
const mobileMenuHideShow = ref(false);
const mobileProfileMenuHideShow = ref(false);

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



const mainColor = computed(() => usePage().props.theme.mainColor)
const hoverColor = computed(() => usePage().props.theme.hoverColor)
const buttonColor = computed(() => usePage().props.theme.buttonColor)

onMounted(() => {
    
    emit.on('toggleSideMenu', function (arg1) {
        menuHideShow.value = arg1;
    });

    emit.on('toggleMobileMenu', function (arg1) {
        mobileMenuHideShow.value = arg1;
    });
    emit.on('toggleProfileMobileMenu', function (arg1) {
        mobileProfileMenuHideShow.value = arg1;
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


 .kt-aside__brand {
    background-color: v-bind(mainColor);
}

.kt-aside-menu {
    background-color: v-bind(mainColor);
}

.kt-aside-menu .kt-menu__nav {
    padding: 0 !important;
}

.kt-aside .kt-aside-menu {
    margin: 0 !important;
}

.kt-aside-menu .kt-menu__nav>.kt-menu__item.kt-menu__item--active>.kt-menu__link {
    background-color: v-bind(hoverColor);
}

.kt-aside-menu .kt-menu__nav>.kt-menu__section .kt-menu__section-text {
    color: #fff;
}

.kt-aside-menu .kt-menu__nav>.kt-menu__item.kt-menu__item--active>.kt-menu__heading .kt-menu__link-icon,
.kt-aside-menu .kt-menu__nav>.kt-menu__item.kt-menu__item--active>.kt-menu__link .kt-menu__link-icon {
    color: #ffffff !important;
}

.kt-aside-menu .kt-menu__nav>.kt-menu__item:not(.kt-menu__item--parent):not(.kt-menu__item--open):not(.kt-menu__item--here):not(.kt-menu__item--active):hover>.kt-menu__heading,
.kt-aside-menu .kt-menu__nav>.kt-menu__item:not(.kt-menu__item--parent):not(.kt-menu__item--open):not(.kt-menu__item--here):not(.kt-menu__item--active):hover>.kt-menu__link {
    background-color: v-bind(hoverColor);
}

.kt-aside-menu .kt-menu__nav>.kt-menu__item:not(.kt-menu__item--parent):not(.kt-menu__item--open):not(.kt-menu__item--here):not(.kt-menu__item--active):hover>.kt-menu__heading .kt-menu__link-icon,
.kt-aside-menu .kt-menu__nav>.kt-menu__item:not(.kt-menu__item--parent):not(.kt-menu__item--open):not(.kt-menu__item--here):not(.kt-menu__item--active):hover>.kt-menu__link .kt-menu__link-icon {
    color: #fff;
}

.kt-aside-menu .kt-menu__nav>.kt-menu__item>.kt-menu__heading .kt-menu__link-icon,
.kt-aside-menu .kt-menu__nav>.kt-menu__item>.kt-menu__link .kt-menu__link-icon {
    color: #fff;
}

.kt-notification-item-padding-x {
    background: v-bind(mainColor) !important;
}

.btn-success {
    color: #fff;
    background-color: v-bind(mainColor);
    border-color: v-bind(mainColor);
}

.btn-secondary {
    /* color: #fff;
    background-color: v-bind(hoverColor);
    border-color: v-bind(hoverColor); */
    background-color: transparent !important;
    border: 1px solid #ebedf2 !important;
    color: #6c7293 !important;
}

.btn-secondary:hover {
    background-color: #e4e4e4 !important;
    color: #fff !important;
}

.btn-primary {
    color: #fff;
    background-color: v-bind(mainColor) !important;
    border-color: v-bind(mainColor);
}

.btn-button {
    color: #fff;
    background-color: v-bind(buttonColor) !important;
    border-color: v-bind(mainColor);
}

.btn-button:hover {
    color: #fff !important;
    background-color: v-bind(hoverColor) !important;
    border-color: v-bind(hoverColor) ;
}

.btn-primary:hover {
    border-color: v-bind(hoverColor);
}



.btn-brand {
    color: #fff;
    background-color: v-bind(mainColor);
    border-color: v-bind(mainColor);
}

.btn-brand:not(:disabled):not(.disabled):active,
.btn-brand:not(:disabled):not(.disabled).active,
.show>.btn-brand.dropdown-toggle {
    color: #fff;
    background-color: v-bind(mainColor);
    border-color: v-bind(mainColor);
}

.btn-brand:hover {
    color: #fff !important;
    background-color: v-bind(hoverColor);
    border-color: v-bind(hoverColor);
}

.page-item.active .page-link {
    color: #fff;
    background-color: v-bind(hoverColor);
    border-color: v-bind(hoverColor);
}

.page-link:hover {
    color: v-bind(hoverColor);
}

.page-link {
    color: v-bind(mainColor);
}

.btn.btn-label-brand {
    background-color: rgb(8 9 20);
    color: #fff;
    cursor: text !important;
}

a.btn.btn-label-brand:focus,
a.btn.btn-label-brand:hover,
a.btn.btn-label-brand.active,
button.btn.btn-label-brand:focus,
button.btn.btn-label-brand:hover,
button.btn.btn-label-brand.active,
input.btn.btn-label-brand:focus,
input.btn.btn-label-brand:hover,
input.btn.btn-label-brand.active {
    background-color: v-bind(hoverColor);
    color: #fff !important;
    border-color: v-bind(hoverColor);
}

.btn-success {
    color: #fff;
    background-color: v-bind(mainColor) !important;
    border-color: v-bind(mainColor);
}

.btn-success:hover {
    color: #fff;
    background-color: v-bind(hoverColor) !important;
    border-color: v-bind(hoverColor);
}

.min-h-screen button {
    color: #fff;
    background-color: v-bind(mainColor);
    border-color: v-bind(mainColor);
}

.min-h-screen button:hover {
    color: #fff;
    background-color: v-bind(hoverColor);
    border-color: v-bind(hoverColor);
}

.min-h-screen {
    background-color: v-bind(mainColor);
}

.kt-header-mobile {
    background-color: v-bind(mainColor) !important;
}


.btn-primary:hover {
    background-color: v-bind(hoverColor);
    color: #fff !important;
}

.kt-scrolltop {
    background: v-bind(hoverColor);
}

.kt-content button {
    background-color: v-bind(buttonColor);
    border-color: v-bind(buttonColor);
}

.kt-content button:hover {
    background: v-bind(hoverColor);
}

a:hover {
    color: v-bind(hoverColor) !important;
}

.kt-notification .kt-notification__item .kt-notification__item-details .kt-notification__item-title:hover {
    color: v-bind(hoverColor) !important;
}

.kt-notification .kt-notification__item .kt-notification__item-details .kt-notification__item-title:active {
    color: v-bind(hoverColor) !important;
}

.kt-header .kt-header-menu .kt-menu__nav>.kt-menu__item.kt-menu__item--active>.kt-menu__link .kt-menu__link-text {
    color: v-bind(hoverColor) !important;
}

.kt-aside-close i {
    color: v-bind(hoverColor) !important;
}

.kt-aside-menu .kt-menu__nav>.kt-menu__item>.kt-menu__link .kt-menu__link-icon {
    color: #fff;
}

.kt-aside--minimize .kt-aside-menu .kt-menu__nav>.kt-menu__item>.kt-menu__link>.kt-menu__link-icon {
    color: #fff;
}

.kt-aside-menu .kt-menu__nav>.kt-menu__section .kt-menu__section-icon {
    color: #ffffff;
}

.kt-font-success {
    color: v-bind(hoverColor) !important;
}

.page-item button {
    color: #fff;
    background-color: #fff;
    border-color: #eee;
}

.page-item button:hover {
    color: #fff !important;
    background-color: v-bind(hoverColor);
    border-color: #eee;
}

.dropdown-item.active,
.dropdown-item:active {
    color: #fff;
    text-decoration: none;
    background-color: v-bind(hoverColor);
}


.dropdown-menu>li>a>i,
.dropdown-menu>.dropdown-item:hover>i {
    color: #fff;
}

.dropdown .dropdown-menu .dropdown-item {
    background-color: transparent;
}

.dropdown-item:hover,
.dropdown-item:focus {
    color: #fff !important;
    text-decoration: none;
    background-color: v-bind(hoverColor) !important;
}

.kt-aside {
    background-color: v-bind(mainColor);
}

.table-responsive thead tr th .row {
    flex-wrap: unset !important;
}

.kt-aside__brand-aside-toggler .kt-svg-icon {
    filter: invert(1);
}

.sm\:w-full {
    margin-top: 250px;
}

.kt-aside-menu .kt-menu__nav>.kt-menu__item>.kt-menu__heading .kt-menu__link-text,
.kt-aside-menu .kt-menu__nav>.kt-menu__item>.kt-menu__link .kt-menu__link-text {
    color: #fff;
}

/* start media query */
@media (max-width:767px) {
    .kt-header-menu-wrapper-close>i {
        color: v-bind(hoverColor);
    }

    .kt-header-menu-wrapper {
        background: v-bind(mainColor);
    }

    .kt-header-mobile .kt-header-mobile__toolbar .kt-header-mobile__topbar-toggler.kt-header-mobile__topbar-toggler--active i,
    .kt-header-mobile .kt-header-mobile__toolbar .kt-header-mobile__topbar-toggler:hover i {
        color: v-bind(hoverColor);
    }

    .kt-header-menu-mobile {
        background-color: v-bind(mainColor);
    }

    .kt-aside-menu .kt-menu__nav {
        padding: 40px 0;
    }

    .kt-header-menu-mobile .kt-menu__nav>.kt-menu__item.kt-menu__item--active>.kt-menu__heading,
    .kt-header-menu-mobile .kt-menu__nav>.kt-menu__item.kt-menu__item--active>.kt-menu__link {
        background-color: v-bind(hoverColor);
    }

    .kt-header .kt-header-menu .kt-menu__nav>.kt-menu__item.kt-menu__item--active>.kt-menu__link .kt-menu__link-text {
        color: #ffffff !important;
    }

    .kt-header-menu-mobile .kt-menu__nav {
        padding: 40px 0 40px 0;
    }

    .kt-header-menu-wrapper--on .kt-header-menu-wrapper-close {
        background: #ffffff38;
    }
}

@media (min-width: 1025px) {
    .kt-aside--minimize .kt-aside-menu .kt-menu__nav>.kt-menu__item>.kt-menu__link>.kt-menu__link-icon {
        color: #fff;
    }
}


.form-control.is-invalid {
    background-image: none !important;
}

.is-invalid {
    border-color: #fd397a !important;
}

.logo_text_custom {
    text-decoration: none;
    color: #fff;
    font-size: 20px;
}

.label-required:after {
    content: "*";
    color: red;
}

.align-center {
    text-align: center;
}

.wizard__box {
    margin: 10px;
}



/* 20.04.23 start  */

.kt-menu__item .kt-menu__link:hover .kt-menu__link-icon,
.kt-aside-menu .kt-menu__nav>.kt-menu__item.kt-menu__item--active .kt-menu__link .kt-menu__link-icon {
    color: #fff !important;
}
.kt-content button:hover {
    background: v-bind(hoverColor) !important;
    color: #fff;
}
.kt-aside-menu .kt-menu__nav>.kt-menu__item>.kt-menu__link {
    transition: .5s all;
}

.page-link {
    color: v-bind(mainColor);
    transition: .5s all;
}
.btn.btn-label-brand {
    color: #fff;
}
.form-filter {
    border: 1px solid rgba(0, 0, 0, 0.1);
}
.form-filter:focus,
  .form-filter:focus-visible {
      border-color: v-bind(hoverColor);
      box-shadow: none;
      outline: none;
  }
  .kt-content .table-checkable .button-fx:hover {
    color: #fff !important;
  }


/* update start RN 21-04-2023 */
.password_box{
    position: relative;
}
.password_box .control{
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    max-width: 15px;
}
.password_box input[type="password"], .password_box input[type="text"]{
    padding-right: 30px;
}
.table_fixed_width{
    min-height: 400px;
}
.no_data{
    margin: 50px 0 20px;
}

</style>