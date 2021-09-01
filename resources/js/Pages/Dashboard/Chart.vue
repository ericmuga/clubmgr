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
          "August 2021",
         ],
         gridLines: {
          display: false
        },
          datasets: [
          {
            data: [40],
            label: "Cyber Security Meeting",
            color: "#3e95cd",
            fill: false,
          },
          {
            data: [60],
            label: "Health Talk",
            borderColor: "#8e5ea2",
            fill: false,
          },
          {
            data: [70],
            label: "Environment",
            borderColor: "#3cba9f",
            fill: false,
          },
          {
            data: [80],
            label: "Governance",
            borderColor: "#e8c3b9",
            fill: false,
          },
          {
            data: [120],
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