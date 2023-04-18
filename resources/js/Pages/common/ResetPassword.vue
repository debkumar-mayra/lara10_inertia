<template lang="">
    <div class="col-md-4 offset-md-4" style="margin-top:90px;">
      <div  class="d-flex justify-content-center">
               <img src="/admin_assets/logo/logo.png" alt="" style="height: 100px; width:100px; content">
      </div>
             <div class="card">
                <div class="card-body">


                <h4 class="card-title">Reset Password</h4>

                <form @submit.prevent="submit">
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" id="password" class="form-control" placeholder="Password" v-model="form.password" >
                      <span class="text-danger" v-if="form.errors.password">{{ form.errors.password }}</span>
                    </div>

                    
                    <div class="form-group">
                      <label for="confirmPassword">Confirm Password</label>
                      <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm Password" v-model="form.confirm_password">
                      <span class="text-danger" v-if="form.errors.confirm_password">{{ form.errors.confirm_password }}</span>
                    </div>

                <submit-button :isLoading="form.processing">Submit</submit-button>

                </form>
   <!-- <button @click="showModal = true">Show Modal</button> -->
                </div>
            </div>
    </div>


   
</template>

<script setup>
import { onMounted, reactive, ref } from 'vue'
import { useForm, usePage } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'
import SubmitButton from '../../components/SubmitButton.vue'



const form = useForm({
  password: '',
  confirm_password: '',
})

onMounted(()=>{
  if(usePage().props.flash.success){
    toaster.success(usePage().props.flash.success);
  }

  if(usePage().props.flash.error){
    toaster.error(usePage().props.flash.error);
  }

})

const props = defineProps({
  errors:Object,
  email:String
})

function submit() {
  form.post('/reset-password')
}
</script>
