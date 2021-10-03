<template>
<div>
  <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('gradings')">Grading History</inertia-link>
    </h1>
  <div class="flex items-center justify-center">
  

  <div class="container">
      <div class="mb-4 py-5 flex justify-between items-center">
          <!-- <search-filter v-model="form.search" class="w-full max-w-md mr-4" @reset="reset">
            <label class="block text-gray-700">Trashed:</label>
            <select v-model="form.trashed" class="mt-1 w-full form-select">
              <option :value="null" />
              <option value="with">With Trashed</option>
              <option value="only">Only Trashed</option>
            </select>
          </search-filter> -->
          <!-- <inertia-link class="btn-indigo bg-indigo-800" :href="route('gradings.create')">
              <span>Refresh</span>

'user_id'=>$request->user()->email,
                                    'from'=>$request->_from,
                                    'to'=>$request->_to,
                                    'grading_rule_id'=>$request->gradingrule_id,
                                    'meeting_id'=>$request->meeting_id,
                                    'category'=>($request->category==null)?'':$request->category,
                                    'downloadurl'=>$slug.'.xlsx'


          </inertia-link> -->


        </div>
        <!-- <advanced-filter @set-advanced-filters="setFilters" :gradingrules="this.gradingrules.data"></advanced-filter> -->
   
    <table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
      <thead class="text-white">
        <tr v-for="grading in gradings.data" :key="grading.id" class="bg-indigo-800 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
          <th class="p-3 text-left">Graded By</th>
          <th class="p-3 text-left">From</th>
          <th class="p-3 text-left">To</th>
          <th class="p-3 text-left">Meeting Id</th>
          <th class="p-3 text-left">Category</th>
          <th class="p-3 text-left">Grading Rule</th>
          <th class="p-3 text-left">URL</th>
          <th class="p-3 text-left">Grading Time</th>
         </tr>
        
      </thead>
      <tbody class="flex-1 sm:flex-none">
        <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0"  v-for="grading in gradings.data" :key="grading.id">
          <td class="border-grey-light border hover:bg-gray-100 p-3"> {{ grading.user_id }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3"> {{ grading.from }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3"> {{ grading.to }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3"> {{ grading.meeting_id }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3"> {{ grading.category }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ grading.rule }}</td>
          <!-- <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ grading.category }}</td> -->
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"><a class="text-indigo-400 hover:text-indigo-600" :href=grading.downloadurl>click to download </a></td> 
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate">{{grading.grading_time}}</td> 
         </tr>
        <tr v-if="gradings.data.length === 0">
          <td class="border-t px-2 py-4" colspan="4">No gradings found.</td>
        </tr>
      </tbody>
    </table>
    <pagination class="mt-4" :links="gradings.links" />
  </div>

</div>
</div>
</template>

<script>

import Layout from '@/Shared/Layout'
// import MemberStats from './MemberStats'
import Icon from '@/Shared/Icon'
import pickBy from 'lodash/pickBy'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'
// import AdvancedFilter from './AdvancedFilter'

export default {

  name: 'Index',
  components:{
    // gradingStats,
      Icon,
    Pagination,
    SearchFilter,
    // AdvancedFilter,
  },
  
   props:{
    gradings:Object,
    filters:Object,
    advdata:Object,
    gradingrules:Object,
   },
mounted(){
  console.log(this.gradings.data)
},
 metaInfo: { title: 'gradings' },
  layout: Layout,
  data() {
    return {
    //   form: {
    //     search: this.filters.search,
    //     trashed: this.filters.trashed,
    //   },
     }
  },
//   watch: {
//     form: {
//       deep: true,
//       handler: throttle(function() {
//         this.$inertia.get(this.route('gradings'), pickBy(this.form), { preserveState: true })
//       }, 150),
//     },
//   },
//   methods:{
//       url(g){
//           '/gradings/'+g.downloadurl;
//       }
//   },
//   methods: {
//     reset() {
//       this.form = mapValues(this.form, () => null)
//     },

//     setFilters(data)
//     {
//         this.advdata=data;
//         //console.log(this.advdata);
//         this.$inertia.post(this.route('gradings.filtered'), pickBy(this.advdata), { preserveState: true })
//     }
//   }
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