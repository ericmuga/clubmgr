<template>

<div>

	 <table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
      <thead class="text-white">
        <tr v-for="occurrence in occurrences.data" :key="occurrence.id" class="bg-indigo-800 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
          <th class="p-3 text-left">Occurrence ID</th>
          <th class="p-3 text-left">Start Time</th>
          <th class="p-3 text-left">Registrants</th>
          <th class="p-3 text-left">Participants</th>
         
         </tr>
        
      </thead>
      <tbody class="flex-1 sm:flex-none">
        <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0"  v-for="occurrence in occurrences.data" :key="occurrence.id">
          <td class="border-grey-light border hover:bg-gray-100 p-3">  <inertia-link class="text-indigo-400" :href="route('occurs.edit',occurrence.id)" tabindex="-1">
              {{occurrence.occurrence_id}}
            </inertia-link></td></td>
          <td class="border-grey-light border hover:bg-gray-100 p-3"> {{ occurrence.start_time }}</td>
          <!-- <td class="border-grey-light border hover:bg-gray-100 p-3"> {{ occurrence.registrants }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ occurrence.participants }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ occurrence.start_time }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ occurrence.occurrence_day }}</td> -->

         <!--  <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ occurrence.registrants }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ occurrence.registrants }}</td> -->
          <!-- <td class="border-grey-light border hover:bg-gray-100 p-3 text-indigo-400 text-center">
           <inertia-link class="" :href="route('occurrence.registrant',occurrence.id)">
               {{ occurrence.registrants }}
          </inertia-link>
         </td> -->

          <td class="border-grey-light border hover:bg-gray-100 p-3 text-indigo-400 text-center">
           <inertia-link class="" :href="route('occs.registrants',occurrence.id)">
              {{ occurrence.registrants }}
          </inertia-link>
         </td>

         <td class="border-grey-light border hover:bg-gray-100 p-3 text-indigo-400 text-center">
           <inertia-link class="" :href="route('occs.participants',occurrence.id)">
               {{ occurrence.participants }}
          </inertia-link>
         </td>


         </tr>
         <tr v-if="occurrences.data.length === 0">
          <td class="border-t px-2 py-4" colspan="4">No occurrences found.</td>
        </tr>
      </tbody>
    </table>
    <pagination class="mt-4" :links="occurrences.links" />

    </div>
</template>

<script>

import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'
import AdvancedFilter from './AdvancedFilter'

export default {

  name: 'MeetingOccurrences',
   components:{
    
    Pagination,
    SearchFilter,
    AdvancedFilter,
  },
  
   props:{
   occurrences:null,
   //  zmeetings:0,
   //  filters:Object,
   // url:""
   },

  data () {
    return {

    }
  }
}
</script>


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