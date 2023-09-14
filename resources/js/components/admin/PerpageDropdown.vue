<template>
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
</template>

<script setup>
import ListHelper from '@/helpers/ListHelper';
import { usePage } from '@inertiajs/vue3';
import { ref } from 'vue';


 const perPage = ref(5);
 perPage.value = urlParams.get('perPage') || usePage().props.perPage;

</script>