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


                    <button type="submit" class="btn btn-primary"  :disabled="form.processing">
                        <div :class="{'spinner-border':form.processing, 'spinner-border-sm':form.processing}" role="status"></div>
                        Login</button>
    <div>
        <Link :href="route('frontend.forgotPassword')" class="float-right">Forgot Password</Link>
  </div>

                </form>
                </div>
            </div>
    </div>


   
</template>

<script setup>
import { reactive, ref, onMounted, computed } from 'vue'
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
  form.post(route('admin.login'))
}

const mainColor = computed(() => usePage().props.theme.mainColor)
const hoverColor = computed(() => usePage().props.theme.hoverColor)
const buttonColor = computed(() => usePage().props.theme.buttonColor)

</script>

<style scoped>

.btn-primary {
    color: #fff !important;
    background-color: v-bind(mainColor) !important; 
    border-color: #007bff !important;
}
.btn .btn-primary :hover {
    color: #fff !important;
    background-color: v-bind(hoverColor) !important; 
}

.btn-sm {
    padding: 0.25rem 0.5rem !important;
    font-size: .875rem !important;
    line-height: 1.5 !important;
    border-radius: 0.2rem !important;
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
