
<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('members')">Members</inertia-link>
      <span class="text-indigo-400 font-medium">/</span> Create
    </h1>
    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
      
      <form @submit.prevent="store">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <text-input v-model="form.name" :error="form.errors.name" class="pr-6 pb-8 w-full lg:w-1/2" label="Name" />
          <text-input v-model="form.member_id" :error="form.errors.member_id" class="pr-6 pb-8 w-full lg:w-1/2" label="participant ID" />
          <!-- <text-input v-model="form.last_name" :error="form.errors.last_name" class="pr-6 pb-8 w-full lg:w-1/2" label="Last name" /> -->
          <text-input v-model="form.email" :error="form.errors.email" class="pr-6 pb-8 w-full lg:w-1/2" label="Email" />

          <text-input v-model="form.phone" :error="form.errors.phone" class="pr-6 pb-8 w-full lg:w-1/2" label="Phone" />
          <text-input v-model="form.sector" :error="form.errors.sector" class="pr-6 pb-8 w-full lg:w-1/2" label="Sector" />

          <select-input v-model="form.type_id" :error="form.errors.type_id" class="pr-6 pb-8 w-full lg:w-1/2" label="participant Type">
            <option :value="1">participant</option>
            <option :value="2">Inductee</option>
          </select-input>

           <select-input v-model="form.affiliation_id" :error="form.errors.affiliation_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Affiliation">
            <option :value="1">Rotatian</option>
            <option :value="2">Rotaractor</option>
            <option :value="3">Guest</option>
          </select-input>

          <select-input v-model="form.active" :error="form.errors.active" class="pr-6 pb-8 w-full lg:w-1/2" label="Status">
            <option :value="true">Active</option>
            <option :value="false">Retired</option>
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
  metaInfo: { title: 'Create User' },
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
        name: null,
        type_id: null,
        affiliation_id: null,
        email: null,
        active:false,
        phone:null,
        member_id:null,
        sector:null,
       
      }),
    }
  },
  methods: {
    store() {
      this.form.post(this.route('members.store'))
    },
  },
}
</script>
