<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('meetings.edit',instance.meeting)">Instances</inertia-link>
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
            type="datetime"
              v-model="form.start_time" 
             :error="form.errors.start_time" 
             class="pr-6 pb-8 w-full lg:w-1/2" 
             label="Start Time"

             />

             <text-input 
                type="datetime"            
             v-model="form.official_start_time" 
             :error="form.errors.official_start_time" 
              class="pr-6 pb-8 w-full lg:w-1/2" 
              label="Official Start Time"

             />

             <text-input 
               type="datetime"            
             v-model="form.official_end_time" 
             :error="form.errors.official_end_time" 
             class="pr-6 pb-8 w-full lg:w-1/2" 
             label="Official End Time"

             />
            <!-- <select-input v-model="form.grading_rule_id" :error="form.errors.grading_rule_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Grading Rule" >
              <option v-for="gradingrule in gradingrules" :key="gradingrule.id" :value=gradingrule.id  >{{gradingrule.rule_name}}</option>
            </select-input> -->
             
            
          <input type="checkbox" v-model="form.marked_for_grading"  value="Marked for Grading" label='Marked for Grading'> 
            <label for="Marked For Grading">Marked for grading</label>
          
        </div>  
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit" >Update Instance</loading-button>
        </div>

      </form>
      </div>
        
      <div class=" bg-teal-300  w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-shrink sm:shadow-lg " >
        <!-- <button class="bg-ind m2">
          Generate Participant Template
          </button>  -->
          <div class="m-4">

         
      <table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
      <thead class="text-white">
        <tr  class="bg-indigo-800 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
          <th class="p-3 text-left">Action</th>
          <th class="p-3 text-left">Value</th>
          

         </tr>
        
      </thead>
      <tbody class="flex-1 sm:flex-none">
        <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0" >
          <td class="border-grey-light border hover:bg-gray-100 p-3">  
              <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('instance.generateTemplate',instance.id)">Generate Template</inertia-link>
        </td>
        <td class="border-grey-light border hover:bg-gray-100 p-3">
          
          <a class="text-indigo-400 hover:text-indigo-600" v-if="instance.template" :href="instance.template">Click to download</a></td>


         
		 </tr>
     <tr><td class="text-indigo-400 hover:text-indigo-600 t-center" >Upload Participants</td>
       <td>
            <form @submit.prevent="uploadList">
            <input type="hidden" v-model="instance.id">
            <input type="file" @input="form2.participantList = $event.target.files[0]" />
            <progress v-if="form2.progress" :value="form2.progress.percentage" max="100">
              {{ form2.progress.percentage }}%
            </progress>
           <loading-button :loading="form.processing" class="btn-indigo " type="submit" >Upload List</loading-button>
          </form>
       </td>
       
     </tr>
      </tbody>
    </table>
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
    gradingrules:Array,
    // participantsStats:Array,
    // instances:Object,
    // occurrences:Object,
   },
 
 mounted(){
  // console.log(this.gradingrules)
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
                                  grading_rule_id:this.instance.grading_rule_id,
                                  marked_for_grading:this.instance.marked_for_grading
                                  
                                  
                              }),
    form2: this.$inertia.form({
                                participantList:this.participantList,
                                instance_id:this.instance.id
               })
    }
  },
  methods: {
     
    uploadList(){
      // alert('file uploaded')
      this.form2.post('/instance/uploadParticipants')
    },
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
