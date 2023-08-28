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
                            class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" @click="sortBy('title')"></i>
                            </th>

                            <th class="align-center" rowspan="1" colspan="1" style="width: 20%;" aria-label="Actions">Actions</th>
                            </tr>

         
                            <tr class="filter">
                                <th>
                                    <input type="search" v-model="form.searchTitle" placeholder="" autocomplete="off"
                                        class="form-control-sm form-filter" />
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
                            <tr role="row" class="odd" v-for="page in pages.data" :key=page.id>
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
                <Paginate v-if="listData.last_page > 1" :data=pages />               
            </div>
        </div>
    </div>
</div>




</template>


<script setup>
import Paginate from '../../../components/Paginate.vue'
import { router, useForm, usePage } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue';
import Datepicker from '../../../components/Datepicker.vue'

const props = defineProps({ pages: Object, shortBy: String });
const listData = ref({});
listData.value = props.pages;

const getRandomVal = () => {
    let colors = ["success", "info", "warning", "dark", "primary"];
    let random = Math.floor(Math.random() * colors.length);
    console.log('=====' + random);
    return random;
}

const form = useForm({
    searchTitle: null,
})


onMounted(() => {
    form.searchTitle = params.get('title') || null;
    perPage.value = params.get('perPage') || usePage().props.perPage;

   emit.emit('pageName', 'Content Management',[{title: "CMS List", routeName:"admin.cms.index"}]);
   
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
    router.visit('/admin/cms', {
        method: 'get'
    });
}



const search = () => {
    // console.log(form);
    let data = {
        title: form.searchTitle,
    };
    if (form.searchTitle == '' || form.searchTitle == null) {
        delete data.title
    }

    router.visit('/admin/cms', {
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

</script>
