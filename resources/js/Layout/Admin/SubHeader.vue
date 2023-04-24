<template lang="">
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-subheader__main">
    <h3 class="kt-subheader__title">
    <template v-if="pageNames.length" >{{pageNames[pageNames.length-1].title || 'Dashboard'}}</template>
    <template v-else > Dashboard </template>
      </h3>


   <div class="kt-subheader__breadcrumbs">
    <Link :href="route('admin.dashboard')" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></Link>

        <Link :href="route('admin.dashboard')" class="kt-subheader__breadcrumbs-link">Dashboard</Link>                
        <span class="kt-subheader__breadcrumbs-separator"></span> 

       <template v-if="pageNames.length" v-for="page,key in pageNames">

       <template v-if="(page.routeName && page.routeName != '')" >
          <Link :href="route(page.routeName)" class="kt-subheader__breadcrumbs-link">{{page.title}}</Link>
       </template>

       <template v-else >
          <Link href="" class="kt-subheader__breadcrumbs-link">{{page.title}}</Link>
       </template>


        <span v-if="(pageNames.length != key+1)" class="kt-subheader__breadcrumbs-separator"></span>

        </template>

    </div>

    
    </div>
    <div class="kt-subheader__toolbar">
        <div class="kt-subheader__wrapper">
            <div class="dropdown dropdown-inline" data-toggle="kt-tooltip" data-placement="left" data-bs-original-title="" title="">
                    
            </div>
        </div>








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

const pageNames = ref('');
onMounted(()=>{
       emit.on('pageName', function (arg1,arg2) {
        pageNames.value = arg2;
        });
})


</script>
<style lang="">
    
</style>