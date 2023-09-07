<template>
    <div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__body">
        <form @submit.prevent="submit">
            <div class="form-group validated row">

                <div class="form-group col-lg-6">                   
                   <label for="logo">Logo</label>
                   <FilePond v-model="form.logo" :myFile="setting.logo" />
                    <span class="text-danger" v-if="form.errors.logo">{{ form.errors.logo }}</span>
               </div>


                <div class="form-group col-lg-6">
                    <label for="date_format">Date Format<span class="text-danger">*</span></label>
                    <!-- <input type="text" id="date_format" class="form-control border-gray-200" placeholder="Date Format" v-model="form.date_format"/> -->

                    <select id="date_format" class="form-control border-gray-200" placeholder="Per page" v-model="form.date_format">
                        <option value="L">LOCAL</option>
                        <option value="DD/MM/YYYY">DD/MM/YYYY</option>
                        <option value="MM/DD/YYY">MM/DD/YYY</option>
                        <option value="YYYY/MM/DD">YYYY/MM/DD</option>
                        <option value="100">100</option>
                    </select>

                    <span class="text-danger" v-if="form.errors.date_format">{{ form.errors.date_format }}</span>

                    
               </div>

               <div class="form-group col-lg-3">
                    <label for="per_page">Number of data per page in a table<span class="text-danger">*</span></label>
                    <select id="per_page" class="form-control border-gray-200" placeholder="Per page" v-model="form.per_page">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <!-- <input type="text" id="per_page" class="form-control border-gray-200" placeholder="Per page" v-model="form.per_page"/> -->
                    <span class="text-danger" v-if="form.errors.per_page">{{ form.errors.per_page }}</span>
               </div>

                <div class="form-group col-lg-3">
                    <label for="main_color">Main Color<span class="text-danger">*</span></label>
                    <input type="color" id="main_color" class="form-control border-gray-200" placeholder="Main Color" v-model="form.main_color"/>
                    <span class="text-danger" v-if="form.errors.main_color">{{ form.errors.main_color }}</span>
               </div>

                <div class="form-group col-lg-3">
                    <label for="hover_color">Hover Color<span class="text-danger">*</span></label>
                    <input type="color" id="hover_color" class="form-control border-gray-200" placeholder="Hover Color" v-model="form.hover_color"/>
                    <span class="text-danger" v-if="form.errors.hover_color">{{ form.errors.hover_color }}</span>
               </div>

               <div class="form-group col-lg-3">
                    <label for="button_color">Button Color<span class="text-danger">*</span></label>
                    <input type="color" id="button_color" class="form-control border-gray-200" placeholder="Button Color" v-model="form.button_color"/>
                    <span class="text-danger" v-if="form.errors.button_color">{{ form.errors.button_color }}</span>
               </div>





            </div>
             <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-6">
                              <submit-button :disabled="form.processing" :isLoading="form.processing">Submit</submit-button>
                            </div>
                            <div class="col-lg-6 kt-align-right">
                              <Link href="/admin/faq" class="btn btn-secondary">Cancel</Link>
                            </div>

                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>

</template>
<script setup>
import { onMounted, ref } from 'vue'
import { useForm,router } from '@inertiajs/vue3'
import FileUpload from '../../../components/FileUpload.vue'
import SubmitButton from '../../../components/SubmitButton.vue'
import FilePond from '../../../components/FilePond.vue'

const {setting,errors} = defineProps({
   errors:Object,
   setting:Object,
})

const imageUrl = ref(null);
onMounted(()=>{
    imageUrl.value = setting.logo;
})
   


const form = useForm({
  logo: [],
  date_format: setting.date_format || null,
  per_page: setting.per_page || null,
  main_color: setting.main_color || null,
  hover_color: setting.hover_color || null,
  button_color: setting.button_color || null,
})

function submit() {
  form.post(route('admin.setting'));
}

</script>
