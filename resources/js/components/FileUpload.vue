<template lang="">
<div>

    <input type="file" v-bind="$attrs" @change="onFileChange" class="form-control border-gray-200" />

    <output>


      <img :src="previewUrl" v-if="previewUrl && (fileType=='image')" height="100" width="100" >

      <video width="200" height="100" controls v-if="previewUrl && (fileType=='video')">
        <source :src="previewUrl" type="video/mp4">
        <source :src="previewUrl" type="video/ogg">
        Your browser does not support the video tag.
      </video>

      <!-- <a :href="previewUrl" v-if="previewUrl && (fileType=='application')" target="_blank" ><img src="/admin_assets/images/file_icon.png" height="100" width="100" ></a> -->
      <a v-if="previewUrl && (fileType=='application')">
        <img src="/admin_assets/images/file_icon.png" height="100" width="100" >
        </a>

      </output>
   
    <output>

      <!-- <img :src="props.imageurl"  height="100" width="100"> -->

      <template v-if="(previewUrl =='' && props.imageurl)">

      <img :src="props.imageurl" v-if="props.imageurl && (fileType=='image')" height="100" width="100" >

      <video width="100" height="100" controls v-if="props.imageurl && (fileType=='video')">
        <source :src="props.imageurl" type="video/mp4">
        <source :src="props.imageurl" type="video/ogg">
        Your browser does not support the video tag.
      </video>

      <a :href="props.imageurl" v-if="props.imageurl && (fileType=='application')" target="_blank" ><img src="/admin_assets/images/file_icon.png" height="100" width="100" ></a>

      </template>

    </output>
  </div> 
</template>
<script setup>
import { computed, onMounted, onUpdated, ref } from "vue";

const previewUrl = ref('');
const fileType = ref('');


const props = defineProps(['imageurl']);



onUpdated(()=>{
  let ext = props.imageurl.substr(-5);

  let type = ext.split(".");

if(!isPrev.value){
  // console.log(props.imageurl+'-----onUpdated--'+previewUrl.value);
    if(type[1] == 'webp' || type[1] == 'jpg' ||type[1] == 'png' ||type[1] == 'jpeg' ||type[1] == 'gif'){
       fileType.value = 'image';
    }else if(type[1] == 'mp4' || type[1] == 'avi' || type[1] == 'AVI' || type[1] == 'mov' || type[1] == 'wmv'|| type[1] == '3gp'|| type[1] == 'mkv'){
       fileType.value = 'video';
    }else{
      fileType.value = 'application';
    }
}

})
const getFileType = ref('');


const isPrev = ref(false);

function onFileChange (event) {
  // fileType.value = '';
  props.imageurl = '';
      const file = event.target.files[0];
      if (!file) {
        return false
      }
        // console.log('gggggg'+file.type);

          if (file.type.match('application.*')) {
            fileType.value = 'application';
          }

      if (file.type.match('image.*')) {
        fileType.value = 'image';
      }

       if (file.type.match('video.*')) {
         fileType.value = 'video';
       }
       
      const reader = new FileReader()
      const that = this
      reader.onload = function (e) {
        previewUrl.value = e.target.result
      }
      reader.readAsDataURL(file)
        isPrev.value = true;
    }


</script>
<style lang="">
    
</style>