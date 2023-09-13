<template lang="">
    
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__body">
        <form @submit.prevent="submit">
            <div class="form-group validated row">
                <!-- {{ $form }} -->
                <div class="form-group col-lg-6">
                    <label for="title">title <span class="text-danger">*</span></label>
                    <textarea id="title" v-model="form.title" class="form-control border-gray-200" placeholder="title"></textarea>
                    <span class="text-danger" v-if="form.errors.title">{{ form.errors.title }}</span>
               </div>


               <div class="form-group col-lg-12">
                    <label for="content">Content <span class="text-danger">*</span></label>

                    <CKeditor v-model="form.content" />
                    <span class="text-danger" v-if="form.errors.content">{{ form.errors.content }}</span>
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
import { onMounted } from 'vue'
import { useForm,router } from '@inertiajs/vue3'
import FileUpload from '../../../components/FileUpload.vue'
import Datepicker from '../../../components/Datepicker.vue'
import SubmitButton from '../../../components/SubmitButton.vue'
import CKeditor from '../../../components/Ckeditor.vue'


const form = useForm({
  title: props.cms?.title || null,
  content: props.cms?.text_content || null,
})




onMounted(()=>{
   emit.emit('pageName', 'CMS Management',[{title: "CMS", routeName:"admin.cms.index"},{title: "Edit", routeName:""}]);
})

const props = defineProps({
   errors:Object,
   cms:Object
})

function submit() {
     
  if(props.cms){
    form.post("/admin/cms/"+props.cms.id);
  }else{
    form.post('/admin/cms');
  }
}


</script>
