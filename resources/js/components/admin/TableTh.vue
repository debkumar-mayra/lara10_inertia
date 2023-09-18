<template>
     <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="cursor: pointer;" aria-sort="ascending" aria-label="Agent: activate to sort column descending">
                            <slot></slot> 
                            <i v-if="sorting" class="fa fa-fw fa-sort pull-right"></i>
                    </th>
</template>

<script setup>
defineProps({sorting:{
    type:Boolean,
    default:true
}})
</script>


