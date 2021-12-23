<template>
    <div>
    	 <div class="flex justify-between">
        <div class="w-md">
    	<div class="m-2 p-2 bg-gray-50 flex justify-between items-center max-w-md">
          <search-filter v-model="form2.search2" class="max-w-md mr-4" @reset="reset">
            <label class="block text-gray-700">Trashed:</label>
            <select v-model="form2.trashed2" class="mt-1 w-full form-select">
              <option :value="null" />
              <option value="with">With Trashed</option>
              <option value="only">Only Trashed</option>
            </select>
          </search-filter>
         </div>

     

	 <table class="w-md flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
      <thead class="text-white">
        <tr v-for="member in members.data" :key="member.id" class="bg-teal-400 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
          <!-- <th class="p-3 text-left">ID</th> -->
          <th class="p-3 text-left">Name</th>
          <th class="p-3 text-left">Email</th>
          <th class="p-3 text-left">Mark Present</th>
          </tr>
        
      </thead>
      <tbody class="flex-1 sm:flex-none">
        <tr class="flex flex-col flex-no wrap sm:table-row  sm:mb-0"  v-for="member in members.data" :key="member.id">
         
          <td class="border-grey-light border hover:bg-gray-100 text-sm truncate">
             
            <!-- <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('members.edit',member.id)"> -->
             {{ member.name }}
             
              <!-- </inertia-link> -->
             </td>
          <td class="border-grey-light border hover:bg-gray-100 text-sm  "> {{ member.email }}</td>
          <td class="border-grey-light border hover:bg-gray-100 text-center text-sm" > 
          

          	<Link :href="route('instance.addParticipant')" 
          	      method="post" 
          	      :data="{ member:member, instance:instance.id }" 
          	      as="button" 
          	      type="button"
                  preserve-scroll
          	    >

             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
				</svg>

          </Link>
          	
		</td>
          
         
        <tr v-if="members.data.length === 0">
          <td class="border-t px-2 py-4" colspan="4">No members found.</td>
        </tr>
      </tbody>
    </table>

    <pagination class="mt-4" :links="members.links" /></pagination>
   </div>
        <div class="w-full p-4 m-2 bg-gray-50 justify-between">
    	 	<form  @submit.prevent="store">
    	 		<h1 class="w-full bg-gray-100 text-center text-md p-2 text-bold">Add Member</h1>
    	 		<t-input
		              type="text"
		              required
		              placeholder="name"
		              class="rounded-lg my-1 text-sm"
		              v-model="participant.name"
		    	 	>
		    	</t-input>
		    	<!-- <div v-if="paricipant.errors.name" class="form-error">{{paricipant.errors.name }}</div> -->
		    	<t-input
		              type="email"
		              required
		              placeholder="email"
		              class="rounded-lg my-1 text-sm"
		              v-model="participant.contact"
		    	 	>
		    	</t-input>
		    	<!-- <div v-if="paricipant.errors.contact" class="form-error">{{paricipant.errors.contact }}</div> -->
		    	<t-select
		              type="text"
		               placeholder="Gender"
		               class="rounded-lg my-1 text-sm"
		              :options="[{ value: M, text: 'Male' },
								  { value: F, text: 'Female' },
								  ]"
		              v-model="participant.category"
		    	 	>
		    	</t-select>

		    	<t-select
		              type="text"
		               placeholder="Type"
		               class="rounded-lg my-1 text-sm"
		              :options="[
								  { value: 1, text: 'Member' },
								  { value: 2, text: 'Inductee' },
								  { value: 3, text: 'Guest' }
								]"
		              v-model="participant.membership"
		    	 	>
		    	</t-select>
		    	<t-input
		              type="text"
		              placeholder="RI Number"
		              class="rounded-lg my-1 text-sm"
		              v-model="participant.member_id"
		    	 	>
		    	</t-input>

		    	<t-input
		              type="text"
		              placeholder="club_name"
		              class="rounded-lg my-1 text-sm"
		              v-model="participant.club_name"
		    	 	>
		    	</t-input>
		    	<t-input
		              type="text"
		              placeholder="sector"
		              class="rounded-lg m-y1 text-sm"
		              v-model="participant.sector"
		    	 	>
		    	</t-input>
		    	<t-input
		              type="text"
		              placeholder="Invited By"
		              class="rounded-lg m-y1 text-sm"
		              v-model="participant.invited_by"
		    	 	>
		    	</t-input>
		    	

		    	<t-select
		              type="text"
		               placeholder="Affiliation"
		               class="rounded-lg my-1 text-sm"
		              :options="[{ value: 1, text: 'Rotarian' },
								  { value: 2, text: 'Rotaractor' },
								  { value: 3, text: 'Guest' }]"
		              v-model="participant.category"
		    	 	>
		    	</t-select>


                <div class="flex justify-center p-2 mt-1 items-center">
                
                <t-button
                  type="submit"
                  class="bg-teal-500 text-bold m-1 items-center"
                  :disabled="participant.processing" 
                 >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
				  <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
				</svg>	
				<div v-if="participant.processing" class="btn-spinner mr-2" />
                </t-button>
                	<t-button
	                  type="button"
	                  @click="resetform"
	                  class="bg-teal-500 text-bold m-1 items-center"
					>
	                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
					  <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
					</svg>
                </t-button>

                </div>
                
    	 	</form>
    	 	
    	 </div>
    	 </div>
</div>

</template>

<script>
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'
import pickBy from 'lodash/pickBy'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import { Link } from '@inertiajs/inertia-vue'
import {TInput,TButton,TSelect}from 'vue-tailwind/dist/components'

export default {

  name: 'MemberForm',

mounted()
{
	console.log(errors)
},
  props:{
  	members:Object,
  	  filters:Object,
    instance:Object,
  },
  components:{
  	Pagination,
  	SearchFilter,
  	Link,
  	TInput,
  	TSelect,
  	TButton,
  },

  data () 
   {
   return {
            form2: {
              search2: this.filters.search2,
              trashed2: this.filters.trashed2,
            },
            participant:{
            	name:'',
            	contact:'',
            	club_name:'',
            	category:'',
            	member_id:null,
            	sector:'',
            	category:'',
            	instance_id:this.instance.id,
            	invited_by:''
            }
          }
  },

watch: {
    form2: {
      deep: true,
      handler: throttle(function() {
          this.$inertia.get(this.route('instances.edit',this.instance.id), pickBy(this.form2), { preserveState: true  })
        //alert(this.form2.search2)
      }, 150),
    },
  },

  methods: {
    reset() {
       this.form2 = mapValues(this.form2, () => null)
    },
    resetform() {
       //alert('fired');
       this.participant = mapValues(this.participant, () => null)
    },

    store() {
      //alert('here');
      this.$inertia.post(this.route('instance.addNewParticipant'),pickBy(this.participant),{preserveScroll:true});
      resetform();
    },
  }
}
</script>

<style lang="css" scoped>
</style>