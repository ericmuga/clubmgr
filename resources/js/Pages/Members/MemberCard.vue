<template>
<!-- component -->
<!-- <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
 -->
<section class="bg-blueGray-50">
  <h1 class="font-bold text-1xl bg-gray-50 p-6 m-2">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('members')">Members</inertia-link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.name }}
  </h1>
<div class="w-full lg:w-12/12 px-4 flex justify-between">
  <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg mt-16">
    <div class="px-4">
      <div class="flex flex-wrap justify-center">
        <div class="w-full px-4 flex justify-center">
          <div class="ml-8">
            <img alt="..." :src="url" class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-12 -ml-8 lg:-ml-16">
          </div>
        </div>
        <div class="w-full px-4 text-center mt-20">
          <div class="flex justify-center py-4 lg:pt-4 pt-8">
            <div class="mr-4 p-3 text-center">
              <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                {{member.instances_attended}}
              </span>
              <span class="text-sm text-blueGray-400">Attended</span>
            </div>
            <div class="mr-4 p-3 text-center">
              <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                {{member.marked_present}}
              </span>
              <span class="text-sm text-blueGray-400">Marked Present</span>
            </div>
            <div class="lg:mr-4 p-3 text-center">
              <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                89
              </span>
              <span class="text-sm text-blueGray-400">Comments</span>
            </div>
          </div>
        </div>
      </div>
      <div class="text-center mt-12">
        <h3 class="text-xl font-semibold leading-normal mb-2 text-blueGray-700 mb-2">
         {{member.name}}
        </h3>
        <div class="text-sm leading-normal mt-0 mb-2 text-blueGray-400 font-bold uppercase">
          <i class="fas fa-map-marker-alt mr-2 text-lg text-blueGray-400"></i>
          {{member.affiliation}}
        </div>
        <!-- <div class="mb-2 text-blueGray-600 mt-10">
          <i class="fas fa-briefcase mr-2 text-lg text-blueGray-400"></i>
          Solution Manager - Creative Tim Officer
        </div> -->
        <div class="mb-2 text-blueGray-600">
          <i class="fas fa-university mr-2 text-lg text-blueGray-400"></i>
          {{member.sector}}
        </div>
      </div>
      <!-- <div class="mt-10 py-10 border-t border-blueGray-200 text-center">
        <div class="flex flex-wrap justify-center">
          <div class="w-full lg:w-9/12 px-4">
            <p class="mb-4 text-lg leading-relaxed text-blueGray-700">
              An artist of considerable range, Jenna the name taken
              by Melbourne-raised, Brooklyn-based Nick Murphy
              writes, performs and records all of his own music,
              giving it a warm, intimate feel with a solid groove
              structure. An artist of considerable range.
            </p>
            <a href="javascript:void(0);" class="font-normal text-pink-500">
              Show more
            </a>
          </div>
        </div>
      </div> -->
       </div>
         </div>
      <div class="flex border-t border-blueGray-200 ml-2">

      	<div class="bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="p-6   flex flex-wrap">
          
          <text-input v-model="form.name" :error="form.errors.name" class="pr-6 pb-8 w-full lg:w-1/2" label="Name" />
          <text-input v-model="form.member_id" :error="form.errors.member_id" class="pr-6 pb-4 w-full lg:w-1/2" label="Member ID" />
          
         
          <!-- <text-input v-model="form.email" :error="form.errors.email" class="pr-6 pb-4 w-full lg:w-1/2" label="Email" />
         
          <text-input v-model="form.phone" :error="form.errors.phone" class="pr-6 pb-4 w-full lg:w-1/2" label="Phone" /> -->
          <text-input v-model="form.sector" :error="form.errors.sector" class="pr-6 pb-4 w-full lg:w-1/2" label="Sector" />
          
          <select-input v-model="form.affiliation_id" :error="form.errors.affiliation_id" class="pr-6 pb-4 w-full lg:w-1/2" label="Affiliation">
            <option :value="null" />
            <option v-for="affiliation in affiliations" :key="affiliation.id" :value="affiliation.id">{{ affiliation.code }}</option>
          </select-input>

          <select-input v-model="form.type_id" :error="form.errors.type_id" class="pr-6 pb-4 w-full lg:w-1/2" label="Type">
            <option v-for="type in types" :key="type.id" :value="type.id">{{ type.code }}</option>
          </select-input>

          <select-input v-model="form.active" :error="form.errors.active" class="pr-6 pb-4 w-full lg:w-1/2" label="Status" >
              <option  :value=1  >Active</option>
              <option  :value=0 >Retired</option>
          </select-input>
