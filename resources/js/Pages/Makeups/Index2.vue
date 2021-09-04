<template>
<div>
	 <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('makeups')">Makeups</inertia-link>
    </h1>
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
          <inertia-link class="btn-indigo bg-indigo-800" :href="route('makeups.create')">
              <span>Create</span>
              
          </inertia-link>
        </div>
    <table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
      <thead class="text-white">
        <tr v-for="makeup in makeups.data" :key="makeup.id" class="bg-indigo-800 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
          <th class="p-3 text-left">Email</th>
          <th class="p-3 text-left">Name</th>
          <th class="p-3 text-left">Make Up Date</th>
          <th class="p-3 text-left">Status</th>
          <th class="p-3 text-left">Approved By</th>
          <th class="p-3 text-left">Approval Date</th>
          
          
         </tr>
        
      </thead>
      <tbody class="flex-1 sm:flex-none">
        <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0"  v-for="makeup in makeups.data" :key="makeup.id">
          
          <td class="border-grey-light border hover:bg-gray-100 p-3"> {{ makeup.email }}</td>
         
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ makeup.name }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ makeup.makeup_date }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ makeup.status }}</td>
         
          
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ makeup.approved_by }}</td>
           
           <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ makeup.approval_date }}</td>
         
        <tr v-if="makeups.data.length === 0">
          <td class="border-t px-2 py-4" colspan="4">No makeups found.</td>
        </tr>
      </tbody>
    </table>
    <pagination class="mt-4" :links="makeups.links" />
  </div>

</div>
</div>
</template>

<script>

import Layout from '@/Shared/Layout'
// import MakeupStats from './MakeupStats'
import Icon from '@/Shared/Icon'
import pickBy from 'lodash/pickBy'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'

export default {

  name: 'Index',
  components:{
    // MakeupStats,
      Icon,
    Pagination,
    SearchFilter,
  },
  
   props:{
    makeups:null,
    filters:Object
   },

 metaInfo: { title: 'Makeups' },
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
        this.$inertia.get(this.route('makeups'), pickBy(this.form), { preserveState: true })
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

