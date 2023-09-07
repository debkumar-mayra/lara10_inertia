<template lang="">
    <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

<!-- begin:: Header Menu -->
<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
    <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
        <ul class="kt-menu__nav ">
            <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel kt-menu__item--active"
                data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;"
                    class="kt-menu__link kt-menu__toggle"><span
                        class="kt-menu__link-text">{{title}}</span></a>
            </li>
        </ul>
    </div>
</div>
<!-- end:: Header Menu -->

<!-- begin:: Header Topbar -->
<div class="kt-header__topbar">
    <!--begin: Quick Actions -->
    <div class="kt-header__topbar-item dropdown">
        <div
            class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
            <form>
                <!--begin: Head -->
                <div class="kt-head kt-head--skin-dark"
                    style="background-image:admin_assets/media/misc/bg-1.jpg">
                    <h3 class="kt-head__title">
                        User Quick Actions
                        <span class="kt-space-15"></span>
                        <span class="btn btn-success btn-sm btn-bold btn-font-md">23 tasks pending</span>
                    </h3>
                </div>
                <!--end: Head -->
            </form>
        </div>
    </div>

    <!--begin: User Bar -->
    <div class="kt-header__topbar-item kt-header__topbar-item--user">
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
            <div class="kt-header__topbar-user">
                <span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
                <span
                    class="kt-header__topbar-username kt-hidden-mobile">{{$page.props.auth.user.full_name}}</span>
                <img class="" alt="Pic"
                    :src="$page.props.auth.user?.profile_photo" />

                <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                <span
                    class=" kt-hidden kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold"></span>
            </div>
        </div>
        <div
            class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

            <!--begin: Head -->
            <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x"
                style="background-image:admin_assets/media/misc/bg-1.jpg">
                <div class="kt-user-card__avatar">
                    <img class="" alt="Pic" :src="$page.props.auth.user?.profile_photo" />

                    <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                    <span
                        class="kt-hidden kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success ">AA</span>
                </div>
                <div class="kt-user-card__name">
                    {{$page.props.auth.user.full_name}}
                </div>
                <!-- <div class="kt-user-card__badge">
                    <span class="btn btn-success btn-sm btn-bold btn-font-md">23 messages</span>
                </div> -->
            </div>

            <!--end: Head -->

            <!--begin: Navigation -->
            <div class="kt-notification">
                <!-- <a href="#" class="kt-notification__item"> -->
                    <Link :href="route('admin.profile')" class="kt-notification__item">
                    <div class="kt-notification__item-icon">
                        <i class="flaticon2-calendar-3 kt-font-success"></i>
                    </div>
                    <div class="kt-notification__item-details">
                        <div class="kt-notification__item-title kt-font-bold">
                            My Profile
                        </div>
                       <div class="kt-notification__item-time">
                            Change Password
                        </div>
                    </div>
                    </Link>
                <!-- </a> -->
                <div class="kt-notification__custom">
                    
                    <Link :href="route('admin.logout')" class="btn btn-label-brand btn-sm btn-bold" method="post" as="button" type="button">Sign Out</Link>
                </div>
            </div>
            <!--end: Navigation -->
        </div>
    </div>
    <!--end: User Bar -->
</div>
<!-- end:: Header Topbar -->
</div>
</template>


<script setup>
import { computed, ref } from 'vue'
import { usePage } from '@inertiajs/vue3'
import { onMounted } from "vue";

const title = ref('');
onMounted( ()=>{
       emit.on('pageName', function (arg1) {
            title.value = arg1;
        });
} )


const user = computed(() => usePage().props.auth.user)
// console.log(user.value.email);
</script>
<style lang="">
    
</style>