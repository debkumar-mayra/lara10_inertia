<template lang="">
    <div class="col-md-4 offset-md-4" style="margin-top:90px;">
      <div  class="d-flex justify-content-center">
              <img :src="$page.props.logo" alt="" style="height: 100px; width:100px; content">
      </div>
             <div class="card">
                <div class="card-body">


                <h4 class="card-title">OTP Validations</h4>

                <form @submit.prevent="submit">
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" id="email" :value="email" class="form-control" placeholder="Email" readonly>
                      <span class="text-danger" v-if="form.errors.email">{{ form.errors.email }}</span>
                    </div>

                    
                    <div class="form-group">
                      <label for="otp">OTP</label>
                      <input type="text" id="otp" v-model="form.otp" class="form-control" placeholder="OTP" >
                      <span class="text-danger" v-if="form.errors.otp">{{ form.errors.otp }}</span>
                    </div>

                     <button type="submit" class="btn btn-primary"  :disabled="form.processing">
                        <div :class="{'spinner-border':form.processing, 'spinner-border-sm':form.processing}" role="status"></div>
                        Submit</button>

                </form>
                </div>
            </div>
    </div>


   
</template>

<script setup>
import { onMounted, reactive, ref } from 'vue'
import { useForm, usePage } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'



const form = useForm({
  email: props.email,
  otp: '',
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
  form.post(route('frontend.otpValidations'))
}
</script>
