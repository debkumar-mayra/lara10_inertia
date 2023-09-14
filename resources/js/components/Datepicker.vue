<template>
<VueDatePicker :format="format" :model-value="date" @update:model-value="handleDate" auto-apply  @cleared="clearData" />
</template>

<script setup>
import { computed, onMounted, ref } from 'vue';
import VueDatePicker from '@vuepic/vue-datepicker'; // https://vue3datepicker.com/props/modes/
import '@vuepic/vue-datepicker/dist/main.css'
import   moment from 'moment';
import { usePage } from '@inertiajs/vue3';



const {modelValue } = defineProps(['modelValue'])
const emit = defineEmits(['update:modelValue']);


const date = ref();
date.value = modelValue;

const adminFormat = computed(() => usePage().props.dateFormat);
  const format = ref('MM/dd/yyyy');

onMounted(()=>{
  // console.log(adminFormat.value);
if(adminFormat.value == 'DD/MM/YYYY'){
  format.value = 'dd/MM/yyyy';
}
if(adminFormat.value == 'MM/DD/YYYY'){
  format.value = 'MM/dd/yyyy';
}
if(adminFormat.value == 'YYYY/MM/DD'){
  format.value = 'yyyy/MM/dd';
}

})


// const format = (date) => {
//   const day = date.getDate();
//   const month = date.getMonth() + 1;
//   const year = date.getFullYear();
//   return `${day}-${month}-${year}`;
// }

const handleDate = (modelData) => {
  // alert(date.value);
if(modelData){
  date.value = moment(modelData).format(format.value.toUpperCase());
}
  emit('update:modelValue', date.value)
  // do something else with the data
}

const clearData = () => {
  // alert('fff');
  emit('update:modelValue', '');
}

</script>