<button>
                   <inertia-link 
                          class="text-indigo-400 hover:text-indigo-600 border-b" 
                          :href="route('member.contacts',member.id)"
                   >CONTACTS
               </inertia-link>  
             </button>
          <div class="bg-white border-t w-full ">
             
                
            <div class="flex flex-col">
              <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                  <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                      
                      <tbody class="bg-white divide-y divide-gray-200">

                        <tr v-for="contact in member.contacts" :key="contact.id">
                          <td class="px-6 py-2 whitespace-nowrap">
                            <div class="flex items-center">
                              <div v-if="contact.contact_type==='email'" class="flex-shrink-0  w-10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                              </svg>
                            </div>
                             <div v-else class="flex-shrink-0  w-10">
                               <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                              </svg>
                              </svg>
                            </div>

                              <!-- <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                  {{contact.type}}
                                </div>
                                <div class="text-sm text-gray-500">
                                  
                                </div>
                              </div> -->
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{contact.contact}}</div>
                          </td>
                         
                        </tr>

                        <!-- More people... -->
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

      </div>
          
        </div>  
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
          <button v-if="!member.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete member</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update Member</loading-button>
        </div>
 
      </form>
     
        <trashed-message v-if="member.deleted_at" class="mb-6" @restore="restore">
            This member has been deleted.
              <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
                <button class="text-red-600 hover:underline" tabindex="-1" type="button" @click="restore">Restore member</button>
              </div>
         
        </trashed-message>
    </div>
      </div>
   

</div>
<!-- <footer class="relative  pt-8 pb-6 mt-8">
  <div class="container mx-auto px-4">
    <div class="flex flex-wrap items-center md:justify-between justify-center">
      <div class="w-full md:w-6/12 px-4 mx-auto text-center">
        <div class="text-sm text-blueGray-500 font-semibold py-1">
          Made with <a href="https://www.creative-tim.com/product/notus-js" class="text-blueGray-500 hover:text-gray-800" target="_blank">Notus JS</a> by <a href="https://www.creative-tim.com" class="text-blueGray-500 hover:text-blueGray-800" target="_blank"> Creative Tim</a>.
        </div>
      </div>
    </div>
  </div>
</footer> -->
</section>
</template>

<script>
import Layout from '@/Shared/Layout'
import {Link } from '@inertiajs/inertia-vue'
import TrashedMessage from '@/Shared/TrashedMessage'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
// import VueModal from "vue2-modal"

export default {
metaInfo() {
    return {
      title: `${this.form.name}`,
    }
  },
mounted()
{
  console.log(this.gravatarurl)
},
  name: 'MemberCard',
  components:{
  	 LoadingButton,
    SelectInput,
    TextInput,
  },
 layout: Layout,
 
 props: {
   member:Object,
   // member: Object,
    affiliations:Object,
    types:Object,
    selected:false,
},
  // computed: {
  //   gravatarurl() {
  //     return 'https://www.gravatar.com/avatar/'+this.hashemail+'/'
  //   },
  // },
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
                                  sector:this.member.sector
                                  
                              }),
        url:'https://www.gravatar.com/avatar/'+this.member.hashemail+'/?s=100',
        url2:'https://www.gravatar.com/avatar/'+this.member.hashemail+'/',
    };
  },
};
</script>

<style l