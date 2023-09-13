<template>
  <div :class="$attrs.class" class="form-group col-lg-6">
    <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
    <input :id="id" ref="input"  v-bind="{ ...$attrs, class: null }" class="form-control border-gray-200" :class="{ error: error }" :type="type" :value="modelValue" @input="updateModelValue" />
     <span class="text-danger" v-if="error">{{ error }}</span>
  </div>
</template>


  <!-- <div class="form-group col-lg-6" v-if="!props.user">
                    <label for="password">Password</label>
                    <input type="password" id="password" v-model="form.password" class="form-control border-gray-200" placeholder="Password">
                    <span class="text-danger" v-if="form.errors.password">{{ form.errors.password }}</span>
               </div> -->

<script setup>
import { v4 as uuid } from 'uuid'
import { ref } from 'vue'

const { id, type, error, label, modelValue } = defineProps(['id', 'type', 'error', 'label', 'modelValue'])
const emit = defineEmits(['update:modelValue']);

const inputRef = ref(null)

const focus = () => {
  inputRef.value.focus()
}

const select = () => {
  inputRef.value.select()
}

const setSelectionRange = (start, end) => {
  inputRef.value.setSelectionRange(start, end)
}

const updateModelValue = (event) => {
  emit('update:modelValue', event.target.value)
}
</script>