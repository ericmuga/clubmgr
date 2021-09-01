<template>
  <div>
    <h1 class="mb-4 font-bold text-1xl">Registrants</h1>
   
     <div class="flex">
       <div class="flex-1">
          <registrant-stats class="pb-2" :rotarians="rotarians" :rotaractors="rotaractors" :guests="guests" :total="total"></registrant-stats>
           

        <div class="mb-4 py-5 flex justify-between items-center">
          <search-filter v-model="form.search" class="w-full max-w-md mr-4" @reset="reset">
            <label class="block text-gray-700">Trashed:</label>
            <select v-model="form.trashed" class="mt-1 w-full form-select">
              <option :value="null" />
              <option value="with">With Trashed</option>
              <option value="only">Only Trashed</option>
            </select>
          </search-filter>
          <inertia-link class="btn-indigo" :href="route('registrants.create')">
              <span>Refresh</span>
              
          </inertia-link>
        </div>

    <div class="bg-white rounded-md shadow ">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="px-2 pt-4 pb-4">Name</th>
          <th class="px-2 pt-4 pb-4">Meeting ID</th>
          <th class="px-2 pt-4 pb-4">Email</th>
          <th class="px-2 pt-4 pb-4">Category</th>
           <th class="px-2 pt-4 pb-4">Classification</th>
           <th class="px-2 pt-4 pb-4">Club</th>
           <!-- <th class="px-2 pt-4 pb-4">Registration Time</th> -->
           <th class="px-2 pt-4 pb-4">Invited By</th>
        </tr>
        <tr v-for="registrant in registrants.data" :key="registrant.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
           <td class="border-t">
            <inertia-link class="px-2 py-4 flex items-center focus:text-indigo-500" :href="route('registrants.edit', registrant.id)">
              {{ registrant.name }}
              <icon v-if="registrant.deleted_at" name="trash" class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2" />
            </inertia-link>
          </td>

          <td class="border-t">
            <inertia-link class="px-2 py-4 flex items-center focus:text-indigo-500" :href="route('registrants.edit', registrant.id)">
              {{ registrant.meeting_id }}
              <icon v-if="registrant.deleted_at" name="trash" class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2" />
            </inertia-link>
          </td>
          <!-- <td class="border-t">
            <inertia-link class="px-2 py-4 flex items-center" :href="route('registrants.edit', registrant.id)" tabindex="-1">
              <div v-if="registrant.organization">
                {{ registrant.organization.name }}
              </div>
            </inertia-link>
          </td> -->
          <td class="border-t">
            <inertia-link class="px-2 py-4 flex items-center" :href="route('registrants.edit', registrant.id)" tabindex="-1">
              {{ registrant.email}}
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link class="px-2 py-4 flex items-center" :href="route('registrants.edit', registrant.id)" tabindex="-1">
              {{ registrant.category }}
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link class="px-2 py-4 flex items-center" :href="route('registrants.edit', registrant.id)" tabindex="-1">
              {{registrant.classification}}
            </inertia-link>
          </td>

          <td class="border-t">
            <inertia-link class="px-2 py-4 flex items-center" :href="route('registrants.edit', registrant.id)" tabindex="-1">
              {{registrant.club_name}}
            </inertia-link>
          </td>
          <!-- <td class="border-t">
            <inertia-link class="px-2 py-4 flex items-center" :href="route('registrants.edit', registrant.id)" tabindex="-1">
              {{ registrant.create_time}}
            </inertia-link>
          </td> -->
          <td class="border-t">
            <inertia-link class="px-2 py-4 flex items-center" :href="route('registrants.edit', registrant.id)" tabindex="-1">
              {{ registrant.invited_by}}
            </inertia-link>
          </td>
          <!-- <td class="border-t w-px">
            <inertia-link class="px-2 flex items-center" :href="route('registrants.edit', registrant.id)" tabindex="-1">
              <icon name="cheveron-right" class="block w-4 h-4 fill-gray-400" />
            </inertia-link>
          </td> -->
        </tr>
        <tr v-if="registrants.data.length === 0">
          <td class="border-t px-2 py-4" colspan="4">No registrants found.</td>
        </tr>
      </table>
    </div>
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

  components:{
      RegistrantStats,
      Icon,
    Pagination,
    SearchFilter,
  },
  metaInfo: { title: 'Registrants' },
  layout: Layout,
  props: {
    filters: Object,
    registrants: Object,
    rotarians:0,
    rotaractors:0,
    guests:0,
    total:0,
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
