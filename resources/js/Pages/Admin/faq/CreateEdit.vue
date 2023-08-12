<template lang="">
    
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__body">
        <form @submit.prevent="submit">
            <div class="form-group validated row">
                <!-- {{ $form }} -->
                <div class="form-group col-lg-6">
                    <label for="question">Question <span class="text-danger">*</span></label>
                    <textarea id="question" v-model="form.question" class="form-control border-gray-200" placeholder="Question"></textarea>
                    <span class="text-danger" v-if="form.errors.question">{{ form.errors.question }}</span>
               </div>

               <div class="form-group col-lg-6">
                    <label for="answer">Answer <span class="text-danger">*</span></label>
                    <textarea id="answer" v-model="form.answer" class="form-control border-gray-200" placeholder="Answer"></textarea>
                    <span class="text-danger" v-if="form.errors.answer">{{ form.errors.answer }}</span>
               </div>
             
               <div class="form-group col-lg-6">
                    <label for="active">Status <span class="text-danger">*</span></label>
                    
                    <select id="active" class="form-control border-gray-200" v-model="form.active">
                        <option value="">Select Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    <span class="text-danger" v-if="form.errors.active">{{ form.errors.active }}</span>
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
import { onMounted, reactive,ref } from 'vue'
import { useForm,router } from '@inertiajs/vue3'
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import FileUpload from '../../../components/FileUpload.vue'
import Datepicker from '../../../components/Datepicker.vue'
import SubmitButton from '../../../components/SubmitButton.vue'

const editor = ClassicEditor

const form = useForm({
  question: props.faq?.question || null,
  answer: props.faq?.answer || null,
  active:props.faq?.active || 0,
})

onMounted(()=>{
   emit.emit('pageName', 'FAQ Management',[{title: "FAQ", routeName:"admin.faq.index"},{title: "Create", routeName:""}]);
})

const props = defineProps({
   errors:Object,
   faq:Object
})

function submit() {
     
  if(props.faq){
    form.put("/admin/faq/"+props.faq.id);
  }else{
    form.post('/admin/faq');
  }
}


</script>
