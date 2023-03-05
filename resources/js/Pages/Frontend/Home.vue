<template lang="">
  <Head title="Home"/>
            <div class="jumbotron">
            <h1 class="display-4 abc">Home </h1>

            
           

            <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
<br>
<br>
            <button class="btn btn-primary" @click="increCounter">+</button> {{store.getCounter}}  <button class="btn btn-danger" @click="decreCounter">-</button>

            <button class="btn btn-dark" @click="callService">Call Api</button>

            </div>

</template>

<!-- <script>
import FrontendLayout from '../../Layout/Frontend/Layout.vue';
export default {
  layout: FrontendLayout,
}
</script> -->


<script setup>
import { Head } from '@inertiajs/vue3';
import { useSetAndGetData } from '@/stores/SetAndGetData';

const store = useSetAndGetData();

function increCounter(){
  console.log('increCounter');
  store.setCounter(store.counter + 1);
}

function decreCounter(){
  console.log('decreCounter');

  store.setCounter(store.counter - 1);
}

function callService(){
// toaster.error('abccc');

 let res = service.getData('test');
 console.log(res);
}


// toaster.error('abccc');
</script>

<style lang="">
    
</style>