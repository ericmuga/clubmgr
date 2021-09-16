<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('instances')">Instances</inertia-link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.id }} / {{form.uuid}} /{{form.topic}}
      </h1>
      
     <div class="flex  justify-between">
       
    
    
    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl flex-2" >
      <form @submit.prevent="update">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          
          <text-input v-model="form.uuid" :error="form.errors.uuid" class="pr-6 pb-8 w-full lg:w-1/2" label="Uuid" />
          <text-input v-model="form.meeting_id" :error="form.errors.meeting_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Meeting ID" />
          
          <text-input 
              v-model="form.start_time" 
             :error="form.errors.start_time" 
             class="pr-6 pb-8 w-full lg:w-1/2" 
             label="Start Time"

             />

             <text-input 
            
             v-model="form.official_start_time" 
             :error="form.errors.official_start_time" 
             class="pr-6 pb-8 w-full lg:w-1/2" 
             label="Official Start Time"

             />

             <text-input 
            
             v-model="form.official_end_time" 
             :error="form.errors.official_end_time" 
             class="pr-6 pb-8 w-full lg:w-1/2" 
             label="Official End Time"

             />

              <!--   <label for="birthdaytime">Birthday (date and time):</label>
          <input type="datetime-local" id="birthdaytime"  :error="form.errors.start_time" 
             class="pr-6 pb-8 w-full lg:w-1/2" 
             label="Start Time"name="birthdaytime" :value="form.start_time"> -->
          <!-- <text-input v-model="form.topic" :error="form.errors.topic" class="pr-6 pb-8 w-full lg:w-1/2" label="Topic" /> -->
          
          <!-- <text-input v-model="form.guest_speaker" :error="form.errors.guest_speaker" class="pr-6 pb-8 w-full lg:w-1/2" label="Guest Speaker" /> -->
          
          <!-- <select-input v-model="form.instance_type" :error="form.errors.instance_type" class="pr-6 pb-8 w-full lg:w-1/2" label="Instance Type" >
              <option  value="Zoom"  >Zoom</option>
              <option  value="Physical" >Physical</option>
          </select-input>
           -->
          
        </div>  
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
        <!--   <button  class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy"
             
          >Delete Instance</button> -->
          <!-- :disabled=" form.instance_type == 'Zoom'" -->

          <!-- <button class="btn-indigo btn-indigo ml-auto" >Zoom Refresh</button> -->
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit" >Update Instance</loading-button>
        </div>

      </form>
      </div>
        
      <div class=" bg-teal-300  w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-shrink sm:shadow-lg " >
        <div class="flex flex-2 overflow-shrink sm:shadow-lg my-5 h-12">
          <!-- <t-table

            :headers="['Participants', 'Registrants']"
            :responsive=true
            :data=stats

          ></t-table> 
 -->       <!-- <div class="ml-3">
            <label class="bg-indigo-400  w-full flex flex-row flex-no-wrap p-3"for="">Registrants </label>
             <t-table
                         
                        :headers="['Category','No.']"
                        :responsive=true
                        :data=registrantsStats

              >
                
              </t-table> 

             </div> 
            
          <div>
            <div class="ml-10">
               <label class="bg-indigo-400  w-full flex flex-row flex-no-wrap p-3"for="">Occurrences </label>
               <label class="bg-teal-400  w-full flex flex-row flex-no-wrap p-3 text-right">28 </label>
            
            </div>  
          </div>
          <div>
            <div class="ml-10">
              <label class="bg-indigo-400  w-full flex flex-row flex-no-wrap p-3"for="">Past Instances </label>
               <label class="bg-teal-400  w-full flex flex-row flex-no-wrap p-3 text-right">16 </label>
            </div>
          </div> -->
            
             
            
           <!--  <label class="bg-teal-400  w-full flex flex-row flex-no-wrap p-3"for="">Participants </label>
             <t-table
                         
                        :headers="['Category','No.']"
                        :responsive=true
                        :data=participantsStats

              >
                
              </t-table>  -->

           
             <!-- <instance-stats></instance-stats> -->
        </div>
        
      </div>
      
         


  

    </div>
    <!-- <instance-instances :instances=instances></instance-instances> -->
    <!-- <instance-occurrences :occurrences=occurrences></instance-occurrences> -->
    <instance-participants :participants=participants></instance-participants>
    </div>
  
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import TrashedMessage from '@/Shared/TrashedMessage'
 import TTable from 'vue-tailwind/dist/t-table'
 import InstanceParticipants from './InstanceParticipants'
 // import InstanceInstances from './InstanceInstances'
 // import InstanceOccurrences from './InstanceOccurrences'
 // import InstanceStats from './Partials/InstanceStats'

export default {


  metaInfo() {
    return {
      title: `${this.form.instance_id}`,
    }
  },
  components: {
    LoadingButton,
    SelectInput,
    TextInput,
    TrashedMessage,
     TTable,
     InstanceParticipants,
     // InstanceInstances,
     // InstanceOccurrences,
     // InstanceStats,
  },
  layout: Layout,
  props: {
    instance: Object,
    participants:Object,
    // registrantsStats:Array,
    // participantsStats:Array,
    // instances:Object,
    // occurrences:Object,
   },
 
 mounted(){
  // console.log(this.categories)
 },
  remember: 'form',
  data() {
    return {

      form: this.$inertia.form({
                                  id:this.instance.id,
                                  uuid: this.instance.uuid,
                                  topic: this.instance.topic,
                                  meeting_id: this.instance.meeting_id,
                                  start_time: this.instance.start_time,
                                  official_start_time: this.instance.official_start_time,
                                  official_end_time: this.instance.official_end_time,
                                  
                                  
                              }),
    }
  },
  methods: {
     

    update() {
      this.form.put(this.route('instances.update', this.instance.id))
    },
    destroy() {
      if (confirm('Are you sure you want to delete this instance?')) {
        this.$inertia.delete(this.route('instances.destroy', this.instance.id))
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this instance?')) {
        this.$inertia.put(this.route('instances.restore', this.instance.id))
      }
    },
  },
}
</script>
