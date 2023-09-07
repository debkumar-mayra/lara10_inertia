<template lang="">    
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__body">
        <div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="dataTables_length" id="kt_table_1_length">
                        <label>Show
                            <select class="form-control border-gray-200 custom-select custom-select-sm form-control form-control-sm" v-model="perPage" @change="ListHelper.setPerPage($event.target.value)">
                        
                                <option value="5"> 5</option>  
                                <option value="10"> 10</option> 
                                <option value="20"> 20</option>  
                                <option value="50"> 50</option>
                                <option value="100"> 100</option>
                            </select> entries
                        </label>
                        
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div id="kt_table_1_filter" class="dataTables_filter">
                       <!-- <Link href="/admin/faq/create" class="btn btn-primary">+ Add New</Link> -->
                        <!-- {{ $search }} -->
                    </div>
                </div>
            </div>
            <div class="row table-responsive">
                <div class="col-sm-12">
                    <table
                        class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline"
                        id="kt_table_1" role="grid" aria-describedby="kt_table_1_info" style="width: 1115px;">
                        <thead>


                            <tr role="row">
                            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 80%;"
                            aria-sort="ascending" aria-label="Agent: activate to sort column descending">Page Name <i
                            class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" @click="ListHelper.sortBy('title')"></i>
                            </th>

                            <th class="align-center" rowspan="1" colspan="1" style="width: 20%;" aria-label="Actions">Actions</th>
                            </tr>

         
                            <tr class="filter">
                                <th>
                                    <input type="search" v-model="form.title" placeholder="" autocomplete="off"
                                        class="form-control-sm form-filter" />
                                </th>                                
                                <th>
                                    <div class="row justify-content-center align-items-center">
                                    </div>
                                </th>
                            </tr>

                        </thead>
                        <tbody v-auto-animate>      
                            <tr role="row" class="odd" v-for="page in pages.data" :key="page.id">
                                <td class="sorting_1" tabindex="0">
                                    {{page.title}}
                                </td>
                                <td nowrap="" class="align-center">
                                    <span class="dropdown">
                                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                    <i class="la la-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <Link class="dropdown-item" :href="`cms/${page.slug}/edit`"><i class="la la-edit"></i> Edit</Link>
                                    </div>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-5">
                <div class="dataTables_info" id="kt_table_1_info" role="status" aria-live="polite">
                    Showing {{pages.from}} to {{pages.to}} of {{pages.total}} entries
                </div>
            </div>
            <div class="col-sm-12 col-md-7">

                  <div class="float-right"> 
                     <Bootstrap4Pagination
                            :data="pages"
                            :limit=2
                            @pagination-change-page="ListHelper.setPageNum"
                        />
                        </div>
            </div>
        </div>
    </div>
</div>




</template>


<script setup>
import { Bootstrap4Pagination } from 'laravel-vue-pagination';
import Paginate from '../../../components/Paginate.vue'
import { router, useForm, usePage } from '@inertiajs/vue3'
import { ref, onMounted, watch, reactive } from 'vue';
import {debounce,throttle,pickBy} from "lodash";
import ListHelper from '../../../helpers/ListHelper';



const {pages, filters} = defineProps({ pages: Object, filters: Object });

const form = reactive({
    title: filters.title || null,
})

watch(form, debounce(() => {
    router.visit(route('admin.cms.index'), {
    method: 'get',
    data: pickBy(form),
    preserveState: true 
    });
    }, 100));



const perPage = ref(5);
onMounted(() => {
    perPage.value = urlParams.get('perPage') || usePage().props.perPage;
   emit.emit('pageName', 'Content Management',[{title: "CMS List", routeName:"admin.cms.index"}]);
});




</script>
