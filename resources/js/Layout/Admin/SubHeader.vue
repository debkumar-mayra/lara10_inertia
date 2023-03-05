<template lang="">
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-subheader__main">
    <h3 class="kt-subheader__title">
    $headerTitle </h3>
    $slot 
    <span class="kt-subheader__separator kt-hidden"></span>
    
    </div>
    <div class="kt-subheader__toolbar">
        <div class="kt-subheader__wrapper">
            <div class="dropdown dropdown-inline" data-toggle="kt-tooltip"  data-placement="left">
                    $toolbar
            </div>
        </div>
    </div>
</div>
</template>
<script setup>
</script>
<style lang="">
    
</style>