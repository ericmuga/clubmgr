<template>
  <!-- Header -->
  <!-- <div class="relative bg-emerald-600 md:pt-32 pb-32 pt-12"> -->
  <div class="relative bg-emerald-600 md:pt-6 pb-6">
    <div class="px-4 md:px-10 mx-auto w-full">
      <div>
        <!-- Card stats -->
        <div class="flex flex-wrap">
          <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
            <card-stats
              :statSubtitle="meetings.title"
              :statTitle="meetings.count"
              statArrow="up"
              :statPercent="meetings.thisMonth"
              statPercentColor="text-emerald-500"
              statDescripiron="This Month"
              statIconName="far fa-chart-bar"
              statIconColor="bg-red-500"
            />
          </div>
          <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
            <card-stats
              statSubtitle="members"
              :statTitle="members.count"
              statArrow="down"
              statPercent="As at"
              statPercentColor="text-emerald-500"
              :statDescripiron="members.asAt"
              statIconName="fas fa-chart-pie"
              statIconColor="bg-orange-500"
            />
          </div>
         <!--  <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
            <card-stats
              :statSubtitle="promotions.title"
              :statTitle="promotions.count"
              statArrow="down"
              :statPercent="promotions.thisMonth"
              statPercentColor="text-orange-500"
              statDescripiron="This Month"
              statIconName="fas fa-users"
              statIconColor="bg-gray-500"
            />
          </div> -->
          <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
            <card-stats
              :statSubtitle="guests.title"
              :statTitle="guests.count"
              statArrow=""
              statPercent=""
              statPercentColor="text-emerald-500"
              statDescripiron=""
              statIconName="fas fa-percent"
              statIconColor="bg-indigo-500"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import CardStats from "./CardStats.vue";

export default {
  components: {
    CardStats,

  },
  props:{
    members:Object,
    meetings:Object,
    promotions:Object,
    guests:Object,
  }
};
</script>
