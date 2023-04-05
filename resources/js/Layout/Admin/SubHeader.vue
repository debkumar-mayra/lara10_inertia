<template lang="">
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-subheader__main">
    <h3 class="kt-subheader__title">
   Dashboard </h3>
    {{title}}
    <span class="kt-subheader__separator kt-hidden"></span>
    
    </div>
    <div class="kt-subheader__toolbar">
        <div class="kt-subheader__wrapper">
            <div class="dropdown dropdown-inline" data-toggle="kt-tooltip"  data-placement="left">
                    <!-- $toolbar -->
            </div>
        </div>
    </div>
</div>
</template>
<script setup>
import { onMounted, ref } from "vue";

const title = ref('');
onMounted(()=>{
       emit.on('pageName', function (arg1,arg2) {
        title.value = arg2;
        });
})


</script>
<style lang="">
    
</style>