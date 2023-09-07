<template>
<div>
  <datepicker
    class="form-control border-gray-200" placeholder="Date"
    v-bind="$attrs"
    :clearable="false"
    :inputFormat="'MM-dd-yyyy'"
  />
  </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3'
import { ref } from 'vue';
import Datepicker from 'vue3-datepicker'

const format = ref(usePage().props.dateFormat);
format.value = format.value.replace('.','/');
format.value = format.value.replace('-','/');
format.value = format.value.toLowerCase().split('/');
let newDateformat = format.value.map((item)=>{
  if(item == 'mm'){
    item.toUpperCase();
    // console.log('hhhhh'+item);
  }

  // return item;
// console.log(item);
})
// console.log(newDateformat);

</script>

<style>

</style>