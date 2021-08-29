<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">Zoom/Setup</h1>
    <div class="mb-6 flex justify-between items-center">
      
     <search-filter v-model="form.search" class="w-full max-w-md mr-4" @reset="reset">
            <label class="block text-gray-700">Trashed:</label>
            <select v-model="form.trashed" class="mt-1 w-full form-select">
              <option :value="null" />
              <option value="with">With Trashed</option>
              <option value="only">Only Trashed</option>
            </select>
          </search-filter>
      <inertia-link class="btn-indigo" :href="route('setup.create')">
        <span>Create</span>
        <span class="hidden md:inline">Setup</span>
      </inertia-link>

    </div>


    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="px-6 pt-6 pb-4">Client ID</th>
          <th class="px-6 pt-6 pb-4">Client Secret</th>
          <th class="px-6 pt-6 pb-4">Call Back URL</th>
          <th class="px-6 pt-6 pb-4">Environment</th>
          <th class="px-6 pt-6 pb-4">Current</th>
        </tr>
        <tr v-for="setup in setups.data" :key="setup.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center focus:text-indigo-500" :href="route('setup.edit', setup.id)">
              {{ setup.client_id }}
             
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('setup.edit', setup.id)" tabindex="-1">
              {{ setup.client_secret }}
            </inertia-link>
          </td>

          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('setup.edit', setup.id)" tabindex="-1">
              {{ setup.callback_url }}
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('setup.edit', setup.id)" tabindex="-1">
              {{ setup.environment }}
            </inertia-link>
          </td>

          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('setup.edit', setup.id)" tabindex="-1">
              {{ setup.current }}
            </inertia-link>
          </td>

          <td class="border-t w-px">
            <inertia-link class="px-4 flex items-center" :href="route('setup.edit', setup.id)" tabindex="-1">
              <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
            </inertia-link>
          </td>

        </tr>
        <tr v-if="setups.data.length === 0">
          <td class="border-t px-6 py-4" colspan="4">No Setups found .</td>
        </tr>
      </table>
    </div>
    <pagination class="mt-6" :links="setups.links" />
  </div>
</template>

<script>
import Icon from '@/Shared/Icon'
import pickBy from 'lodash/pickBy'
import Layout from '@/Shared/Layout'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'

export default {
  metaInfo: { title: 'Zoom Setup' },
  
  // mounted(){
  // 	console.log(setups);
  // }

  components: {
    Icon,
    Pagination,
    SearchFilter,
  },
  layout: Layout,
  props: {
    filters: Object,
    setups: Object,
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
        this.$inertia.get(this.route('setup'), pickBy(this.form), { preserveState: true })
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
  },
}
</script>
