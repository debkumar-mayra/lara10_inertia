<template lang="">
<div>
    <input type="file" v-bind="$attrs" @change="onFileChange" class="form-control border-gray-200" />

    <output><img :src="previewUrl" v-if="previewUrl" height="100" width="100"></output>
   
    <output><img :src="props.imageurl" v-if="(!previewUrl && props.imageurl)" height="100" width="100"></output>
  </div>
</template>
<script setup>
import { onMounted, onUpdated, ref } from "vue";

const previewUrl = ref('');


const props = defineProps(['imageurl']);

  

function onFileChange (event) {
      const file = event.target.files[0]
      if (!file) {
        return false
      }
      if (!file.type.match('image.*')) {
        return false
      }
      const reader = new FileReader()
      const that = this
      reader.onload = function (e) {
        previewUrl.value = e.target.result
      }
      reader.readAsDataURL(file)
    }


</script>
<style lang="">
    
</style>