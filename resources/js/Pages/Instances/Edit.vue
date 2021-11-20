<template>
  <div>
    <h1 class="mb-2 p-2 bg-gray-50 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('meetings.edit',instance.meeting)">Instances</inertia-link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.id }}
      </h1>
      
     <div class="flex  justify-between">
       
    
    
    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl flex-2" >
      <form @submit.prevent="update">
        <div class="p-2 -mr-6  flex flex-wrap">
          
          
             <text-input 
                type="datetime"            
             v-model="form.official_start_time" 
             :error="form.errors.official_start_time" 
              class="pr-6 pb-4 w-full lg:w-1/2" 
              label="Official Start Time"

             />

             <text-input 
               type="datetime"            
             v-model="form.official_end_time" 
             :error="form.errors.official_end_time" 
             class="pr-6 pb-4 w-full lg:w-1/2" 
             label="Official End Time"

             />
            <!-- <select-input v-model="form.grading_rule_id" :error="form.errors.grading_rule_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Grading Rule" >
              <option v-for="gradingrule in gradingrules" :key="gradingrule.id" :value=gradingrule.id  >{{gradingrule.rule_name}}</option>
            </select-input> -->
             
            
          <input type="checkbox" v-model="form.marked_for_grading"  value="Marked for Grading" label='Marked for Grading'> 
            <label for="Marked For Grading">Marked for grading</label>
          
        </div>  
        <div class="px-8 py-2 bg-gray-50 border-t border-gray-100 flex items-center">
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit" >Update</loading-button>
        </div>

      </form>
      </div>
        
      <div class=" m-2 bg-teal-300  w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-shrink sm:shadow-lg " >
        <!-- <button class="bg-ind m2">
          Generate Participant Template
          </button>  -->
          <div class="m-4 flex">
          <div class="p-2 pb-1 m-2 bg-gray-500 h-sm text-white rounded text-center hover:border-teal-700">
            Total <div><br><span class="">{{instance.total}}</span></div>
            <br>
            <div class="mb-1">Present</div> <br> <div><span class="rounded-full p-1 text-bold text-white bg-orange-500">{{Math.round(instance.marked_present/instance.total*100,1)}}%</span></div>

          </div>
          <div class="p-2 m-2 bg-gray-500 h-sm text-white rounded text-center hover:border-teal-700">
            Present <div><br><span class="">{{instance.marked_present}}</span></div>
            <br>
            <div class="mb-1">Absent</div> <br> <div><span class="text-white">{{instance.marked_absent}}</span></div>

          </div>
          
         
          <div class=" px-1">
            <card-stats
              statSubtitle="Members"
              :statTitle="instance.members"
              statArrow=""
              :statPercent="instance.members_present"
              statPercentColor="text-red-500"
              statDescripiron="Present"
              statIconName="fas fa-percent"
              statIconColor="bg-indigo-500"
            />
          </div>
           <div class=" px-1">
            <card-stats
              statSubtitle="Rotarians"
              :statTitle="instance.Rotarian"
              statArrow=""
              :statPercent="instance.Rotarian_present"
              statPercentColor="text-red-500"
              statDescripiron="Present"
              statIconName="fas fa-percent"
              statIconColor="bg-gray-500"
            />
          </div>
          <div class=" px-1">
            <card-stats
              statSubtitle="Rotaractors"
              :statTitle="instance.Rotaractor"
              statArrow=""
              :statPercent="instance.Rotaractor_present"
              statPercentColor="text-red-500"
              statDescripiron="Present"
              statIconName="fas fa-percent"
              statIconColor="bg-green-500"
            />
          </div>
          <div class=" px-1">
            <card-stats
              statSubtitle="guests"
              :statTitle="instance.guests"
              statArrow=""
              :statPercent="instance.guests_present"
              statPercentColor="text-red-500"
              statDescripiron="Present"
              statIconName="fas fa-percent"
              statIconColor="bg-indigo-600"
            />
          </div>
          
        </div>
      </div>
      
         


  

    </div>
    <!-- <instance-instances :instances=instances></instance-instances> -->
    <!-- <instance-occurrences :occurrences=occurrences></instance-occurrences> -->
    <div class="flex justify-betwee bg-gray-100 p-1">
      <div class="bg-gray-200 px-6 py-2 m-2  rounded-md w-full">
        <h1 class="p-5 bg-gray-50 font-bold text-md text-center text-indigo-400">Attendees </h1>
        <instance-participants :participants="participants" :members="members" :filters="filters" :instance="instance"></instance-participants>
      </div>

       <div class="bg-gray-200 px-6 py-2 m-2 rounded-md">
         <h1 class="p-5 bg-gray-50 font-bold text-md text-center text-orange-400">Mark Attendance </h1>
         <MemberForm :members="members" :filters="filters2" :instance="instance"></MemberForm>
      </div>
    </div>
    
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
 import CardStats from "../Dashboard/CardStats.vue";
 import MemberForm from './MemberForm.vue'
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
     CardStats,
     MemberForm,
     // InstanceInstances,
     // InstanceOccurrences,
     // InstanceStats,
  },
  layout: Layout,
  props: {
    instance: Object,
    members:Object,
    participants:Object,
    gradingrules:Array,
    filters:Object,
    filters2:Object,
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
