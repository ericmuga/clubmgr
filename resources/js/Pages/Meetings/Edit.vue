<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('meetings')">Meetings</inertia-link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.meeting_id }}
      </h1>
     <div class="flex  justify-between">
       
    
    
    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl flex-2" >
      <form @submit.prevent="update">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          
          <text-input v-model="form.uuid" :error="form.errors.uuid" class="pr-6 pb-8 w-full lg:w-1/2" label="Uuid" />
          
         
          <text-input v-model="form.meeting_id" :error="form.errors.meeting_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Meeting ID" />
         
          <text-input v-model="form.start_time" :error="form.errors.start_time" class="pr-6 pb-8 w-full lg:w-1/2" label="Start Time" />
          <text-input v-model="form.topic" :error="form.errors.topic" class="pr-6 pb-8 w-full lg:w-1/2" label="Topic" />
          
          <select-input v-model="form.meeting_type" :error="form.errors.meeting_type" class="pr-6 pb-8 w-full lg:w-1/2" label="Meeting Type" >
              <option  value=Zoom  >Zoom</option>
              <option  value=Zoom >Physical</option>
          </select-input>
          
          
        </div>  
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
          <button v-if="!meeting.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy"
             
          >Delete Meeting</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit" :disabled=" form.meeting_type == 'Zoom'">Update Meeting</loading-button>
        </div>

      </form>

       </div>
          <div class="flex p-3 ml-2 flex-1 bg-white rounded-md shadow overflow-hidden max-w-3xl">
        <div>
          <h1 class="text-indigo-400 ">
            Meeting Statistics
          </h1>
        </div>
          
        
          
        <hr>
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="">Item</th>
          <th class="">Value</th>
          
        </tr>
        <tr  class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            Duration
          </td>
          <td class="border-t">
           40 Mins
          </td>
      </tr>

       <tr  class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            Registrants
          </td>
          <td class="border-t">
           12
          </td>
      </tr>

       <tr  class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            Participants
          </td>
          <td class="border-t">
           10
          </td>
      </tr>

      <tr  class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            Rotarians
          </td>
          <td class="border-t">
           8
          </td>
      </tr>


      <tr  class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            Rotaractors
          </td>
          <td class="border-t">
           1
          </td>
      </tr>


      <tr  class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            Guest
          </td>
          <td class="border-t">
           1
          </td>
      </tr>
    </table>
  

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
  },
  layout: Layout,
  props: {
    meeting: Object
   },

  remember: 'form',
  data() {
    return {

      form: this.$inertia.form({
                                  id:this.meeting.id,
                                  uuid: this.meeting.uuid,
                                  meeting_id: this.meeting.meeting_id,
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
