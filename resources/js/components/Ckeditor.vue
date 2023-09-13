<template>
     <ckeditor :editor="editor" :modelValue="content" @update:modelValue="content = $event"
></ckeditor>
</template>
<script setup>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";  // https://ckeditor.com/docs/ckeditor5/latest/installation/integrations/vuejs-v3.html#quick-start

import { ref } from "vue";

const editor = ClassicEditor;
const content = ref('');

</script>
