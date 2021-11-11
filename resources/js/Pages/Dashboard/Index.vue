<template>
  <div>
     

          <div class="flex-1 justify-between bg-indigo-200 " >
               <HeaderStats :meetings="meetings" :members="members" :promotions="promotions" :guests="guests"/>
          </div>
     
     <div class="flex justify-between bg-gray-200 p-6">
       <CardBarChart class="mx-3" :meetingDates="meetings.thisMonthDates"/>
       <CardBarChart class="mx-3"/>
     </div>
     
     
      
    
    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl flex-2 mt-6 h-1/2" >
     
     
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout';
import CardBarChart from '@/Shared/CardBarChart';
import Chart from './Chart'
import HeaderStats from './HeaderStats'
// import axios from 'axios';

export default {
 
   // mounted(){
     
   //   // axios.get('https://zoom.us/oauth/authorize?response_type=code&client_id=88qbzpueTkGI66J9dKWd1g&redirect_uri=https://localhost/show&state={userState}')

   // },
  
  metaInfo: { title: 'Dashboard' },
  layout: Layout,
  components:{
    Chart,
    HeaderStats,
    CardBarChart
  },
  props: {
          response:Array,
          client_id:'',
          callback_url:'',
          members:Object,
          meetings:Object,
          promotions:Object,
          guests:Object,
          

  },

  data(){
        return {
          url:"https://zoom.us/oauth/authorize?response_type=code&client_id="+this.client_id+"&redirect_uri="+this.callback_url+"&state={userState}"
          } 
  }

}
</script>
