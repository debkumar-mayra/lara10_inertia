<template lang="">
    <div class="col-md-6 offset-md-3 mt-5">
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

                    <button type="submit" class="btn btn-primary"  :disabled="form.processing">Login</button>

                </form>
                
                </div>
            </div>
    </div>
   
</template>

<script setup>
import { reactive } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'

const form = useForm({
  email: null,
  password: null,
})

defineProps({
  errors:Object
})

function submit() {
  form.post('/admin/login')
}
</script>

