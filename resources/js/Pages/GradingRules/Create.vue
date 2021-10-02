
<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('gradingrules')">Grading Rules</inertia-link>
      <span class="text-indigo-400 font-medium">/</span> Create
    </h1>
    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
      
      <form @submit.prevent="store">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <text-input v-model="form.rule_name" :error="form.errors.rule_name" class="pr-6 pb-8 w-full lg:w-1/2" label="Rule Name" />
          <!-- <text-input v-model="form.last_name" :error="form.errors.last_name" class="pr-6 pb-8 w-full lg:w-1/2" label="Last name" /> -->
          <text-input v-model="form.description" :error="form.errors.description" class="pr-6 pb-8 w-full lg:w-1/2" label="Description" />

          <text-input type="number" v-model="form.threshhold" :error="form.errors.threshhold" class="pr-6 pb-8 w-full lg:w-1/2" label="Threshhold" />

          <select-input v-model="form.meeting_type" :error="form.errors.meeting_type" class="pr-6 pb-8 w-full lg:w-1/2" label="Meeting Type">
            <option :value="1">Zoom</option>
            <option :value="2">Physical</option>
          </select-input>

           

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
  metaInfo: { title: 'Create Rule' },
  components: {
    FileInput,
    LoadingButton,
    SelectInput,
    TextInput,
  },
  layout: Layout,
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        rule_name: null,
        meeting_type: null,
        description: null,
        threshhold: null,
       
       
      }),
    }
  },
  methods: {
    store() {
      this.form.post(this.route('gradingrules.store'))
    },
  },
}
</script>
