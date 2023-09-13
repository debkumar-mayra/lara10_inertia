<template>
    <Multiselect
  mode="tags"
  :close-on-select="false"
  :searchable="true"
  :create-option="true"
  :options="options"
  class="multiselect-blue"
  :modelValue="content" @update:modelValue="content = $event"
  />
</template>


<script setup>
import Multiselect from '@vueform/multiselect';   //https://www.npmjs.com/package/@vueform/multiselect
import '@vueform/multiselect/themes/default.css';
import { ref } from 'vue';
const content = ref([]);
defineProps({
    options:{
        required:true,
        type:Object
    }
})

// const options = [{ value: 'batman', label: 'Batman' },
//     { value: 'robin', label: 'Robin', disabled: true },
//     { value: 'joker', label: 'Joker' },];

</script>