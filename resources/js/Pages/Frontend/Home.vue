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
            <!-- <button class="btn btn-primary" @click="increCounter">+</button> {{store.getCounter}}  <button class="btn btn-danger" @click="decreCounter">-</button>

            <button class="btn btn-dark" @click="callService">Call Api <Icon icon="material-symbols:star-outline" color="green" width="38" height="38" /></button> -->

            </div>

</template>

<!-- <script>
import FrontendLayout from '../../Layout/Frontend/Layout.vue';
export default {
  layout: FrontendLayout,
}
</script> -->


<script setup>
import { Head, router, useForm } from '@inertiajs/vue3';
// import { useSetAndGetData } from '@/stores/SetAndGetData';

// const store = useSetAndGetData();

// function increCounter(){
//   console.log('increCounter');
//   store.setCounter(store.counter + 1);
// }

// function decreCounter(){
//   console.log('decreCounter');

//   store.setCounter(store.counter - 1);
// }

const form = useForm({

});

async function callService(){
// toaster.error('abccc');

// let res = await fetch('test').then((ress)=>{
//     return ress.json();
// }

// ) ;

form.post('test', {
    // wantsJson: true,
    api: true,
    onSuccess: (data) => {
      console.log(data);
        // this.$emit('success', data);
    }
});

// let res = form.get('test');
// console.log(res.message);

// form.get('test', {
//   onSuccess: () => form.reset('password'),
// })


//  let res = service.getData('test');

//  res.then(function(ress){
//    console.log(ress);
//  });
}


// toaster.error('abccc');
</script>

<style lang="">
    
</style>