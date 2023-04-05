<template>
   
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__body">
    <h2>Change password</h2>
        <form @submit.prevent="submit">
            <div class="form-group validated row">
                <!-- {{ $form }} -->

                <div class="form-group col-lg-6">
                    <label for="old_password">Old password</label>
                    <input type="password" id="old_password" v-model="form.old_password" class="form-control border-gray-200" placeholder="Old password">
                    <span class="text-danger" v-if="form.errors.old_password">{{ form.errors.old_password }}</span>
               </div>

              <div class="form-group col-lg-6">
                    <label for="new_password">New password</label>
                    <input type="password" id="new_password" v-model="form.new_password" class="form-control border-gray-200" placeholder="New password">
                    <span class="text-danger" v-if="form.errors.new_password">{{ form.errors.new_password }}</span>
               </div>

               <div class="form-group col-lg-6">
                    <label for="new_password_confirm">New password confirm</label>
                    <input type="password" id="new_password_confirm" v-model="form.new_password_confirm" class="form-control border-gray-200" placeholder="New password confirm">
                    <span class="text-danger" v-if="form.errors.new_password_confirm">{{ form.errors.new_password_confirm }}</span>
               </div>

                <div class="form-group col-lg-6">
                </div>

                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-6">

                              <submit-button :disabled="form.processing" :isLoading="form.processing">Submit</submit-button>
                            </div>
                            <div class="col-lg-6 kt-align-right">
                            <button type="reset" class="btn btn-danger">Reset</button>
                            </div>


                        </div>
                    </div>
                </div>
             </div>
        </form>
    </div>
</div>

</template>

<script setup>

import { useForm,router } from '@inertiajs/vue3'
import SubmitButton from '../../components/SubmitButton.vue'


const form = useForm({
  old_password: null,
  new_password: null,
  new_password_confirm: null,
})

const props = defineProps({
   errors:Object
})

function submit() {
    form.post('/admin/admin-change-password');
}

</script>

<style>

</style>