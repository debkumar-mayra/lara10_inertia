<template>
    <div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            
            
            <div class="row">
                <div class="col-sm-12 col-md-6 d-flex flex-row">
                       <div class="dataTables_length" id="kt_table_1_length">
                        <slot name="perpage">
                        </slot>
                       </div>
                       <perPageDropdown/>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div id="kt_table_1_filter" class="dataTables_filter">
                        <slot name="TableButton"></slot>
                    </div>
                </div>
            </div>



            <div class="row table-responsive table_fixed_width">
                <div class="col-sm-12">
                    <table
                        class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline"
                        id="kt_table_1" role="grid" aria-describedby="kt_table_1_info" style="width: 1115px;">
                        <thead>


                            <tr role="row">
                                 <slot name="TableHead"></slot>
                            </tr>

         
                            <tr class="filter">
                                  <slot name="TableFilter"></slot>
                            </tr>

                        </thead>
                        <tbody v-auto-animate>      
                           <slot name="TableBody"></slot>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


         <div class="row">
            <div class="col-sm-12 col-md-5">
                <div class="dataTables_info" id="kt_table_1_info" role="status" aria-live="polite">
                    Showing {{ListData.from}} to {{ListData.to}} of {{ListData.total}} entries
                </div>
            </div>
            <div class="col-sm-12 col-md-7">
                  <div class="float-right"> 
            <Bootstrap4Pagination :data="ListData" :limit=2 @pagination-change-page="ListHelper.setPageNum"/>
                  </div>          
            </div>
        </div>

</template>

<script setup>
import ListHelper from '@/helpers/ListHelper';

import { Bootstrap4Pagination } from 'laravel-vue-pagination';

import perPageDropdown from '@/components/admin/PerpageDropdown.vue';
const {ListData} = defineProps({ListData:Object})

</script>

