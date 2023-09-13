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
                       <Link href="/admin/faq/create" class="btn btn-button kt-btn btn-sm kt-btn--icon button-fx">+ Add New</Link>
                        <!-- {{ $search }} -->
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
                            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 30%;"
                            aria-sort="ascending" aria-label="Agent: activate to sort column descending">Question <i
                            class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" @click="ListHelper.sortBy('question')"></i>
                            </th>

                            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 30%;"
                            aria-sort="ascending" aria-label="Agent: activate to sort column descending">Answer <i
                            class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" @click="ListHelper.sortBy('answer')"></i>
                            </th>

                            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 20%;"
                            aria-label="Short Description: activate to sort column ascending">Created At <i
                            class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" @click="ListHelper.sortBy('created_at')"></i>
                            </th>     
                            
                            <th class="align-center" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1"
                            style="width: 10%;" aria-label="Status: activate to sort column ascending">Status</th>

                            <th class="align-center" rowspan="1" colspan="1" style="width: 10%;" aria-label="Actions">Actions</th>
                            </tr>

         
                            <tr class="filter">
                                <th>
                                    <input type="search" v-model="form.question" placeholder="" autocomplete="off"
                                        class="form-control-sm form-filter" />
                                </th>
                                <th>
                                    <input type="search" v-model="form.answer" placeholder="" autocomplete="off"
                                        class="form-control-sm form-filter" />
                                </th>
                                <th>
                                    <datepicker v-model="form.created_at" />
                                </th>
                                <th>
                                    <select class="form-control form-control-sm form-filter kt-input" v-model="form.status"
                                        title="Select" data-col-index="2">
                                        <option value="">Select One</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </th>
                                <th>
                                    <div class="row justify-content-center align-items-center">
                                        
                                    </div>
                                </th>
                            </tr>

                        </thead>
                        <tbody v-auto-animate>      
                            <tr role="row" class="odd" v-for="faq in faqs.data" :key="faq.id" >
                                <td class="sorting_1" tabindex="0">
                                    {{faq.question.substring(0,200)+".."}}
                                </td>
                                <td>{{ faq.answer?.substring(0,210)+".." }}</td>
                                <td>{{ListHelper.dateFormat(faq.created_at)}}</td>
                                <td class="align-center">
                                    <span @click="changeStatus(faq.id)" style="cursor: pointer;" class="kt-badge kt-badge--inline kt-badge--pill cursor-pointer"
                                    :class="(faq.active == 1) ? 'kt-badge--success':'kt-badge--warning'"
                                        >{{(faq.active == 1) ? 'Active':'Inactive'}}</span>

                                </td>
                                <td nowrap="" class="align-center">
                                    <span class="dropdown">
                                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                    <i class="la la-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <!-- <a class="dropdown-item" href="edit-user/"><i class="la la-edit"></i> Edit</a> -->
                                        <Link class="dropdown-item" :href="`faq/${faq.id}/edit`"><i class="la la-edit"></i> Edit</Link>
                                        <!-- <a class="dropdown-item" href="#"><i class="la la-eye"></i> View</a> -->
                                        <button href="#" class="dropdown-item" @click="deleteRecode(faq.id)"><i class="fa fa-trash"></i> Delete</button>
                                    </div>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-12" v-if="faqs.total == 0">
                    <div class="no_data text-center"><h3>No data Found</h3></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-5">
                <div class="dataTables_info" id="kt_table_1_info" role="status" aria-live="polite">
                    Showing {{faqs.from}} to {{faqs.to}} of {{faqs.total}} entries
                </div>
            </div>
            <div class="col-sm-12 col-md-7">
                  <div class="float-right"> 
                     <Bootstrap4Pagination
                            :data="faqs"
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
import Paginate from '../../../components/Paginate.vue'
import { router, useForm,usePage } from '@inertiajs/vue3'
import { ref, onMounted, reactive, watch } from 'vue';
import Datepicker from '../../../components/Datepicker.vue'
import ListHelper from '../../../helpers/ListHelper';
import { Bootstrap4Pagination } from 'laravel-vue-pagination';
import {debounce,throttle,pickBy} from "lodash";



const {faqs,filters} = defineProps({ faqs: Object, filters: Object});

const form = reactive({
    question: filters.question || null,
    answer: filters.answer || null,
    created_at: filters.created_at ? new Date(filters.created_at) : null,
    status: filters.status || ''
})

watch(form, debounce(() => {
    router.visit(route('admin.faq.index'), {
    method: 'get',
    data: pickBy(form),
    preserveState: true 
    });
    }, 100));


onMounted(() => {
    perPage.value = urlParams.get('perPage') || usePage().props.perPage;

     emit.emit('pageName', 'FAQ Management',[{title: "FAQ", routeName:"admin.faq.index"}]);

    emit.on('deleteConfirm', function (arg1) {
        deleteConfirm(arg1);
    });

    emit.on('changeStatusConfirm', function (arg1) {
        changeStatusConfirm(arg1);
    });
});



const perPage = ref(5);


const deleteRecode = (id) => {
    sw.confirm('deleteConfirm', id);
}

const deleteConfirm = (id) => {
    let data = {
        id: id
    }
    router.delete(`/admin/faq/${id}`);
}


const changeStatus = (id) => {
    sw.confirm('changeStatusConfirm',id,'Are you sure?',"You want to change the status!",'Yes, Change it!');
}

const changeStatusConfirm = (id) => {
    router.post(route('admin.faq.changeFaqStatus',id))
}



</script>
