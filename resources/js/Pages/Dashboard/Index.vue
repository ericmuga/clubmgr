<template>
  <div>
     <div class="font-bold">
          <a

           class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded-full"
           style="background-color:#606d9e"
            :href=url>
              Zoom Auth
         </a>

        

         <!--  <inertia-link class="btn-indigo" :href="route('zoom.meetings')">
               <span class="hidden md:inline">Zoom Meetings</span>
          </inertia-link> -->

          <!-- <inertia-link class="btn-indigo" :href="route('zoom.accounts')">
               <span class="hidden md:inline">Account</span>
          </inertia-link> -->
     
     
      
    </div>

    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl flex-2 mt-6 h-1/2" >
     
        <Chart></Chart>
     
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout';
import Chart from './Chart'
// import axios from 'axios';

export default {
   // mounted(){
     
   //   // axios.get('https://zoom.us/oauth/authorize?response_type=code&client_id=88qbzpueTkGI66J9dKWd1g&redirect_uri=https://localhost/show&state={userState}')

   // },
  
  metaInfo: { title: 'Dashboard' },
  layout: Layout,
  components:{
    Chart
  },
  props: {
          response:Array,
          client_id:'',
          callback_url:''
  },

  data(){
        return {
          url:"https://zoom.us/oauth/authorize?response_type=code&client_id="+this.client_id+"&redirect_uri="+this.callback_url+"&state={userState}"
          } 
  }

}
</script>
