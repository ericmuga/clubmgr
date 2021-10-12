<template>
<div>
  <div class="flex items-center justify-center">
  <div class="container">
    <div class="mb-4 py-5 flex justify-between items-center">
          <search-filter v-model="form.search" class="w-full max-w-md mr-4" @reset="reset">
            <label class="block text-gray-700">Trashed:</label>
            <select v-model="form.trashed" class="mt-1 w-full form-select">
              <option :value="null" />
              <option value="with">With Trashed</option>
              <option value="only">Only Trashed</option>
            </select>
          </search-filter>
          <inertia-link class="btn-indigo bg-indigo-800" :href="route('setup.create')">
              <span>Refresh</span>
              
          </inertia-link>
        </div>
    <table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
      <thead class="text-white">
        <tr v-for="setup in setups.data" :key="setup.id" class="bg-indigo-800 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
          <th class="p-3 text-left">Setup No.</th>
          <th class="p-3 text-left">Client ID</th>
          <th class="p-3 text-left">Client Secret</th>
          <th class="p-3 text-left">Call back URL</th>
          <th class="p-3 text-left">Environment</th>
          <th class="p-3 text-left">Current</th>
          <th class="p-3 text-left">Meeting Prefix</th>
          <th class="p-3 text-left">Last Meeting No.</th>
          <th class="p-3 text-left">Minimum Gradable Members</th>
          
          
         </tr>
        
      </thead>
      <tbody class="flex-1 sm:flex-none">
        <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0"  v-for="setup in setups.data" :key="setup.id">
          <td class="border-grey-light border hover:bg-gray-100 p-3"> 
           <inertia-link class="text-indigo-400" :href="route('setup.edit',setup.id)" tabindex="-1">
              {{ setup.id }}
            </inertia-link>

          </td>
          <td class="border-grey-light border hover:bg-gray-100 p-3"> {{ setup.client_id }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ setup.client_secret }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ setup.callback_url }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ setup.environment }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ setup.current}}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ setup.meeting_prefix}}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ setup.last_meeting_no}}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ setup.minimum_gradable_members}}</td>
          
          
           
         
        <tr v-if="setups.data.length === 0">
          <td class="border-t px-2 py-4" colspan="4">No setups found.</td>
        </tr>
      </tbody>
    </table>
    <pagination class="mt-4" :links="setups.links" />
  </div>

</div>
</div>
</template>

<script>

import Layout from '@/Shared/Layout'
// import SetupStats from './SetupStats'
import Icon from '@/Shared/Icon'
import pickBy from 'lodash/pickBy'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'

export default {

  name: 'Index',
  components:{
    // SetupStats,
      Icon,
    Pagination,
    SearchFilter,
  },
  
   props:{
    setups:null,
    filters:Object
   },

 metaInfo: { title: 'Setups' },
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
        this.$inertia.get(this.route('setups'), pickBy(this.form), { preserveState: true })
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