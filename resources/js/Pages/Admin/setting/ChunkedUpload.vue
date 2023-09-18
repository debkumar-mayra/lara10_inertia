
<script setup>
import { ref, watch, computed } from 'vue';

const file = ref(null);
const chunks = ref([]);
const uploaded = ref(0);

const select = (event) => {
  console.log('file select');
  file.value = event.target.files.item(0);
  createChunks();
};

const createChunks = () => {
  console.log('createChunks');
  const size = 2048;
  const numChunks = Math.ceil(file.value.size / size);

  for (let i = 0; i < numChunks; i++) {
    console.log('createChunks start');
    chunks.value.push(
      file.value.slice(
        i * size,
        Math.min(i * size + size, file.value.size),
        file.value.type
      )
    );
    console.log(chunks.value);
  }
};

const upload = () => {
  axios(config.value)
    .then((response) => {
      chunks.value.shift();
    })
    .catch((error) => {});
};

const config = computed(() => {
  console.log('config');
  return {
    method: 'POST',
    data: formData.value,
    url: 'chunked-upload',
    headers: {
      'Content-Type': 'application/octet-stream',
    },
    onUploadProgress: (event) => {
      uploaded.value += event.loaded;
    },
  };
});

const formData = computed(() => {
  const formData = new FormData();
  console.log('formData');
  formData.set('is_last', chunks.value.length === 1);
  formData.set('file', chunks.value[0], `${file.value.name}.part`);
  console.log('formData');

  return formData;
});

watch(chunks.value, async (newChunks, oldChunks) => {
  console.log('chunks change');
  if (newChunks.length > 0) {
    console.log('chunks--');
    upload();
  }
});

const progress = computed(() => {
  console.log('progress');
  if (file.value) {
    console.log('progress start');
    return Math.floor((uploaded.value * 100) / file.value.size);
  }
});

</script>



// <script>
//     export default {
//         watch: {
//             chunks(n, o) {
//                  console.log('chunks change');

//                 if (n.length > 0) {
//                  console.log('chunks--');

//                     this.upload();
//                 }
//             }
//         },

//         data() {
//             return {
//                 file: null,
//                 chunks: [],
//                 uploaded: 0
//             };
//         },

//         computed: {
//             progress() {
//                 console.log('progress');
//                 if(this.file){
//                 console.log('progress start');
//                     return Math.floor((this.uploaded * 100) / this.file.size);
//                 }
//             },
//             formData() {
//                 let formData = new FormData;

//                 formData.set('is_last', this.chunks.length === 1);
//                 formData.set('file', this.chunks[0], `${this.file.name}.part`);
//                 console.log('formData');

//                 return formData;
//             },
//             config() {
//                  console.log('formData');
//                 return {
//                     method: 'POST',
//                     data: this.formData,
//                     url: 'chunked-upload',
//                     headers: {
//                         'Content-Type': 'application/octet-stream'
//                     },
//                     onUploadProgress: event => {
//                         this.uploaded += event.loaded;
//                     }
//                 };
//             }
//         },

//         methods: {
//             select(event) {
//                 console.log('file select');
//                 this.file = event.target.files.item(0);
//                 this.createChunks();
//             },
//             upload() {
//                 axios(this.config).then(response => {
//                     this.chunks.shift();
//                 }).catch(error => {});
//             },
//             createChunks() {
//                 console.log('createChunks');
//                 let size = 2048, chunks = Math.ceil(this.file.size / size);

//                 for (let i = 0; i < chunks; i++) {
//                      console.log('createChunks start');
//                     this.chunks.push(this.file.slice(
//                         i * size, Math.min(i * size + size, this.file.size), this.file.type
//                     ));
//                     console.log(this.chunks);
//                 }
//             }
//         }
//     }
// </script>

<template>
    <div>
        <input type="file" @change="select">

<!-- <button @click="upload">upload</button> -->
        <progress :value="progress"></progress>
    </div>
</template>