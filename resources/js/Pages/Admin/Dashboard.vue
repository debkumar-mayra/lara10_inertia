<template>
  <Head title="Dashboard"/>

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__body">
    <div class="row">
    <div class="col-md-6">
      <h3>User</h3>
        <div>
           <Pie :data="data" :options="options" />
        </div>
    </div>

    <div class="col-md-6">
      <h3>User</h3>
        <div>
        <Line :data="lineData" :options="options" />
        </div>
    </div>

    </div>
    </div>
    </div>
  </template>
  <!-- Documentation: https://vue-chartjs.org/examples/#vue-3-charts -->
  <script setup>
  import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend
  } from 'chart.js'


  import { Line } from 'vue-chartjs'

  import { ArcElement } from 'chart.js'
  import { Pie } from 'vue-chartjs'
  import { onMounted } from 'vue' 


onMounted(()=>{
     emit.emit('pageName', 'Dashboard', []);
})


  
  ChartJS.register(ArcElement, Tooltip, Legend)

  
  ChartJS.register(
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend
  );
  
const props = defineProps(['data']);
  
  const data = {
    labels: ['Active User', 'Inactive User'],
    datasets: [
      {
        backgroundColor: ['#41B883', '#E46651'],
        data: [props.data.active_user, props.data.inactive_user]
      }
    ]
  }
  
  const lineData = {
  labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
  datasets: [
    {
      label: 'Data One',
      backgroundColor: '#f87979',
      data: [40, 39, 10, 40, 39, 80, 40]
    }
  ]
}

const options = {
  responsive: true,
  maintainAspectRatio: false
}
  </script>
  