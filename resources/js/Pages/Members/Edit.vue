<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('members')">Members</inertia-link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.name }}
      </h1>
    <trashed-message v-if="member.deleted_at" class="mb-6" @restore="restore">
      This member has been deleted.
    </trashed-message>
    
    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
      <form @submit.prevent="update">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          
          <text-input v-model="form.name" :error="form.errors.name" class="pr-6 pb-8 w-full lg:w-1/2" label="name" />
          
         
          <text-input v-model="form.email" :error="form.errors.email" class="pr-6 pb-8 w-full lg:w-1/2" label="Email" />
         
          <text-input v-model="form.phone" :error="form.errors.phone" class="pr-6 pb-8 w-full lg:w-1/2" label="Phone" />
          
          <select-input v-model="form.affiliation_id" :error="form.errors.affiliation_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Affiliation">
            <option :value="null" />
            <option v-for="affiliation in affiliations" :key="affiliation.id" :value="affiliation.id">{{ affiliation.code }}</option>
          </select-input>

          <select-input v-model="form.type_id" :error="form.errors.type_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Type">
            <option v-for="type in types" :key="type.id" :value="type.id">{{ type.code }}</option>
          </select-input>

          <select-input v-model="form.active" :error="form.errors.active" class="pr-6 pb-8 w-full lg:w-1/2" label="Status" >
              <option  value=true  >Active</option>
              <option  value=false >Retired</option>
          </select-input>
          
          
        </div>  
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
          <button v-if="!member.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete member</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update Member</loading-button>
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
      title: `${this.form.name}`,
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
    member: Object,
    affiliations:Object,
    types:Object,
    selected:false

    
  },
  remember: 'form',
  data() {
    return {

      form: this.$inertia.form({
                                  name: this.member.name,
                                  email: this.member.email,
                                  affiliation_id: this.member.affiliation_id,
                                  phone: this.member.phone,
                                  active: this.member.active,
                                  type_id: this.member.type_id,
                                  
                              }),
    }
  },
  methods: {
    update() {
      this.form.put(this.route('members.update', this.member.id))
    },
    destroy() {
      if (confirm('Are you sure you want to delete this member?')) {
        this.$inertia.delete(this.route('members.destroy', this.member.id))
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this member?')) {
        this.$inertia.put(this.route('members.restore', this.member.id))
      }
    },
  },
}
</script>
