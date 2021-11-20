<template>
  <div class="flex bg-blue-500">
    <!-- <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('members')">Members</inertia-link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.name }}
      </h1> -->
    <!-- <trashed-message v-if="member.deleted_at" class="mb-6" @restore="restore">
      This member has been deleted.
    </trashed-message> -->
     <div class="flex flex-col 
      ">
       <MemberCard :member="member"/>
       <!-- <MemberCard :member="member"/> -->

   
    
    
      </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'

import TrashedMessage from '@/Shared/TrashedMessage'
import MemberCard from './MemberCard'
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
    MemberCard,
  },
  layout: Layout,
  props: {
    member: Object,
    affiliations:Object,
    types:Object,
    selected:false,

    
  },
  remember: 'form',
  data() {
    return {

      form: this.$inertia.form({
                                  name: this.member.name,
                                  //email: this.member.email,
                                  affiliation_id: this.member.affiliation_id,
                                 // phone: this.member.phone,
                                  active: this.member.active,
                                  type_id: this.member.type_id,
                                  sector:this.member.sector
                                  
                              }),
    }
  },
 
}
</script>
