<template>
  <div>
    <h1 class="mb-4 font-bold text-1xl">Meetings</h1>
   
     <div class="flex">
       <div class="flex-1">
          <meeting-stats class="pb-2" :zmeetings=zmeetings></meeting-stats>
           

        <div class="mb-6 py-5 flex justify-between items-center">
          <search-filter v-model="form.search" class="w-full max-w-md mr-4" @reset="reset">
            <label class="block text-gray-700">Trashed:</label>
            <select v-model="form.trashed" class="mt-1 w-full form-select">
              <option :value="null" />
              <option value="with">With Trashed</option>
              <option value="only">Only Trashed</option>
            </select>
          </search-filter>
          <inertia-link class="btn-indigo" :href="route('meetings.create')">
              <span>Create</span>
              <span class="hidden md:inline">Meetings</span>
          </inertia-link>
         
           <inertia-link class="btn-indigo" :href="route('zoom.refresh')">
               <span class="hidden md:inline">Refresh Zoom Admins</span>
          </inertia-link>
          <inertia-link class="btn-indigo" :href="route('zoom.meetings')">
               <span class="hidden md:inline">Zoom Load</span>
          </inertia-link>

        </div>

         <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="px-6 pt-6 pb-4">ID</th>
          <th class="px-6 pt-6 pb-4">Topic</th>
          <th class="px-6 pt-6 pb-4">Type</th>
           <th class="px-6 pt-6 pb-4">Start Time</th>
           <th class="px-6 pt-6 pb-4">Registrants</th>
           <th class="px-6 pt-6 pb-4">Participants</th>
        </tr>
        <tr v-for="meeting in meetings.data" :key="meeting.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center focus:text-indigo-500" :href="route('meetings.edit', meeting.id)">
              {{ meeting.meeting_id }}
              <icon v-if="meeting.deleted_at" name="trash" class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2" />
            </inertia-link>
          </td>
          <!-- <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('meetings.edit', meeting.id)" tabindex="-1">
              <div v-if="meeting.organization">
                {{ meeting.organization.name }}
              </div>
            </inertia-link>
          </td> -->
          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('meetings.edit', meeting.id)" tabindex="-1">
              {{ meeting.topic}}
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('meetings.edit', meeting.id)" tabindex="-1">
              {{ meeting.meeting_type}}
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('meetings.edit', meeting.id)" tabindex="-1">
              {{ meeting.start_time }}
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('meetings.edit', meeting.id)" tabindex="-1">
              {{meeting.registrants}}
            </inertia-link>
               

          </td>
           <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('meetings.edit', meeting.id)" tabindex="-1">
              {{0}}
            </inertia-link>
               

          </td>
          <!-- <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('meetings.edit', meeting.id)" tabindex="-1">
              {{ meeting.type}}
            </inertia-link>
          </td> -->
          <!-- <td class="border-t w-px">
            <inertia-link class="px-4 flex items-center" :href="route('meetings.edit', meeting.id)" tabindex="-1">
              <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
            </inertia-link>
          </td> -->
        </tr>
        <tr v-if="meetings.data.length === 0">
          <td class="border-t px-6 py-4" colspan="4">No meetings found.</td>
        </tr>
      </table>
    </div>
    <pagination class="mt-6" :links="meetings.links" />
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

  components:{
       MeetingStats,
      Icon,
    Pagination,
    SearchFilter,
  },
  metaInfo: { title: 'Meetings' },
  layout: Layout,
  props: {
    zmeetings:0,
    filters: Object,
    meetings: Object,
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
