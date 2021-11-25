<template>

	<div class="flex items-center">
  

  <div class="container">
       <div class="m-2 p-2 bg-gray-50 flex justify-between items-center max-w-md">
          <search-filter v-model="form.search" class="max-w-md mr-4" @reset="reset">
            <label class="block text-gray-700">Trashed:</label>
            <select v-model="form.trashed" class="mt-1 w-full form-select">
              <option :value="null" />
              <option value="with">With Trashed</option>
              <option value="only">Only Trashed</option>
            </select>
          </search-filter>
        </div> 
        <!-- <advanced-filter @set-advanced-filters="setFilters"></advanced-filter> -->
   
    <table class="w-md flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-1">
      <thead class="text-white">
        <tr v-for="participant in participants.data" :key="participant.id" class="bg-teal-400 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
          <th class="p-3 text-left">Name</th>
          <th class="p-3 text-left">Category</th>
          <th class="p-3 text-left">Club</th>
          <th class="p-3 text-left">Membership</th>
          <th class="p-3 text-left">Present</th>
          <th class="p-3 text-left">Remove</th>
         </tr>
        
      </thead>
      <tbody class="flex-1 sm:flex-none">
        <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0"  v-for="participant in participants.data" :key="participant.id">
          <td class="border-grey-light border hover:bg-gray-100 p-3"> {{ participant.name }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3"> {{ participant.category }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3"> {{ participant.club_name }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3"> {{ participant.membership }}</td>
          <td v-if ="participant.score!=0" class="border-grey-light border hover:bg-gray-100 p-3 text-center text-teal-500"> 
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
          </svg>
        </td>
          <td v-else class="border-grey-light border hover:bg-gray-100 p-3 text-center text-red-400"> 
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
          </svg>
        </td>

        <td class="border-grey-light border hover:bg-gray-100 p-3 text-center text-red-400"> 
          <Link :href="route('instance.removeParticipant')" 
                  method="post" 
                  :data="{ participant:participant, instance:instance.id }" 
                  as="button" 
                  type="button"
                  preserve-scroll
                  >

             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
          </Link>
        </td>
        
         </tr>
        <tr v-if="participants.data.length === 0">
          <td class="border-t px-2 py-4" colspan="4">No participants found.</td>
        </tr>
      </tbody>
    </table>
  <!-- <div class="max-w-md "> -->
     <pagination class="mt-4" :links="participants.links" /></pagination>
  <!-- </div> -->
   
  </div>
  
    
</div>
</template>

<script>
import AdvancedFilter from '../Participants/AdvancedFilter'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'
import pickBy from 'lodash/pickBy'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import { Link } from '@inertiajs/inertia-vue'

export default {


  name: 'InstanceParticipants',

  components:{
    AdvancedFilter,
    Pagination,
    SearchFilter,
    Link,
    advdata:Object,
   },

  props:{
  	participants:Object,
    members:Object,
    filters:Object,
    instance:Object,
  },
    metaInfo: { title: 'Members' },
// layout: Layout,
   data () 
   {
           return {
                    form: {
                      search: this.filters.search,
                      trashed: this.filters.trashed,
                    }
                  }
      // advdata:Object
    },



 watch: {
    form: {
      deep: true,
      handler: throttle(function() {
        this.$inertia.get(this.route('instances.edit',this.instance.id), pickBy(this.form), { preserveState: true })
      }, 150),
    },
  },

  methods: {
    reset() {
       this.form = mapValues(this.form, () => null)
    },

    setFilters(data)
    {
        this.advdata=data;
        alert(this.advdata._to);
    }
  }
}
</script>

<style lang="css" scoped>
</style>



<style>
  
  @media (min-width: 640px) {
    table {
      display: inline-table !important;
    }

    thead tr:not(:first-child) {
      display: none;
    }
  }

  td:not(:last-child) {
    border-bottom: 0;
  }

  th:not(:last-child) {
    border-bottom: 2px solid rgba(0, 0, 0, .1);
  }
</style>
</script>

<style lang="css" scoped>
</style>