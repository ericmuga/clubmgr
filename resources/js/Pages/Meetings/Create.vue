<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('meetings')">Meetings</inertia-link>
      <span class="text-indigo-400 font-medium">/</span> Create /{{form.meeting_id}}
    </h1>
    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
      
      

      <form @submit.prevent="store">
        
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
           <text-input v-model="form.topic" :error="form.errors.topic" class="pr-6 pb-8 w-full lg:w-1/2" label="Topic" />
          <text-input v-model="form.guest_speaker" :error="form.errors.guest_speaker" class="pr-6 pb-8 w-full lg:w-1/2" label="Guest Speaker"
 />
          <text-input type="datetime-local" v-model="form.start_time" :error="form.errors.start_time" class="pr-6 pb-8 w-full lg:w-1/2" label="Start Time" />

           <select-input v-model="form.meeting_type" :error="form.errors.meeting_type" class="pr-6 pb-8 w-full lg:w-1/2" label="Meeting Type"> 
            <option :value="1">Zoom</option>
            <option :value="2">Physical</option>
            
          </select-input>

          <text-input v-model="form.meeting_id" :error="form.errors.meeting_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Meeting ID"
           disabled t/>

          

         
           <!-- <select-input v-model="form.affiliation_id" :error="form.errors.affiliation_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Affiliation">
            <option :value="1">Rotatian</option>
            <option :value="2">Rotaractor</option>
            <option :value="3">Guest</option>
          </select-input>

          <select-input v-model="form.active" :error="form.errors.active" class="pr-6 pb-8 w-full lg:w-1/2" label="Status">
            <option :value="true">Active</option>
            <option :value="false">Retired</option>
           </select-input> -->
         <!--  <text-input v-model="form.password" :error="form.errors.password" class="pr-6 pb-8 w-full lg:w-1/2" type="password" autocomplete="new-password" label="Password" />
          <select-input v-model="form.owner" :error="form.errors.owner" class="pr-6 pb-8 w-full lg:w-1/2" label="Owner">
            <option :value="true">Yes</option>
            <option :value="false">No</option>
          </select-input>
          <file-input v-model="form.photo" :error="form.errors.photo" class="pr-6 pb-8 w-full lg:w-1/2" type="file" accept="image/*" label="Photo" />-->
        </div> 
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create</loading-button>
        </div>
      </form>
    </div class="flex-1 justify-between">
      <!-- <table>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>RI Number</th>
        <th>Member Ship</th>
        <th>Club Name</th>
        <th>Mark Present</th>
        <tr v-for="registrant in registrants.data" :key=registrants.id>
          <td>{{registrant.first_name}}</td>
          <td>{{registrant.last_name}}</td>
          <td>{{registrant.email}}</td>
          <td>{{registrant.ri_number}}</td>
          <td>{{registrant.membership}}</td>
          <td>{{registrant.club_name}}</td>
          <td><input type="checkbox"></td>
        </tr>
      </table>
       -->
       <!-- <pagination class="mt-4" :links="registrants.links" /> -->
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import FileInput from '@/Shared/FileInput'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import Pagination from '@/Shared/Pagination'

export default {
  metaInfo: { title: 'Create Meeting' },
  components: {
    FileInput,
    LoadingButton,
    SelectInput,
    TextInput,
    Pagination,
  },
  props:{
    meeting_prefix:null,
    registrants:Object,
    last_meeting_no:null,
  },
  layout: Layout,
  remember: 'form',

  
  mounted(){

  },
  data() {
    return {
      form: this.$inertia.form({
                                meeting_id:null,
                                uuid: null,
                                guest_speaker: null,
                                start_time: null,
                                meeting_type: null,
                                topic:null
        // phone:null,
       
                                   }),
    }
  },
  methods: {
    store() {
      this.form.post(this.route('meetings.store'))
    },
 
    getMeetingID() {
      let lmn=this.last_meeting_no+1;
      this.form.meeting_id=this.meeting_prefix+lmn;
     
    }
  },
   
  
}
</script>
