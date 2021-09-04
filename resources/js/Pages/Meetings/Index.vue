<template>
<div>
  <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('meetings')">Meetings</inertia-link>
    </h1>
  <div class="container">
    <meeting-stats :zmeetings=zmeetings></meeting-stats>
    <div class="mb-4 py-5 flex justify-between items-center">
          <search-filter v-model="form.search" class="w-full max-w-md mr-4" @reset="reset">
            <label class="block text-gray-700">Trashed:</label>
            <select v-model="form.trashed" class="mt-1 w-full form-select">
              <option :value="null" />
              <option value="with">With Trashed</option>
              <option value="only">Only Trashed</option>
            </select>
          </search-filter>
          <inertia-link class="btn-indigo bg-indigo-800" :href="route('meetings.create')">
              <span>Create </span>
          </inertia-link>
           <inertia-link class="btn-indigo bg-indigo-800" :href="route('zoom.meetings')">
              <span>Zoom Load</span>
              
          </inertia-link>
          <inertia-link class="btn-indigo bg-indigo-800 overflow-hidden" :href="route('zoom.refresh')">
               <span class="hidden md:inline">Load Admins</span>
          </inertia-link>
        </div>
    <table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
      <thead class="text-white">
        <tr v-for="meeting in meetings.data" :key="meeting.id" class="bg-indigo-800 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
          <th class="p-3 text-left">ID</th>
          <th class="p-3 text-left">Topic</th>
          <th class="p-3 text-left">Type</th>
          <th class="p-3 text-left">Start Time</th>
          <th class="p-3 text-left">Registrants</th>
          <th class="p-3 text-left">Participants</th>
         </tr>
        
      </thead>
      <tbody class="flex-1 sm:flex-none">
        <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0"  v-for="meeting in meetings.data" :key="meeting.id">
          <td class="border-grey-light border hover:bg-gray-100 p-3">  <inertia-link class="text-indigo-400" :href="route('meetings.edit',meeting.id)" tabindex="-1">
              {{meeting.meeting_id}}
            </inertia-link></td></td>
          <td class="border-grey-light border hover:bg-gray-100 p-3"> {{ meeting.topic }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ meeting.topic }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ meeting.start_time }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ meeting.registrants }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ meeting.participants }}</td>
          
           
          
         </tr>
        <tr v-if="meetings.data.length === 0">
          <td class="border-t px-2 py-4" colspan="4">No meetings found.</td>
        </tr>
      </tbody>
    </table>
    <pagination class="mt-4" :links="meetings.links" />
  </div>

</div>
</div>
</template>

<script>

import Layout from '@/Shared/Layout'
import MeetingStats from './Partials/MeetingStats'
import Icon from '@/Shared/Icon'
import pickBy from 'lodash/pickBy'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'

export default {

  name: 'Index',
  components:{
     MeetingStats,
      Icon,
    Pagination,
    SearchFilter,
  },
  
   props:{
    meetings:null,
    zmeetings:0,
    filters:Object
   },

 metaInfo: { title: 'Meetings' },
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
        this.$inertia.get(this.route('meetings'), pickBy(this.form), { preserveState: true })
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