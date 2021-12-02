<template>
  <div>
     

          <div class="flex-1 justify-between bg-indigo-200 " >
               <HeaderStats :meetings="meetings" :members="members" :promotions="promotions" :guests="guests"/>
          </div>
     
     <div class="flex justify-between bg-gray-200 p-6">
       <CardBarChart class="mx-3" :meetings="meetings"/>
        
         <!--play with me section-->
         <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
            <div class="rounded-t mb-0 px-4 py-3 bg-transparent">
              <div class="flex flex-wrap items-center">
                <div class="relative w-full max-w-full flex-grow flex-1">
                 <div class="text-bluegray-700  font-semibold flex">
                   <TextInput
                     class="max-w-sm"
                     type="date"
                     label="From"
                     v-model="form.startDate"
                   />
                   <TextInput
                     class="max-w-sm"
                     type="date"
                     label="To"
                     v-model="form.endDate"
                  />
                 </div>
                        
               </div>
             </div>
           </div>
           <div class="p-4 flex-auto">
          <div class="relative h-350-px">
            <!-- <Link href="/dashboard/prospectiveInductees" 
                  method="post" 
                  as="button" 
                  type="button"
                  class="bg-teal-600 text-white p-2 rounded-md"
            >
                Prospective Inductees
            </Link> -->



            <div class="items-center text-center justify-between bg-gray-100 max-w-sm py-3">

            <Link href="/dashboard/prospectiveInductees" method="post"  as="button" type="button" class="bg-teal-600 text-white p-1 rounded-md">
                   Prospective Inductees
                   <br>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z" />
                    </svg>
            </Link>
           
           <div  v-if="meetings.xlxs!=''" class="text-xs text-indigo-400">
              <a :href="meetings.xlxs">
                Download Link
              </a>
            </div>
          </div>

         <div class="items-center text-center justify-between bg-gray-100 max-w-sm py-3">

          <Link href="/dashboard/attendanceByMonth" 
              method="post"  
                  as="button" 
                type="button"
                :data="form" 

                class="bg-teal-600 text-white p-1 rounded-md">
                   Attendance By Month
                   <br>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z" />
                    </svg>
            </Link>
            </div>
          <!-- <div  v-if="meetings.xlxs!=''" class="text-xs text-indigo-400">
              <a :href="meetings.xlxs">
                Download Link
              </a>
            </div> -->



          </div>
        </div>
        </div> 
        <!-- end of play with me section -->
       
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
import TextInput from '@/Shared/TextInput'
import throttle from 'lodash/throttle'
import { Link } from '@inertiajs/inertia-vue'

// import axios from 'axios';

export default {
  metaInfo: { title: 'Dashboard' },
  layout: Layout,
  components:{
    Chart,
    HeaderStats,
    CardBarChart,
    TextInput,
    Link,
  },
  props: {
          response:Array,
          client_id:'',
          callback_url:'',
          members:Object,
          meetings:Object,
          promotions:Object,
          guests:Object,
          inductees:Object,
          
          

  },
  methods:{

    // refresher(){
    //   alert('Gotcha!')
    // }
  },
  

  data(){
        return {
                  form:{endDate:null,startDate:null},
                  url:"https://zoom.us/oauth/authorize?response_type=code&client_id="+this.client_id+"&redirect_uri="+this.callback_url+"&state={userState}"
               } 
  },

 watch:{
        
     form: {
              deep: true,
              handler: throttle(function() {
                // this.$inertia.get(this.route('meetings'), pickBy(this.form), { preserveState: true })
                this.refresher()
           }, 150),
    },
 }

}
</script>
