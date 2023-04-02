<template>
   <button v-bind="$attrs" type="submit" class="btn btn-primary">
        <template v-if="isLoading">
        <semipolar-spinner :animation-duration="2000" :size="20" color="#fff" />
        </template>
        
        <template v-else>
            <slot>Submit</slot>
        </template>
</button>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { AtomSpinner,SemipolarSpinner } from 'epic-spinners'

defineProps(['isLoading'])

</script>

<style>

</style>