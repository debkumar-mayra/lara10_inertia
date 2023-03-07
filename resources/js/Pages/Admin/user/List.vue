<template lang="">
    
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__body">
        <div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="dataTables_length" id="kt_table_1_length">
                        <!-- {{ $perPage }} -->
                        
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div id="kt_table_1_filter" class="dataTables_filter">
                       
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
                            class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" wire:click="sortBy('first_name')"></i>
                            </th>
                            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 20%;"
                            aria-label="Company Email: activate to sort column ascending">Email <i
                            class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" wire:click="sortBy('email')"></i></th>
                            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 20%;"
                            aria-label="Company Agent: activate to sort column ascending">Phone <i
                            class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" wire:click="sortBy('phone')"></i></th>
                            <th class="align-center" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1"
                            style="width: 15%;" aria-label="Status: activate to sort column ascending">Status</th>
                            <th class="align-center" rowspan="1" colspan="1" style="width: 25%;" aria-label="Actions">Actions</th>
                            </tr>



            <tr class="filter">
            <th>
                <x-admin.input type="search" wire:model.defer="searchName" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
            <th>
                <x-admin.input type="search" wire:model.defer="searchEmail" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
            <th>
                <x-admin.input type="search" wire:model.defer="searchPhone" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
            <th>
                <select class="form-control form-control-sm form-filter kt-input" wire:model.defer="searchStatus"
                    title="Select" data-col-index="2">
                    <option value="-1">Select One</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </th>
            <th>
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-6">
                    <button class="btn btn-brand kt-btn btn-sm kt-btn--icon button-fx" wire:click="search">
                        <span>
                            <i class="la la-search"></i>
                            <span>Search</span>
                        </span>
                    </button>
                    </div>
                    <div class="col-md-6">
                    <button class="btn btn-secondary kt-btn btn-sm kt-btn--icon button-fx" wire:click="resetSearch">
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

           
                <tr role="row" class="odd" v-for="user in users.data" :key=user.id>
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
                <td class="align-center"><span
                        class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill cursor-pointer"
                        >Active</span>
                </td>

                <td nowrap="" class="align-center">
    <span class="dropdown">
    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
    <i class="la la-ellipsis-h"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit</a>

                  <a class="dropdown-item" href="#"><i class="la la-eye"></i> View</a>

                    <a class="dropdown-item" href="#"> Following users</a>

                   <a class="dropdown-item" href="#"> Follower users</a>
                   <a class="dropdown-item" href="#"> Life goals</a>
                <button href="#" class="dropdown-item" wire:click="deleteAttempt(104)"><i class="fa fa-trash"></i> Delete</button>
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

                <Paginate :data=users />

               
            </div>
        </div>
    </div>
</div>




</template>


<script setup>
import Paginate from '../../../components/Paginate.vue'
defineProps({ users: Object });

const getRandomVal = () => {
    let colors = ["success", "info", "warning", "dark", "primary"];
     let random = Math.floor(Math.random() * colors.length);
     console.log('====='+random);
     return random;
}


</script>
<style lang="">
    
</style>