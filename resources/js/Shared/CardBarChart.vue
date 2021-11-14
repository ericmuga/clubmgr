<template>
  <div
    class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded"
  >
    <div class="rounded-t mb-0 px-4 py-3 bg-transparent">
      <div class="flex flex-wrap items-center">
        <div class="relative w-full max-w-full flex-grow flex-1">
          <h6 class="uppercase text-blueGray-400 mb-1 text-xs font-semibold">
            Meetings This Month
          </h6>
          <!-- <h2 class="text-bluegray-700 text-xl font-semibold">
            total orders
          </h2>
          -->       
  </div>
      </div>
    </div>
    <div class="p-4 flex-auto">
      <div class="relative h-350-px">
        <canvas id="bar-chart"></canvas>
      </div>
    </div>
  </div>
</template>
<script>
import Chart from "chart.js";
export default {
  props:{
    meetings:Object,
    // thisMonthMembers:Array,
    // thisMonthGuests:Array,
  },
  data:{
        // meetings:null,
  },
  mounted: function () {
    // alert(this.meetings.thisMonthMembers)
    // alert(this.meetings.thisMonthGuests[0])

   this.$nextTick(function () {
      let config = {
        type: "bar",
        data: {
          labels: this.meetings.thisMonthDates,
          datasets: [
            {
              // label: new Date().getFullYear(),
              label:"Members", 
              backgroundColor: "#ed64a6",
              borderColor: "#ed64a6",
              // data: [30, 78, 56, 34, 100, 45, 13],
              data: this.meetings.thisMonthMembers,
              fill: false,
              barThickness: 8,
            },
            {
              // label: new Date().getFullYear() - 1,
              label:"Guests", 
              fill: false,
              backgroundColor: "#4c51bf",
              borderColor: "#4c51bf",
               // data: [4, 68, 86, 74, 10, 4, 87],
              data: this.meetings.thisMonthGuests,
              barThickness: 8,
            },
          ],
        },
        options: {
          maintainAspectRatio: true,
          responsive: true,
          title: {
            display: false,
            text: "Meetings",
          },
          tooltips: {
            mode: "index",
            intersect: false,
          },
          hover: {
            mode: "nearest",
            intersect: true,
          },
          legend: {
            labels: {
              fontColor: "rgba(0,0,0,.4)",
            },
            align: "end",
            position: "bottom",
          },
          scales: {
            xAxes: [

              {
                ticks: {
                    // autoSkip: false,
                    maxRotation: 45,
                    minRotation: 45
                },
                display: true,
                scaleLabel: {
                  display: true,
                  
                  labelString: "Meeting Date",
                },
                gridLines: {
                  borderDash: [2],
                  borderDashOffset: [2],
                  color: "rgba(33, 37, 41, 0.3)",
                  zeroLineColor: "rgba(33, 37, 41, 0.3)",
                  zeroLineBorderDash: [2],
                  zeroLineBorderDashOffset: [2],
                },
              },
            ],
            yAxes: [

              {
                ticks: {
                          beginAtZero: true
                      },
                display: true,
                scaleLabel: {
                  display: true,
                  labelString: "Participants",
                },
                gridLines: {
                  borderDash: [2],
                  drawBorder: false,
                  borderDashOffset: [2],
                  color: "rgba(33, 37, 41, 0.2)",
                  zeroLineColor: "rgba(33, 37, 41, 0.15)",
                  zeroLineBorderDash: [2],
                  zeroLineBorderDashOffset: [2],
                },
              },
            ],
          },
        },
      };
      let ctx = document.getElementById("bar-chart").getContext("2d");
      window.myBar = new Chart(ctx, config);
    });
  },
};
</script>
