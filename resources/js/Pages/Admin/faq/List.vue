<template lang="">    
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__body">

        <Table :ListData="faqs">

             <template #perpage>
                <Icon v-if="selectedId.length" @click="multipleDelete" icon="material-symbols:delete" color="red" width="30" height="30" style="cursor: pointer; margin-right:10px;"/>
                <!-- <button class="btn-danger" v-if="selectedId.length" @click="multipleDelete"><Icon icon="material-symbols:delete" color="white" width="30" height="30" /></button> -->
             </template>

            <template #TableButton>
                <Link :href="route('admin..faq.create')" class="btn btn-button kt-btn btn-sm kt-btn--icon button-fx">+ Add New</Link>
            </template>

            <template #TableHead>
                <TableTh @click="ListHelper.sortBy('question')">
                <!-- <TableTh > -->
                            <input class="mr-2" type="checkbox" @click.stop="checkedAll = !checkedAll"/>
                           
                     
                    Question</TableTh>
                <TableTh @click="ListHelper.sortBy('answer')">Answer</TableTh>
                <TableTh @click="ListHelper.sortBy('created_at')">Created at</TableTh>
                <TableTh :sorting=false>Status</TableTh>
                <TableTh :sorting=false>Actions</TableTh>
            </template>

        <template #TableFilter>
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
        </template>




            <template #TableBody>

                <tr role="row" class="odd" v-for="faq in faqs.data" :key="faq.id" >
                                <td class="sorting_1" tabindex="0">
                                    <input type="checkbox" class="kt-checkbox" v-model="selectedId" :value="faq.id" />
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
                                        <Link class="dropdown-item" :href="`faq/${faq.id}/edit`"><i class="la la-edit"></i> Edit</Link>
                                        <button href="#" class="dropdown-item" @click="deleteRecode(faq.id)"><i class="fa fa-trash"></i> Delete</button>
                                    </div>
                                    </span>
                                </td>
                            </tr>
                            <tr role="row" v-if="Object.keys(faqs.data).length == 0" class="odd text-center">
                                <td colspan="5" >No data Found</td>
                            </tr>

            </template>

        </Table>

    </div>
</div>




</template>


<script setup>
import { router, useForm,usePage } from '@inertiajs/vue3'
import { ref, onMounted, reactive, watch,onUnmounted } from 'vue';
import Datepicker from '@/components/Datepicker.vue'
import ListHelper from '@/helpers/ListHelper';
import {debounce,throttle,pickBy} from "lodash";
import Table from '@/components/admin/Table.vue';
import TableTh from '@/components/admin/TableTh.vue';





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

     emit.emit('pageName', 'FAQ Management',[{title: "FAQ", routeName:"admin.faq.index"}]);

    emit.on('deleteConfirm', function (arg1) {
        deleteConfirm(arg1);
    });

    emit.on('changeStatusConfirm', function (arg1) {
        changeStatusConfirm(arg1);
    });
});


onUnmounted(() => {
    emit.off("changeStatusConfirm");
    emit.off("deleteConfirm");
});


const deleteRecode = (id) => {
    sw.confirm('deleteConfirm', id);
}

const deleteConfirm = (id) => {
    router.delete(route('admin.faq.destroy'));
    selectedId.value =[];

}


const changeStatus = (id) => {
    sw.confirm('changeStatusConfirm',id,'Are you sure?',"You want to change the status!",'Yes, Change it!');
}

const changeStatusConfirm = (id) => {
    router.post(route('admin.faq.changeFaqStatus',id))
}

const selectedId = ref([]);
const checkedAll = ref(false);

watch(checkedAll, (newVal)=>{
    selectedId.value = [];
    if(newVal){
        faqs.data.map((item)=>{
            selectedId.value.push(item.id);
        })
    }

    
});

const multipleDelete = () =>{
    deleteRecode(selectedId.value);
}


</script>
