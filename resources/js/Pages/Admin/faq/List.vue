<template lang="">    
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__body">
        <div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="dataTables_length" id="kt_table_1_length">
                        <label>Show
                            <select class="form-control border-gray-200 custom-select custom-select-sm form-control form-control-sm" v-model="perPage" @change="setPage">
                        
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
                            class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" @click="sortBy('question')"></i>
                            </th>

                            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 30%;"
                            aria-sort="ascending" aria-label="Agent: activate to sort column descending">Answer <i
                            class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" @click="sortBy('answer')"></i>
                            </th>

                            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 20%;"
                            aria-label="Short Description: activate to sort column ascending">Created At <i
                            class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" @click="sortBy('created_at')"></i>
                            </th>     
                            
                            <th class="align-center" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1"
                            style="width: 10%;" aria-label="Status: activate to sort column ascending">Status</th>

                            <th class="align-center" rowspan="1" colspan="1" style="width: 10%;" aria-label="Actions">Actions</th>
                            </tr>

         
                            <tr class="filter">
                                <th>
                                    <input type="search" v-model="form.searchQuestion" placeholder="" autocomplete="off"
                                        class="form-control-sm form-filter" />
                                </th>
                                <th>
                                    <input type="search" v-model="form.searchAnswer" placeholder="" autocomplete="off"
                                        class="form-control-sm form-filter" />
                                </th>
                                <th>
                                    <datepicker v-model="form.searchCreatedAt" />
                                </th>
                                <th>
                                    <select class="form-control form-control-sm form-filter kt-input" v-model="form.searchStatus"
                                        title="Select" data-col-index="2">
                                        <option value="">Select One</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </th>
                                <th>
                                    <div class="row justify-content-center align-items-center">
                                        <div class="col-md-6">
                                        <button class="btn btn-brand kt-btn btn-sm kt-btn--icon button-fx" @click="search">
                                            <span>
                                                <i class="la la-search"></i>
                                                <span>Search</span>
                                            </span>
                                        </button>
                                        </div>
                                        <div class="col-md-6">
                                        <button class="btn btn-secondary kt-btn btn-sm kt-btn--icon button-fx" @click="resetSearch">
                                            <span>
                                                <i class="la la-close"></i>
                                                <span>Reset</span>
                                            </span>
                                        </button>
                                        </div>
                                    </div>
                                </th>
                            </tr>

                        </thead>
                        <tbody v-auto-animate>      
                            <tr role="row" class="odd" v-for="faq in faqs.data" :key="faq.id" v-motion-slide-top>
                                <td class="sorting_1" tabindex="0">
                                    {{faq.question.substring(0,200)+".."}}
                                </td>
                                <td>{{faq.answer.substring(0,210)+".."}}</td>
                                <td>{{moment(faq.created_at).calendar()}}</td>
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
                <Paginate v-if="listData.last_page > 1" :data=faqs />               
            </div>
        </div>
    </div>
</div>




</template>


<script setup>
import Paginate from '../../../components/Paginate.vue'
import { router, useForm,usePage } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue';
import moment from 'moment';
import Datepicker from '../../../components/Datepicker.vue'

moment.calendar = {
    lastDay : '[Yesterday at] LT',
    sameDay : '[Today at] LT',
    nextDay : '[Tomorrow at] LT',
    lastWeek : '[last] dddd [at] LT',
    nextWeek : 'dddd [at] LT',
    sameElse : 'L'
};


const props = defineProps({ faqs: Object, shortBy: String });
const listData = ref({});
listData.value = props.faqs;

const getRandomVal = () => {
    let colors = ["success", "info", "warning", "dark", "primary"];
    let random = Math.floor(Math.random() * colors.length);
    console.log('=====' + random);
    return random;
}

const form = useForm({
    searchQuestion: null,
    searchAnswer: null,
    searchCreatedAt: null,
    searchStatus: null
})


onMounted(() => {
    form.searchQuestion = params.get('title') || null;
    form.searchAnswer = params.get('title') || null;
    form.searchCreatedAt = params.get('created_at') || null;
    form.searchStatus = params.get('active') || '';
    perPage.value = params.get('perPage') || usePage().props.perPage;

     emit.emit('pageName', 'FAQ Management',[{title: "FAQ", routeName:"admin.faq.index"}]);

    emit.on('deleteConfirm', function (arg1) {
        deleteConfirm(arg1);
    });

    emit.on('changeStatusConfirm', function (arg1) {
        changeStatusConfirm(arg1);
    });
});

let params = new URLSearchParams(window.location.search)

const fieldName = ref('');

const shortBy = ref(false);
const sortBy = (column) => {
    shortBy.value = !shortBy.value;
    let shortByy = shortBy.value ? 'asc' : 'desc';
    // console.log(shortBy);
    router.reload({
        method: 'get',
        data: { fieldName: column, shortBy: shortByy },
        replace: true,
    });
}


const resetSearch = () => {
    router.visit('/admin/faq', {
        method: 'get'
    });
}



const search = () => {
    // console.log(form);
    let data = {
        question: form.searchQuestion,
        answer: form.searchAnswer,
        created_at: form.searchCreatedAt,
        active: form.searchStatus,
    };
    if (form.searchQuestion == '' || form.searchQuestion == null) {
        delete data.question
    }

    if (form.searchAnswer == '' || form.searchAnswer == null) {
        delete data.answer
    }

    if (form.searchStatus == '' || form.searchStatus == null) {
        delete data.active
    }

    if (form.searchCreatedAt == '' || form.searchCreatedAt == null) {
        delete data.created_at
    }

    router.visit('/admin/faq', {
        method: 'get',
        data: data,
        replace: false,
    });
}

const perPage = ref(5);

const setPage = () => {
    router.reload({
        method: 'get',
        data: { perPage: perPage.value },
        replace: false,
    });
}


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
     let data = {
        id: id
    }
    router.post('/admin/change-faq-status', data)
}



</script>
