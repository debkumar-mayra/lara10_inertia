<template>
<div>
  <datepicker
    class="form-control border-gray-200" placeholder="DOB"
    v-bind="$attrs"
    :clearable="false"
    :inputFormat="'MM-dd-yyyy'"
  />
  </div>
</template>

<script setup>
import Datepicker from 'vue3-datepicker'
</script>

<style>

</style>