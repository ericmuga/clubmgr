<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('makeups')">Makeups</inertia-link>
      <span class="text-indigo-400 font-medium">/</span> Edit / {{form.makeup_date}}
    </h1>
    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
      
      <form @submit.prevent="update">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <text-input v-model="form.name" :error="form.errors.name" class="pr-6 pb-8 w-full lg:w-1/2" label="Name" />
          <!-- <text-input v-model="form.last_name" :error="form.errors.last_name" class="pr-6 pb-8 w-full lg:w-1/2" label="Last name" /> -->
          <text-input v-model="form.email" :error="form.errors.email" class="pr-6 pb-8 w-full lg:w-1/2" label="Email" />
          <text-input v-model="form.description" :error="form.errors.description" class="pr-6 pb-8 w-full lg:w-1/2" label="Description" />
      <text-input v-model="form.makeup_date" :error="form.errors.makeup_date" class="pr-6 pb-8 w-full lg:w-1/2" label="Makeup Date" type="date" />

          <select-input v-model="form.status" :error="form.errors.status" class="pr-6 pb-8 w-full lg:w-1/2" label="Status">
            <option :value="1" selected="">Requested</option>
            <option :value="2">Approved</option>
           
          </select-input>

       
        </div> 
        
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
          <button  class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete Makeup</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update Makeup</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import FileInput from '@/Shared/FileInput'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'

export default {
  metaInfo: { title: 'Edit Makeup' },
  components: {
    FileInput,
    LoadingButton,
    SelectInput,
    TextInput,
  },
  props:{
    makeup:Object
  },
  layout: Layout,
  remakeup: 'form',
  data() {
    return {
      form: this.$inertia.form({  _method:"put",
                                  id:this.makeup.id,
                                  name: this.makeup.name,
                                  email: this.makeup.email,
                                  status:this.makeup.status,
                                  description:this.makeup.description,
                                  makeup_date: this.makeup.makeup_date,
                                  approved_by: this.makeup.approved_by,
                                  approval_date:this.makeup.approval_date,
                                  
                                 
                                }),
    }
  },
  methods: {
   update() {
      this.form.put(this.route('makeups.update', this.makeup.id))
    },
    destroy() {
      if (confirm('Are you sure you want to delete this makeup?')) {
        this.$inertia.delete(this.route('makeups.destroy', this.makeup.id))
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this member?')) {
        this.$inertia.put(this.route('makeups.restore', this.makeup.id))
      }
    },
  },
}
</script>
