<template>
  <div class="small">
    <line-chart :chart-data="datacollection"></line-chart>
    <!-- <button @click="fillData()">Randomize</button> -->
  </div>
</template>

<script>
  import LineChart from '@/Shared/LineChart.js'

  export default {
    components: {
      LineChart
    },
    data () {
      return {
        datacollection: null
      }
    },
    mounted () {
      this.fillData()
    },
    methods: {
      fillData () {
        this.datacollection = {
         labels: [
          "8th Aug 2021",
          "10th Aug 2021",
          "17th Aug 2021",
          "19th Aug 2021",
          "25th Aug 2021",
          "28th Aug 2021",
          "30th Aug 2021",
          "31th Aug 2021",
          
        ],
          datasets: [
          {
            data: [40, 45, 80, 76, 60, 111, 100, 90],
            label: "Cyber Security Meeting",
            borderColor: "#3e95cd",
            fill: false,
          },
          {
            data: [60, 49, 83, 70, 60, 110, 80, 90],
            label: "Health Talk",
            borderColor: "#8e5ea2",
            fill: false,
          },
          {
            data: [70, 65, 80, 76, 60, 23, 78, 90],
            label: "Environment",
            borderColor: "#3cba9f",
            fill: false,
          },
          {
            data: [80, 50, 80, 76, 60, 30, 25, 80],
            label: "Governance",
            borderColor: "#e8c3b9",
            fill: false,
          },
          {
            data: [90, 45, 80, 76, 67, 34, 100, 40],
            label: "Finance",
            borderColor: "#c45850",
            fill: false,
          },
        ],
        }
      },
      // getRandomInt () {
      //   return Math.floor(Math.random() * (50 - 5 + 1)) + 5
      // }
    }
  }
</script>

<style>
  .small {
    max-width: 300px;
    margin:  20px 20px;
  }
</style>