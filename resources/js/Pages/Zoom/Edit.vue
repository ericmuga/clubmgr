<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('setup')">Zoom </inertia-link>
      <span class="text-indigo-400 font-medium">/Setup</span>
      {{ form.id }}
      </h1>
   
    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
      <form @submit.prevent="update">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          
          <text-input v-model="form.client_id" :error="form.errors.client_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Client Id" />
          
         
          <text-input v-model="form.client_secret" :error="form.errors.client_secret" class="pr-6 pb-8 w-full lg:w-1/2" label="Client Secret" />
         
          <text-input v-model="form.environment" :error="form.errors.environment" class="pr-6 pb-8 w-full lg:w-1/2" label="Environment" />

           <text-input v-model="form.callback_url" :error="form.errors.callback_url" class="pr-6 pb-8 w-full lg:w-1/2" label="Callback URL" />
          
          

          <select-input v-model="form.current" :error="form.errors.current" class="pr-6 pb-8 w-full lg:w-1/2" label="Current" >
              <option :value="null" />
              <option  :value=true >Yes</option>
              <option  :value=false>No</option>
          </select-input>
          
          
        </div>  
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
          <button  class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete Setup</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update Setup</loading-button>
        </div>

      </form>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import TrashedMessage from '@/Shared/TrashedMessage'
import axios from 'axios'

export default {


  metaInfo() {
    return {
      title: `${this.form.id}`,
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

    setup: Object,
    
    
  },
  remember: 'form',
  data() {
    return {

      form: this.$inertia.form({   _method: 'put',
                                  client_id: this.setup.client_id,
                                  client_secret: this.setup.client_secret,
                                  environment: this.setup.environment,
                                  callback_url: this.setup.callback_url,
                                  current: this.setup.current?true:false,
                                  
                                  
                              }),
    }
  },
  methods: {
    update() {
        //console.log(this.form);
        //axios.put('/zoom/'+this.setup.id)

      this.form.post(this.route('setup.update', this.setup.id))
    },
    destroy() {
      if (confirm('Are you sure you want to delete this setup?')) {
        this.$inertia.delete(this.route('setup.destroy', this.setup.id))
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this setup?')) {
        this.$inertia.put(this.route('setup.restore', this.setup.id))
      }
    },
  },
}
</script>
