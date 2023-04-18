<template lang="">
    <div class="col-md-4 offset-md-4" style="margin-top:90px;">
      <div  class="d-flex justify-content-center">
               <img src="/admin_assets/logo/logo.png" alt="" style="height: 100px; width:100px; content">
      </div>
             <div class="card">
                <div class="card-body">


                <h4 class="card-title">Admin Login</h4>

                <form @submit.prevent="submit">
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" id="email" v-model="form.email" class="form-control" placeholder="Email" >
                      <span class="text-danger" v-if="form.errors.email">{{ form.errors.email }}</span>
                    </div>

                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" id="password" v-model="form.password" class="form-control" placeholder="Password">
                      <span class="text-danger" v-if="form.errors.password">{{ form.errors.password }}</span>
                    </div>


                    <!-- <button type="submit" class="btn btn-primary"  :disabled="form.processing">Login</button> -->
  <submit-button :isLoading="form.processing">Login</submit-button>
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
import { reactive, ref } from 'vue'
import { useForm, usePage } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'
import SubmitButton from '../../components/SubmitButton.vue'



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
