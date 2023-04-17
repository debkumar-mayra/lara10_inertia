<template lang="">
    <div class="col-md-4 offset-md-4" style="margin-top:90px;">
      <div  class="d-flex justify-content-center">
               <img src="/admin_assets/logo/logo.png" alt="" style="height: 100px; width:100px; content">
      </div>
             <div class="card">
                <div class="card-body">


                <h4 class="card-title">Forgot Password</h4>

                <form @submit.prevent="submit">
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" id="email" v-model="form.email" class="form-control" placeholder="Email" >
                      <span class="text-danger" v-if="form.errors.email">{{ form.errors.email }}</span>
                    </div>


                   <submit-button :isLoading="form.processing">Submit</submit-button>
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
import { useForm } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'
import SubmitButton from '../../components/SubmitButton.vue'



const form = useForm({
  email: '',
})

defineProps({
  errors:Object
})

function submit() {
  form.post('/forgot-password')
}
</script>
