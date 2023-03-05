<template lang="">
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
</script>