<template lang="">
    <div class="col-md-4 offset-md-4" style="margin-top:90px;">
      <div  class="d-flex justify-content-center">
                <img :src="$page.props.logo" alt="" style="height: 100px; width:100px; content">
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


                   <button type="submit" class="btn btn-primary"  :disabled="form.processing">
                        <div :class="{'spinner-border':form.processing, 'spinner-border-sm':form.processing}" role="status"></div>
                        Submit</button>
                </form>
                </div>
            </div>
    </div>


   
</template>

<script setup>
import { reactive, ref } from 'vue'
import { useForm, router} from '@inertiajs/vue3'



const form = useForm({
  email: '',
})

defineProps({
  errors:Object
})

function submit() {
  form.post(route('frontend.forgotPassword'))
}
</script>
