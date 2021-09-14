<template>
<div>
  <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('registrants')">Registrants</inertia-link>
    </h1>
   
  <div class="flex items-center justify-center">
  <div class="container">
   <registrant-stats :rotarians=rotarians :rotaractors=rotaractors :guests=guests :total=total>
     
   </registrant-stats>
    <div class="mb-4 py-5 flex justify-between items-center">
          <search-filter v-model="form.search" class="w-full max-w-md mr-4" @reset="reset">
            <label class="block text-gray-700">Trashed:</label>
            <select v-model="form.trashed" class="mt-1 w-full form-select">
              <option :value="null" />
              <option value="with">With Trashed</option>
              <option value="only">Only Trashed</option>
            </select>
          </search-filter>
          <inertia-link class="btn-indigo bg-indigo-800" :href="route('registrants.create')">
              <span>Refresh</span>
              
          </inertia-link>
        </div>
    <table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
      <thead class="text-white">
        <tr v-for="registrant in registrants.data" :key="registrant.id" class="bg-indigo-800 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
          <th class="p-3 text-left">Name</th>
          <th class="p-3 text-left">Meeting ID</th>
          <th class="p-3 text-left">Email</th>
          <th class="p-3 text-left">Category</th>
          <th class="p-3 text-left">Classification</th>
          <th class="p-3 text-left">Club</th>
          <th class="p-3 text-left">Invited By</th>
          
         </tr>
        
      </thead>
      <tbody class="flex-1 sm:flex-none">
        <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0"  v-for="registrant in registrants.data" :key="registrant.id">
          
          <td class="border-grey-light border hover:bg-gray-100 p-3"> {{ registrant.name }}</td>
         <td class="border-grey-light border hover:bg-gray-100 p-3 truncate">  
            <inertia-link class="text-indigo-400" :href="route('meetings.edit',registrant.mid)" tabindex="-1">
              {{registrant.meeting_id}}
            </inertia-link></td>
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ registrant.email }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ registrant.category }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ registrant.classification }}</td>
         
          
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ registrant.club_name }}</td>
           
           <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ registrant.invited_by }}</td>
         
        <tr v-if="registrants.data.length === 0">
          <td class="border-t px-2 py-4" colspan="4">No registrants found.</td>
        </tr>
      </tbody>
    </table>
    <pagination class="mt-4" :links="registrants.links" />
  </div>

</div>
</div>
</template>

<script>

import Layout from '@/Shared/Layout'
import RegistrantStats from './RegistrantStats'
import Icon from '@/Shared/Icon'
import pickBy from 'lodash/pickBy'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'

export default {

  name: 'Index',
  components:{
    RegistrantStats,
      Icon,
    Pagination,
    SearchFilter,
  },
  
   props:{
    registrants:null,
    filters:Object,
    rotarians:0,
    rotaractors:0,
    guests:0,
    total:0,
   },

 metaInfo: { title: 'Registrants' },
  layout: Layout,
  data() {
    return {
      form: {
        search: this.filters.search,
        trashed: this.filters.trashed,
      },
    }
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function() {
        this.$inertia.get(this.route('registrants'), pickBy(this.form), { preserveState: true })
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
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