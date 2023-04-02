<template>
  <datepicker
    class="form-control border-gray-200" placeholder="DOB"
    v-bind="$attrs"
    :locale="locale"
    :clearable="false"
    :inputFormat="'MM-dd-yyyy'"
  />
</template>

<script setup>
import Datepicker from 'vue3-datepicker'
</script>

<style>

</style>