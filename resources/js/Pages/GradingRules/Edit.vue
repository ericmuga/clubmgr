
<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('gradingrules')">Grading Rules</inertia-link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.rule_name }}
      </h1>
   
    
    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
      <form @submit.prevent="update">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          
          <text-input v-model="form.rule_name" :error="form.errors.rule_name" class="pr-6 pb-8 w-full lg:w-1/2" label="Rule Name" />
          
         
          <text-input v-model="form.description" :error="form.errors.description" class="pr-6 pb-8 w-full lg:w-1/2" label="Description" />
         
          <text-input v-model="form.threshhold" :error="form.errors.threshhold" class="pr-6 pb-8 w-full lg:w-1/2" label="Threshhold" />
          
          <select-input v-model="form.meeting_type" :error="form.errors.meeting_type" class="pr-6 pb-8 w-full lg:w-1/2" label="Meeting Type" >
              <option  value=1  >Zoom</option>
              <option  value=2 >Physical</option>
          </select-input>
          
          
        </div>  
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
          <button v-if="!gradingrule.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete Rule</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update Rule</loading-button>
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

export default {


  metaInfo() {
    return {
      title: `${this.form.rule_name}`,
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
    gradingrule: Object,
    // affiliations:Object,
    // types:Object,
    // selected:false

    
  },
  remember: 'form',
  data() {
    return {

      form: this.$inertia.form({
                                  rule_name: this.gradingrule.rule_name,
                                  description: this.gradingrule.description,
                                  meeting_type: this.gradingrule.meeting_type,
                                  threshhold: this.gradingrule.threshhold,
                                  
                              }),
    }
  },
  methods: {
    update() {
      this.form.put(this.route('gradingrules.update', this.gradingrule.id))
    },
    destroy() {
      if (confirm('Are you sure you want to delete this grading rule?')) {
        this.$inertia.delete(this.route('gradingrules.destroy', this.gradingrule.id))
      }
    },
    
  },
}
</script>