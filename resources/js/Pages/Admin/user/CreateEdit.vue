<template lang="">
  <Head title="Create User" v-if="!props.user"/>
  <Head title="Edit User" v-if="props.user"/>
    
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__body">
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
                    <label for="phone">Phone</label>
                    <input type="number" id="phone" v-model="form.phone" class="form-control border-gray-200" placeholder="Phone">
                    <span class="text-danger" v-if="form.errors.phone">{{ form.errors.phone }}</span>
               </div>

               <div class="form-group col-lg-6" v-if="!props.user">
                    <label for="password">Password</label>
                    <input type="password" id="password" v-model="form.password" class="form-control border-gray-200" placeholder="Password">
                    <span class="text-danger" v-if="form.errors.password">{{ form.errors.password }}</span>
               </div>

               <div class="form-group col-lg-6">
                    <label for="dob">DOB</label>
                    <datepicker v-model="form.dob" />
                    <!-- <input type="date" id="dob" v-model="form.dob" class="form-control border-gray-200" placeholder="DOB"> -->
                    <span class="text-danger" v-if="form.errors.dob">{{ form.errors.dob }}</span>
               </div>

               <div class="form-group col-lg-6">                   
                   <label for="profile_photo">Profile Photo</label>
                   <file-upload @input="form.profile_photo = $event.target.files[0]" :imageurl="imageUrl" />
    
                    <span class="text-danger" v-if="form.errors.profile_photo">{{ form.errors.profile_photo }}</span>
                    <output><img :src="previewUrl" v-if="previewUrl" height="100" width="100"></output>
               </div>

               <div class="form-group col-lg-6">
                    <label for="status">Status</label>
                    <select id="status" class="form-control border-gray-200" v-model="form.status">
                        <option value="">Select Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    <span class="text-danger" v-if="form.errors.status">{{ form.errors.status }}</span>
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
import { onMounted, reactive,ref } from 'vue'
import { useForm,router } from '@inertiajs/vue3'
import FileUpload from '../../../components/FileUpload.vue'
import Datepicker from '../../../components/Datepicker.vue'
import SubmitButton from '../../../components/SubmitButton.vue'



const form = useForm({
  first_name: props.user?.first_name || null,
  last_name: props.user?.last_name || null,
  email: props.user?.email || null,
  password: null,
  phone:props.user?.phone || null,
  dob: props.user?.dob ? new Date(props.user?.dob) : null,
  status:props.user?.active || '',
  profile_photo: null,
})

const props = defineProps({
   errors:Object,
   user:Object
})
 const imageUrl = ref('');
onMounted(()=>{
  imageUrl.value = props.user?.profile_photo_url || '';
  if(props.user){
   emit.emit('pageName', 'User Management','Edit User');
  }else{
   emit.emit('pageName', 'User Management','User Create')
  }
  // console.log(imageUrl.value);
})

function submit() {
  if(props.user){
    form.post("/admin/edit-user/"+props.user.id);
  }else{
    form.post('/admin/create-user');
  }
}




</script>
<style lang="">
    
</style>