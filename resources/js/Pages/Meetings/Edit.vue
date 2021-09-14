<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('meetings')">Meetings</inertia-link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.meeting_id }} / {{form.topic}} 
      </h1>
      
     <div class="flex  justify-between">
       
    
    
    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl flex-2" >
      <form @submit.prevent="update">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          
          <text-input v-model="form.uuid" :error="form.errors.uuid" class="pr-6 pb-8 w-full lg:w-1/2" label="Uuid" />
          
         
          <text-input v-model="form.meeting_id" :error="form.errors.meeting_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Meeting ID" />
         
         <!--  <text-input 
             type="datetime-local"
             v-model="form.start_time" 
             :error="form.errors.start_time" 
             class="pr-6 pb-8 w-full lg:w-1/2" 
             label="Start Time"

             /> -->

           <!--   <label for="birthdaytime">Birthday (date and time):</label>
          <input type="datetime-local" id="birthdaytime"  :error="form.errors.start_time" 
             class="pr-6 pb-8 w-full lg:w-1/2" 
             label="Start Time"name="birthdaytime" :value="form.start_time"> -->
          <text-input v-model="form.topic" :error="form.errors.topic" class="pr-6 pb-8 w-full lg:w-1/2" label="Topic" />
          
          <!-- <text-input v-model="form.guest_speaker" :error="form.errors.guest_speaker" class="pr-6 pb-8 w-full lg:w-1/2" label="Guest Speaker" /> -->
          
          <select-input v-model="form.meeting_type" :error="form.errors.meeting_type" class="pr-6 pb-8 w-full lg:w-1/2" label="Meeting Type" >
              <option  value="Zoom"  >Zoom</option>
              <option  value="Physical" >Physical</option>
          </select-input>
          
          
        </div>  
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
          <button v-if="!meeting.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy"
             
          >Delete Meeting</button>
          <!-- :disabled=" form.meeting_type == 'Zoom'" -->

          <button class="btn-indigo btn-indigo ml-auto" >Zoom Refresh</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit" >Update Meeting</loading-button>
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
 -->       <div>
            <label class="bg-indigo-400  w-full flex flex-row flex-no-wrap p-3"for="">Registrants </label>
             <t-table
                         
                        :headers="['Category','No.']"
                        :responsive=true
                        :data=registrantsStats

              >
                
              </t-table> 

             </div> 

          <div>
            <label class="bg-teal-400  w-full flex flex-row flex-no-wrap p-3"for="">Participants </label>
             <t-table
                         
                        :headers="['Category','No.']"
                        :responsive=true
                        :data=participantsStats

              >
                
              </t-table> 

             </div> 
        </div>
        
      </div>
      
         


  

    </div>
    <!-- <meeting-instances :instances=instances></meeting-instances> -->
    <meeting-occurrences :occurrences=occurrences></meeting-occurrences>
    
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
 import MeetingInstances from './MeetingInstances'
 import MeetingOccurrences from './MeetingOccurrences'

export default {


  metaInfo() {
    return {
      title: `${this.form.meeting_id}`,
    }
  },
  components: {
    LoadingButton,
    SelectInput,
    TextInput,
    TrashedMessage,
     TTable,
     MeetingInstances,
     MeetingOccurrences,
  },
  layout: Layout,
  props: {
    meeting: Object,
    registrantsStats:Array,
    participantsStats:Array,
    instances:Object,
    occurrences:Object,
   },
 
 mounted(){
   console.log(this.categories)
 },
  remember: 'form',
  data() {
    return {

      form: this.$inertia.form({
                                  id:this.meeting.id,
                                  uuid: this.meeting.uuid,
                                  meeting_id: this.meeting.meeting_id,
                                  guest_speaker: this.meeting.guest_speaker,
                                  topic: this.meeting.topic,
                                  start_time: this.meeting.start_time,
                                  meeting_type: this.meeting.meeting_type,
                                  
                                  
                              }),
    }
  },
  methods: {
     

    update() {
      this.form.put(this.route('meetings.update', this.meeting.id))
    },
    destroy() {
      if (confirm('Are you sure you want to delete this meeting?')) {
        this.$inertia.delete(this.route('meetings.destroy', this.meeting.id))
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this meeting?')) {
        this.$inertia.put(this.route('meetings.restore', this.meeting.id))
      }
    },
  },
}
</script>
