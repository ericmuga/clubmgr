<template>
  <div>
    <h1 class="mb-4 font-bold text-1xl">Make-Ups</h1>
   
     <div class="flex">
       <div class="flex-1">
          <!-- <makeup-stats class="pb-2" :zmakeups=zmakeups></makeup-stats> -->
           

        <div class="mb-6 py-5 flex justify-between items-center">
          <search-filter v-model="form.search" class="w-full max-w-md mr-4" @reset="reset">
            <label class="block text-gray-700">Trashed:</label>
            <select v-model="form.trashed" class="mt-1 w-full form-select">
              <option :value="null" />
              <option value="with">With Trashed</option>
              <option value="only">Only Trashed</option>
            </select>
          </search-filter>
          <inertia-link class="btn-indigo" :href="route('makeups.create')">
              <span>Create</span>
              <span class="hidden md:inline">Makeups</span>
          </inertia-link>

          <!-- <inertia-link class="btn-indigo" :href="route('zoom.makeups')">
               <span class="hidden md:inline">Zoom Load</span>
          </inertia-link> -->

        </div>

         <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="px-6 pt-6 pb-4">ID</th>
          <th class="px-6 pt-6 pb-4">Email</th>
          <th class="px-6 pt-6 pb-4">Name</th>
          <th class="px-6 pt-6 pb-4">Makeup Date</th>
           <th class="px-6 pt-6 pb-4">Status</th>
           <th class="px-6 pt-6 pb-4">Approved By</th>
           <th class="px-6 pt-6 pb-4">Approval Date</th>
        </tr>
        <tr v-for="makeup in makeups.data" :key="makeup.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center focus:text-indigo-500" :href="route('makeups.edit', makeup.id)">
              {{ makeup.id }}
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center focus:text-indigo-500" :href="route('makeups.edit', makeup.id)">
              {{ makeup.email }}
            </inertia-link>
          </td>
          <!-- <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('makeups.edit', makeup.id)" tabindex="-1">
              <div v-if="makeup.organization">
                {{ makeup.organization.name }}
              </div>
            </inertia-link>
          </td> -->
          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('makeups.edit', makeup.id)" tabindex="-1">
              {{ makeup.name}}
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('makeups.edit', makeup.id)" tabindex="-1">
              {{ makeup.makeup_date}}
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('makeups.edit', makeup.id)" tabindex="-1">
              {{ makeup.status }}
            </inertia-link>
          </td>
           <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('makeups.edit', makeup.id)" tabindex="-1">
              {{ makeup.approved_by }}
            </inertia-link>
          </td>
           <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('makeups.edit', makeup.id)" tabindex="-1">
              {{ makeup.approval_date }}
            </inertia-link>
          </td>
         
          <!-- <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('makeups.edit', makeup.id)" tabindex="-1">
              {{ makeup.type}}
            </inertia-link>
          </td> -->
          <!-- <td class="border-t w-px">
            <inertia-link class="px-4 flex items-center" :href="route('makeups.edit', makeup.id)" tabindex="-1">
              <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
            </inertia-link>
          </td> -->
        </tr>
        <tr v-if="makeups.data.length === 0">
          <td class="border-t px-6 py-4" colspan="4">No makeups found.</td>
        </tr>
      </table>
    </div>
    <pagination class="mt-6" :links="makeups.links" />
     </div>
 </div>

  </div>
</template>

<script>
import Layout from '@/Shared/Layout'

import Icon from '@/Shared/Icon'
import pickBy from 'lodash/pickBy'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'

export default {

  components:{
       
      Icon,
    Pagination,
    SearchFilter,
  },
  metaInfo: { title: 'Makeups' },
  layout: Layout,
  props: {
    
    filters: Object,
    makeups: Object,
  },
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
