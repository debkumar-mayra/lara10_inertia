<template>
  <Head title="My profile"/>
   
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__body">
    <h2>Profile</h2>
        <form @submit.prevent="submit">
            <div class="form-group validated row">
                <!-- {{ $form }} -->

                <div class="form-group col-lg-6">
                    <label for="first_name">First name</label>
                    <input type="text" id="first_name" v-model="form.first_name" class="form-control border-gray-200" placeholder="First name">
                    <span class="text-danger" v-if="form.errors.first_name">{{ form.errors.first_name }}</span>
               </div>

               <div class="form-group col-lg-6">
                    <label for="last_name">Last name</label>
                    <input type="text" id="last_name" v-model="form.last_name" class="form-control border-gray-200" placeholder="Last name">
                    <span class="text-danger" v-if="form.errors.last_name">{{ form.errors.last_name }}</span>
               </div>


               <div class="form-group col-lg-6">
                    <label for="email">Email</label>
                    <input type="email" id="email" v-model="form.email" class="form-control border-gray-200" placeholder="Email">
                    <span class="text-danger" v-if="form.errors.email">{{ form.errors.email }}</span>
               </div>

              

               <div class="form-group col-lg-6">                   
                   <label for="profile_photo">Profile Photo</label>
                   <file-upload @input="form.profile_photo = $event.target.files[0]" :imageurl="imageUrl" />
    
                    <span class="text-danger" v-if="form.errors.profile_photo">{{ form.errors.profile_photo }}</span>
                    <output><img :src="previewUrl" v-if="previewUrl" height="100" width="100"></output>
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

<admin-change-password/>

</template>

<script setup>

import { onMounted, reactive,ref } from 'vue'
import { useForm,router } from '@inertiajs/vue3'
import FileUpload from '../../components/FileUpload.vue'
import SubmitButton from '../../components/SubmitButton.vue'
import AdminChangePassword from './AdminChangePassword.vue'


const form = useForm({
  first_name: props.user?.first_name || null,
  last_name: props.user?.last_name || null,
  email: props.user?.email || null,
  profile_photo: null,
})

const props = defineProps({
   errors:Object,
   user:Object
})
 const imageUrl = ref('');

onMounted(()=>{
  imageUrl.value = props.user?.profile_photo_url || '';
    //   emit.emit('pageName', 'Profile','Profile');
     emit.emit('pageName', 'User Management',[{title: "Profile", routeName:"admin.profile"}]);

})



function submit() {
    form.post(route('admin.profile'));
}

</script>

<style>

</style>