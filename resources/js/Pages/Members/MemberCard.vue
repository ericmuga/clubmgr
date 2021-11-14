<template>
<!-- component -->
<!-- <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
 -->
<section class="pt-6 bg-blueGray-50">
<div class="w-full lg:w-4/12 px-4 mx-auto">
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
                22
              </span>
              <span class="text-sm text-blueGray-400">Meetings</span>
            </div>
            <div class="mr-4 p-3 text-center">
              <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                10
              </span>
              <span class="text-sm text-blueGray-400">Make-ups</span>
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
        <div class="mb-2 text-blueGray-600 mt-10">
          <i class="fas fa-briefcase mr-2 text-lg text-blueGray-400"></i>
          Solution Manager - Creative Tim Officer
        </div>
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
      <div class="flex border-t border-blueGray-200">
      	<div class="bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="p-8   flex flex-wrap">
          
          <text-input v-model="form.name" :error="form.errors.name" class="pr-6 pb-8 w-full lg:w-1/2" label="name" />
          <text-input v-model="form.member_id" :error="form.errors.member_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Member ID" />
          
         
          <text-input v-model="form.email" :error="form.errors.email" class="pr-6 pb-8 w-full lg:w-1/2" label="Email" />
         
          <text-input v-model="form.phone" :error="form.errors.phone" class="pr-6 pb-8 w-full lg:w-1/2" label="Phone" />
          <text-input v-model="form.sector" :error="form.errors.sector" class="pr-6 pb-8 w-full lg:w-1/2" label="Sector" />
          
          <select-input v-model="form.affiliation_id" :error="form.errors.affiliation_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Affiliation">
            <option :value="null" />
            <option v-for="affiliation in affiliations" :key="affiliation.id" :value="affiliation.id">{{ affiliation.code }}</option>
          </select-input>

          <select-input v-model="form.type_id" :error="form.errors.type_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Type">
            <option v-for="type in types" :key="type.id" :value="type.id">{{ type.code }}</option>
          </select-input>

          <select-input v-model="form.active" :error="form.errors.active" class="pr-6 pb-8 w-full lg:w-1/2" label="Status" >
              <option  :value=1  >Active</option>
              <option  :value=0 >Retired</option>
          </select-input>
          
          
        </div>  
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
          <button v-if="!member.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete member</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update Member</loading-button>
        </div>

      </form>
    </div>
      </div>
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

import TrashedMessage from '@/Shared/TrashedMessage'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
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
        url:'https://www.gravatar.com/avatar/'+this.member.hashemail+'/?s=100'
    };
  },
};
</script>

<style l