<template lang="">
    <div class="col-md-4 offset-md-4" style="margin-top:90px;">
      <div  class="d-flex justify-content-center">
               <img :src="$page.props.logo" alt="" style="height: 100px; width:100px; content">
      </div>
             <div class="card">
                <div class="card-body">


                <h4 class="card-title">Admin Login</h4>

                <form @submit.prevent="submit">
                    <div class="form-group">
                      <label for="email">Email <span class="text-danger">*</span></label>
                      <input type="email" id="email" v-model="form.email" class="form-control" placeholder="Email" >
                      <span class="text-danger" v-if="form.errors.email">{{ form.errors.email }}</span>
                    </div>

                    <!-- <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" id="password" v-model="form.password" class="form-control" placeholder="Password">
                      <span class="text-danger" v-if="form.errors.password">{{ form.errors.password }}</span>
                    </div> -->

                    <div class="form-group">
                    <label for="password">Password <span class="text-danger">*</span></label>
                    <div class="password_box">  
                        <input :type="showNewPassword ? 'text' : 'password'" id="password" v-model="form.password" class="form-control border-gray-200" placeholder="New Password">
                        <div class="control">                        
                            <span class="icon is-small is-right">
                                <i @click="showNewPassword = !showNewPassword" class="fas" :class="{ 'fa-eye-slash': showNewPassword, 'fa-eye': !showNewPassword }"></i>
                            </span>
                        </div>
                    </div>
                    <span class="text-danger" v-if="form.errors.password">{{ form.errors.password }}</span>
               </div>


                    <!-- <button type="submit" class="btn btn-primary"  :disabled="form.processing">Login</button> -->
  <submit-button :isLoading="form.processing" class="btn btn-primary" >Login</submit-button>
  <div>
        <Link :href="route('frontend.forgotPassword')" class="float-right">Forgot Password</Link>
  </div>

                </form>
   <!-- <button @click="showModal = true">Show Modal</button> -->
                </div>
            </div>
    </div>



        <!-- <teleport to="#modal">
          <main-modal v-show="showModal" :saveBtn=true @close="showModal = false" @submit="submit" >
            <template v-slot:modal-header>Model Title</template>
            <template v-slot:modal-body>
                <h1>test</h1>
            </template>
          </main-modal>
        </teleport> -->
   
</template>

<script setup>
// import MainModal from "../../components/MainModal.vue";
// const showModal = ref(false);
import { reactive, ref, onMounted } from 'vue'
import { useForm, usePage } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'
import SubmitButton from '../../components/SubmitButton.vue'


const showNewPassword = ref(false);

const form = useForm({
  email: null,
  password: null,
})

const props = defineProps({
  errors:Object
})

onMounted(()=>{
  if(usePage().props.flash.success){
    toaster.success(usePage().props.flash.success);
  }

  if(usePage().props.flash.error){
    toaster.error(usePage().props.flash.error);
  }

})

function submit() {
  form.post('/admin/login')
}
</script>

<style scoped>
/* @import '/public/admin_assets/custom.css'; */
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
