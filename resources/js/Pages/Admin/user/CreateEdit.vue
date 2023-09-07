<template lang="">
<div>
  <Head title="Create User" v-if="!props.user"/>
  <Head title="Edit User" v-if="props.user"/>
    
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__body">
        <form @submit.prevent="submit" >
            <div class="form-group validated row">

                 <text-input v-model="form.first_name" :error="form.errors.first_name" label="First name" placeholder="First name"/>

               <text-input v-model="form.last_name" :error="form.errors.last_name" label="Last name" placeholder="Last name"/>


              <text-input type="email" v-model="form.email" :error="form.errors.email" label="Email" placeholder="Email"/>

               <text-input type="number" v-model="form.phone" :error="form.errors.phone" label="Phone" placeholder="Phone"/>


             <text-input type="password" v-model="form.password" :error="form.errors.password" label="Password" placeholder="Password"/>


             

               <div class="form-group col-lg-6">
                    <label for="dob">DOB</label>
                    <datepicker v-model="form.dob" placeholder="DOB"/>
                    <!-- <input type="date" id="dob" v-model="form.dob" class="form-control border-gray-200" placeholder="DOB"> -->
                    <span class="text-danger" v-if="form.errors.dob">{{ form.errors.dob }}</span>
               </div>

               <div class="form-group col-lg-6">                   
                   <label for="profile_photo">Profile Photo</label>
                   <FilePond v-model="form.profile_photo" :myFile="props.user?.profile_photo"/>
                    <span class="text-danger" v-if="form.errors.profile_photo">{{ form.errors.profile_photo }}</span>
                </div>



               

               <div class="form-group col-lg-6">
                    <label for="status" class="underline">Status</label>
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
                            <button type="reset" class="btn btn-secondary kt-btn btn-sm kt-btn--icon button-fx">Reset</button>
                            </div>


                        </div>
                    </div>
                </div>
             </div>
        </form>
    </div>
</div>
</div>
</template>
<script setup>
import { onMounted, reactive,ref } from 'vue'
import { useForm,router } from '@inertiajs/vue3'
import FileUpload from '../../../components/FileUpload.vue'
import Datepicker from '../../../components/Datepicker.vue'
import SubmitButton from '../../../components/SubmitButton.vue'
import FileInput from '../../../components/FileInput.vue'
import TextInput from '../../../components/admin/TextInput.vue'
import FilePond from '../../../components/FilePond.vue'



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
  imageUrl.value = props.user?.profile_photo || '';
  if(props.user){
  //  emit.emit('pageName', 'User Management','Edit User');
     emit.emit('pageName', 'User Management',[{title: "User List", routeName:"admin.users"},{title: "Edit User", routeName:""}]);

  }else{
   emit.emit('pageName', 'User Management', [{title: "User List", routeName:"admin.users"},{title: "Add User", routeName:""}])
  }
  // console.log(imageUrl.value);
})

function submit() {
  if(props.user){
    form.post(route('admin.editUser',props.user.id));
  }else{
    form.post(route('admin.createUser'));
  }
}




</script>
<style lang="">
    
</style>