<template lang="">

<div class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--minimize">

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
                <!-- begin:: Content -->
                <div class="kt-content  kt-grid__item kt-grid__item--fluid">
                    <!-- {{ $slot }} -->
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
import Nav from './Nav.vue';
import Footer from './Footer.vue';
import Header from './Header.vue';
import SubHeader from './SubHeader.vue';
import MobileNav from './MobileNav.vue';
</script>

<style>

@import '../../assets/admin_asset/css/style.css';
@import '../../assets/admin_asset/css/skins/header/base/light.css';
@import '../../assets/admin_asset/css/skins/header/menu/light.css';
@import '../../assets/admin_asset/css/skins/brand/dark.css';
@import '../../assets/admin_asset/css/skins/aside/dark.css';
/* @import '../../assets/admin_asset/js/bundle/app.bundle.js'; */
/* @import './css/style.css'; */

</style>