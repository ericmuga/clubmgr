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
            Content Goes here
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

// import axios from 'axios';

export default {
 
  
     
   //   // axios.get('https://zoom.us/oauth/authorize?response_type=code&client_id=88qbzpueTkGI66J9dKWd1g&redirect_uri=https://localhost/show&state={userState}')

   // },
  
  metaInfo: { title: 'Dashboard' },
  layout: Layout,
  components:{
    Chart,
    HeaderStats,
    CardBarChart,
    TextInput
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
  methods:{

    refresher(){
      alert('Gotcha!')
    }
  },
  

  data(){
        return {
                  form:{endDate:'',startDate:''},
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
