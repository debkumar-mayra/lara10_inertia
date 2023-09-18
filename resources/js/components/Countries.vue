<template>
    <!-- <select>
        <option v-for="country in countries" :key="country.name">{{country.name}}</option>
    </select> -->

<Multiselect
 :modelValue="content" @update:modelValue="content = $event"
  placeholder="Country"
  label="name"
  :searchable="true"
  :options="options"
>
  <template v-slot:singlelabel="{ value }">
    <div class="multiselect-single-label">
      <img class="character-label-icon" :src="value.icon"> {{ value.name }}
    </div>
  </template>

  <template v-slot:option="{ option }">
    <img class="character-option-icon" :src="option.icon"> {{ option.name }}
  </template>
</Multiselect>
  
</template>

<script setup>
import Multiselect from '@vueform/multiselect';   //https://www.npmjs.com/package/@vueform/multiselect
import '@vueform/multiselect/themes/default.css';  //https://jsfiddle.net/xajub20o/
import countriesList from '../helpers/Countries.json';

import { ref } from 'vue';
const content = ref('');
const value = ref('');

const options = ref([]);

const countries = Object.values(countriesList);
countries.map((country)=>{
    let count = {
        name:`${country.name} (${country.phone[0]})`,
        value:country.phone[0],
        icon:country.image,
    }
    options.value.push(count);
})
// console.log(options.value);

</script>

<style scoped>
.character-option-icon{
    height: 20px;
    padding-right: 8px;
}

.character-label-icon {
 height: 20px;
 padding-right: 8px;
}
</style>
