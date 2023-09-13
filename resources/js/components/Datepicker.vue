<template>
<VueDatePicker :format="'MM/dd/yyyy'" :model-value="date" @update:model-value="handleDate" auto-apply  @cleared="clearData" />
</template>

<script setup>
import { ref } from 'vue';
import VueDatePicker from '@vuepic/vue-datepicker'; // https://vue3datepicker.com/props/modes/
import '@vuepic/vue-datepicker/dist/main.css'


const {modelValue } = defineProps(['modelValue'])
const emit = defineEmits(['update:modelValue']);


const date = ref();
const format = (date) => {
  const day = date.getDate();
  const month = date.getMonth() + 1;
  const year = date.getFullYear();
  return `${day}-${month}-${year}`;
}

const handleDate = (modelData) => {
  // alert(date.value);
if(modelData){
  date.value = format(modelData);
}
  emit('update:modelValue', date.value)
  // do something else with the data
}

const clearData = () => {
  // alert('fff');
  emit('update:modelValue', '');
}

</script>