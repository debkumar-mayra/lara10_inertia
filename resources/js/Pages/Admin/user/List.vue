<template lang="">
  <Head title="User List"/>
    
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
                       <Link href="/admin/create-user" class="btn btn-primary">+ Add New</Link>
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
                            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 20%;" aria-sort="ascending" aria-label="Agent: activate to sort column descending">Name <i
                            class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" @click="sortBy('first_name')"></i>
                            </th>
                            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 20%;"
                            aria-label="Company Email: activate to sort column ascending">Email <i
                            class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" @click="sortBy('email')"></i></th>
                            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 20%;"
                            aria-label="Company Agent: activate to sort column ascending">Phone <i
                            class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" @click="sortBy('phone')"></i></th>
                            <th class="align-center" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1"
                            style="width: 15%;" aria-label="Status: activate to sort column ascending">Status</th>
                            <th class="align-center" rowspan="1" colspan="1" style="width: 25%;" aria-label="Actions">Actions</th>
                            </tr>



         
            <tr class="filter">
            <th>
                <input type="search" v-model="form.searchName" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
            <th>
                <input type="search" v-model="form.searchEmail" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
            <th>
                <input type="search" v-model="form.searchPhone" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
            <th>
                <select class="form-control form-control-sm form-filter kt-input" v-model="form.searchStatus"
                    title="Select" data-col-index="2">
                    <option value="-1">Select One</option>
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
                        <tbody>

           
                <tr role="row" class="odd" v-for="user in props.users.data" :key=user.id>
                <td class="sorting_1" tabindex="0">
                    <div class="kt-user-card-v2">
                        <div class="kt-user-card-v2__pic">
                            <div class="kt-badge kt-badge--xl kt-badge--success" getRandomVal>
                                <span>{{ user.full_name.substr(0,1) }}</span>
                            </div>
                        </div> 
                        <div class="kt-user-card-v2__details">
                            <span class="kt-user-card-v2__name">{{user.full_name}}</span>
                            <a href="#" class="kt-user-card-v2__email kt-link">Member since
                               {{user.created_at}}</a>
                        </div>
                    </div>
                </td>
                <td><a class="kt-link" href="mailto:adingate15@furl.net">{{user.email}}</a></td>
                <td>{{user.phone}}</td>
                <td class="align-center">
                    <!-- <Link href="change-user-status" method="post" :data="{'id':user.id}"> -->
                    <span @click="changeStatus(user.id)" style="cursor: pointer;" class="kt-badge kt-badge--inline kt-badge--pill cursor-pointer"
                    :class="(user.active == 1) ? 'kt-badge--success':'kt-badge--warning'"
                        >{{(user.active == 1) ? 'Active':'Inactive'}}</span>
                        <!-- </Link> -->
                </td>

                <td nowrap="" class="align-center">
    <span class="dropdown">
    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
    <i class="la la-ellipsis-h"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        <!-- <a class="dropdown-item" href="edit-user/"><i class="la la-edit"></i> Edit</a> -->
        <Link class="dropdown-item" :href="`edit-user/${user.id}`"><i class="la la-edit"></i> Edit</Link>

                  <!-- <a class="dropdown-item" href="#"><i class="la la-eye"></i> View</a> -->

                    
                <button href="#" class="dropdown-item" @click="deleteRecode(user.id)"><i class="fa fa-trash"></i> Delete</button>
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
                    Showing {{users.from}} to {{users.to}} of {{users.total}} entries
                </div>
            </div>
            <div class="col-sm-12 col-md-7">


                <Paginate v-if="listData.last_page > 1" :data=props.users />

               
            </div>
        </div>
    </div>
</div>




</template>


<script setup>
import Paginate from '../../../components/Paginate.vue'
import { router } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'
import {ref,watch,reactive,onMounted} from 'vue';

const props = defineProps({ users: Object });
const listData = ref({});
listData.value = props.users;

const getRandomVal = () => {
    let colors = ["success", "info", "warning", "dark", "primary"];
     let random = Math.floor(Math.random() * colors.length);
     console.log('====='+random);
     return random;
}

const form = useForm({
    searchName: null,
    searchEmail: null,
    searchPhone: null,
    searchStatus: null
})


onMounted(() => {
    form.searchName = params.get('name') || null;
    form.searchEmail = params.get('email') || null;
    form.searchPhone = params.get('phone') || null;
    form.searchStatus = params.get('active') || null;
    perPage.value = params.get('perPage') || 5;

     emit.emit('pageName', 'User Management','User List');

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
    let shortByy = shortBy.value ? 'asc':'desc';
    router.reload({
    method: 'get',
    data: {fieldName:column ,shortBy: shortByy},
    replace: true,
    });
}


const resetSearch = () => {
    router.visit('/admin/users', {
    method: 'get'
    });
}



const search = () => {
    let data = {
      name : form.searchName,
      email : form.searchEmail,
      phone : form.searchPhone,
      active : form.searchStatus,
    };
   if(form.searchName == '' || form.searchName == null){
     delete data.name
   }

   if(form.searchEmail == '' || form.searchEmail == null){
     delete data.email
   }
   if(form.searchPhone == '' || form.searchPhone == null){
     delete data.phone
   }
   if(form.searchStatus == '' || form.searchStatus == null){
     delete data.active
   }
 
    router.visit('/admin/users', {
    method: 'get',
    data: data,
    replace: false,
    });
}

const perPage = ref(5);

const setPage = () => {
    router.reload({
    method: 'get',
    data: {perPage:perPage.value},
    replace: false,
    });
}


const deleteRecode = (id) => {
 sw.confirm('deleteConfirm',id);
}

const deleteConfirm = (id) => {
    router.delete(`/admin/delete-user/${id}`);
} 

const changeStatus = (id) => {
    sw.confirm('changeStatusConfirm',id,'Are you sure?',"You want to change the status!",'Yes, Change it!');
}

const changeStatusConfirm = (id) => {
     let data = {
        id: id
    }
    router.post('/admin/change-user-status', data)
}

</script>
<style lang="">
    
</style>