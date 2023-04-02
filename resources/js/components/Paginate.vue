<template lang="">
    <div class="dataTables_paginate paging_simple_numbers float-right" id="kt_table_1_paginate">
                   
                   <div>
                        <nav>
                          <ul class="pagination">
                              <li v-for="link,key in props.data.links" class="page-item" :class="{active : link.active}" aria-current="page" :key="link.label">
                               <template v-if="link.url">
                                   <Link :href="link.url">
                                   <span class="page-link" v-html="link.label"></span>
                                  </Link>
                               </template>

                               <template v-else>
                                   <span class="page-link" v-html="link.label"></span>
                               </template>

                           </li> 
                       </ul>
                     </nav>
               </div>
    </div>
</template>
<script setup>
const props = defineProps({ data: Object })
</script>
<style lang="">
    
</style>