<template>
    <div>
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
         
          <td class="border-grey-light border hover:bg-gray-100 p-1 truncate">
             
            <!-- <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('members.edit',member.id)"> -->
             {{ member.name }}
             
              <!-- </inertia-link> -->
             </td>
          <td class="border-grey-light border hover:bg-gray-100 p-1 "> {{ member.email }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-1 text-center"> 
          

          	<Link :href="route('instance.addParticipant')" 
          	      method="post" 
          	      :data="{ member:member, instance:instance.id }" 
          	      as="button" 
          	      type="button">

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
<!-- <pagination class="mt-4" :links="members.links"  /> -->
</div>

</template>

<script>
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'
import pickBy from 'lodash/pickBy'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import { Link } from '@inertiajs/inertia-vue'

export default {

  name: 'MemberForm',


  props:{
  	members:Object,
  	  filters:Object,
    instance:Object,
  },
  components:{
  	Pagination,
  	SearchFilter,
  	Link,
  },

  data () 
   {
   return {
            form2: {
              search2: this.filters.search2,
              trashed2: this.filters.trashed2,
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
}
}
</script>

<style lang="css" scoped>
</style>