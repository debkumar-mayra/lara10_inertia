<template>
	<div class="modal-overlay">
	  <div class="modal">
		<div class="modal-header">
			<slot name="modal-header"></slot>
			</div>
			<div class="modal-body">
				<slot name="modal-body"></slot>
			</div>
				<div class="modal-footer">
				<button v-if="saveBtn" class="btn btn-success" @click="$emit('submit')">
					Save
				</button>
				<button class="btn btn-secondary" @click="$emit('close')">
					Close
				</button>
			</div>
	  </div>
	</div>
  </template>
  
  <script setup>
     const props = defineProps(['close','submit','saveBtn'])
  </script>
  
  <style scoped>
  .modal-overlay {
	display:grid;place-items:center;
	position:absolute;top:0;bottom:0;
	left:0;right:0;background:rgba(0,0,0,.4)
  }
  .modal {
	display: block;
	z-index: 99999;
	position:relative;width:260px;padding:20px; height: auto;
	margin:20px;border-radius:6px;background:#F9FAFB;
	box-shadow:0 10px 15px -3px rgba(0,0,0,.3),
			   0 4px 6px -2px rgba(0,0,0,.05),
			   0 2px 4px -1px rgba(0,0,0,.06)
  }
  </style>