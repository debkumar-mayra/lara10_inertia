<template lang="">
<loading v-model:active="isLoading" :can-cancel="true" :is-full-page="true" />

    <div>
        <div class="container-fluid">
            <Nav/>
            <slot/>
            <Footer/>
        </div>
    </div>
</template>
<script setup>
import Nav from './Nav.vue';
import Footer from './Footer.vue';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';
import { onMounted,ref } from 'vue';

const isLoading = ref(true);
onMounted(() => {
    isLoading.value = false;
})
</script>