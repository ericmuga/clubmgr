<template>
  <div>
    <h1 class="mb-4 font-bold text-1xl">Members</h1>
   
     <div class="flex">
       <div class="flex-1">
          <member-stats class="pb-2"></member-stats>
           

        <div class="mb-6 py-5 flex justify-between items-center">
          <search-filter v-model="form.search" class="w-full max-w-md mr-4" @reset="reset">
            <label class="block text-gray-700">Trashed:</label>
            <select v-model="form.trashed" class="mt-1 w-full form-select">
              <option :value="null" />
              <option value="with">With Trashed</option>
              <option value="only">Only Trashed</option>
            </select>
          </search-filter>
          <inertia-link class="btn-indigo" :href="route('members.create')">
              <span>Create</span>
              <span class="hidden md:inline">Member</span>
          </inertia-link>
        </div>

         <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="px-6 pt-6 pb-4">Name</th>
          <th class="px-6 pt-6 pb-4">Email</th>
          <th class="px-6 pt-6 pb-4">Phone</th>
           <th class="px-6 pt-6 pb-4">Affiliation</th>
           <th class="px-6 pt-6 pb-4">Type</th>
        </tr>
        <tr v-for="member in members.data" :key="member.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center focus:text-indigo-500" :href="route('members.edit', member.id)">
              {{ member.name }}
              <icon v-if="member.deleted_at" name="trash" class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2" />
            </inertia-link>
          </td>
          <!-- <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('members.edit', member.id)" tabindex="-1">
              <div v-if="member.organization">
                {{ member.organization.name }}
              </div>
            </inertia-link>
          </td> -->
          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('members.edit', member.id)" tabindex="-1">
              {{ member.email}}
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('members.edit', member.id)" tabindex="-1">
              {{ member.phone }}
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('members.edit', member.id)" tabindex="-1">
              {{ member.affiliation}}
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('members.edit', member.id)" tabindex="-1">
              {{ member.type}}
            </inertia-link>
          </td>
          <!-- <td class="border-t w-px">
            <inertia-link class="px-4 flex items-center" :href="route('members.edit', member.id)" tabindex="-1">
              <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
            </inertia-link>
          </td> -->
        </tr>
        <tr v-if="members.data.length === 0">
          <td class="border-t px-6 py-4" colspan="4">No members found.</td>
        </tr>
      </table>
    </div>
    <pagination class="mt-6" :links="members.links" />
     </div>
 </div>

  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import MemberStats from './MemberStats'
import Icon from '@/Shared/Icon'
import pickBy from 'lodash/pickBy'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'

export default {

  components:{
      MemberStats,Icon,
    Pagination,
    SearchFilter,
  },
  metaInfo: { title: 'Members' },
  layout: Layout,
  props: {
    filters: Object,
    members: Object,
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
        this.$inertia.get(this.route('members'), pickBy(this.form), { preserveState: true })
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
