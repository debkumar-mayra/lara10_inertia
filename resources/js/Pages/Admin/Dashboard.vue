<template>
    <div class="row">
    <div class="col-md-6">
        <Pie :data="data" :options="options" />
    </div>

    <div class="col-md-6">
        <Line :data="lineData" :options="options" />
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

  
  ChartJS.register(ArcElement, Tooltip, Legend)

  
  ChartJS.register(
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend
  )
  

  
  const data = {
    labels: ['VueJs', 'EmberJs', 'ReactJs', 'AngularJs'],
    datasets: [
      {
        backgroundColor: ['#41B883', '#E46651', '#00D8FF', '#DD1B16'],
        data: [40, 20, 80, 10]
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
  