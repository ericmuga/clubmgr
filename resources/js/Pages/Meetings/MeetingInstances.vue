<template>

<div>

	 <table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
      <thead class="text-white">
        <tr v-for="instance in instances.data" :key="instance.id" class="bg-indigo-800 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
          <th class="p-3 text-left">Instance ID</th>
          <th class="p-3 text-left">Start Time</th>
          <th class="p-3 text-left">Exactly</th>
          <!-- <th class="p-3 text-left">Registrants</th> -->
          <th class="p-3 text-left">Participants</th>
          <th class="p-3 text-left">Marked for Grading</th>
         
         </tr>
        
      </thead>
      <tbody class="flex-1 sm:flex-none">
        <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0"  v-for="instance in instances.data" :key="instance.id">
          <td class="border-grey-light border hover:bg-gray-100 p-3">  <inertia-link class="text-indigo-400" :href="route('instances.edit',instance.id)" tabindex="-1">
              {{instance.uuid}}
            </inertia-link></td></td>
          <td class="border-grey-light border hover:bg-gray-100 p-3"> {{ instance.start_time }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3"> {{ instance.exact_time }}</td>
          <!-- <td class="border-grey-light border hover:bg-gray-100 p-3"> {{ instance.registrants }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ instance.participants }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ instance.start_time }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ instance.instance_day }}</td> -->

         <!--  <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ instance.registrants }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ instance.registrants }}</td> -->
          <!-- <td class="border-grey-light border hover:bg-gray-100 p-3 text-indigo-400 text-center">
           <inertia-link class="" :href="route('instance.registrant',instance.id)">
               {{ instance.registrants }}
          </inertia-link>
         </td> -->

          <!-- <td class="border-grey-light border hover:bg-gray-100 p-3 text-indigo-400 text-center">
           <inertia-link class="" :href="route('instance.registrants',instance.id)">
              {{ instance.registrants }}
          </inertia-link>
         </td> -->

         <td class="border-grey-light border hover:bg-gray-100 p-3 text-indigo-400 text-center">
           <inertia-link class="" :href="route('instance.participants',instance.id)">
               {{ instance.participants }}
          </inertia-link>
         </td>

          <td class="border-grey-light border hover:bg-gray-100 p-3"> {{ instance.marked_for_grading }}</td>

         </tr>
         <tr v-if="instances.data.length === 0">
          <td class="border-t px-2 py-4" colspan="4">No instances found.</td>
        </tr>
      </tbody>
    </table>
    <pagination class="mt-4" :links="instances.links" />

    </div>
</template>

<script>

import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'
import AdvancedFilter from './AdvancedFilter'

export default {

  name: 'InstanceInstances',
   components:{
    
    Pagination,
    SearchFilter,
    AdvancedFilter,
  },
  
   props:{
   instances:null,
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