<template>
  <div class="flex py-2">
    <div class="p-2 w-1/2 bg-green-100 rounded-md shadow-md dark:bg-dark-eval-1">
      Colleges
    </div>&nbsp;  
    <div class="p-2 w-1/2 bg-green-100 rounded-md shadow-md dark:bg-dark-eval-1">
      Submission Data
        <div>
          <Pie id="my-chart-id" :options="chartOptions" :data="chartData" />
        </div>
    </div>
  </div>
</template>

<script>
import { Pie } from 'vue-chartjs'
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'

ChartJS.register(ArcElement, Tooltip, Legend)

export default {
  name: 'BarChart',
  components: { Pie },
  data() {
    return {
      chartData: {
        labels: [
          'CCIS', 'COE', 'CHS', 'CAFSD', 'CAS', 'COM', 'COL', 'CTE', 'CIT', 'GS', 'CASAT', 'CBEA', 'CVM'
        ],
        datasets: [
          {
            backgroundColor: ['#41B883', '#E46651', '#00D8FF', '#DDBB14', '#95477F', '#00FFD1',
                              '#002AFC', '#FFCD00', '#5C0808', '#44A4AA', '#00D00D', '#AA5D00', '#AAFFB1'],
            data: [50, 60, 40, 20, 30, 70, 10, 20, 40, 40, 40, 10, 50]
          }
        ]
      },
      chartOptions: {
        responsive: true,
        maintainAspectRatio: false,
        // width: 400, // Adjust the width here
        // height: 400, // Adjust the height here
        plugins: {
          legend: {
            position: 'chartArea', // Display legend inside the chart area
            align: 'center', // Align legend to the center
            labels: {
              boxWidth: 20, // Set the box width
              padding: 10 // Set the padding
            }
          }
        },
        tooltips: {
          enabled: true // Disable tooltips
        },
        hover: {
          mode: null // Disable hover
        },
        
      }
    }
  }
}
</script>
