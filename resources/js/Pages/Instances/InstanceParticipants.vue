<template>

	<div class="flex items-center justify-center">
  

  <div class="container">
      <!-- <div class="mb-4 py-5 flex justify-between items-center">
          <search-filter v-model="form.search" class="w-full max-w-md mr-4" @reset="reset">
            <label class="block text-gray-700">Trashed:</label>
            <select v-model="form.trashed" class="mt-1 w-full form-select">
              <option :value="null" />
              <option value="with">With Trashed</option>
              <option value="only">Only Trashed</option>
            </select>
          </search-filter>
          <inertia-link class="btn-indigo bg-indigo-800" :href="route('participants.create')">
              <span>Refresh</span>
              
          </inertia-link>
        </div> -->
        <!-- <advanced-filter @set-advanced-filters="setFilters"></advanced-filter> -->
   
    <table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
      <thead class="text-white">
        <tr v-for="participant in participants.data" :key="participant.id" class="bg-indigo-800 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
          <th class="p-3 text-left">Name</th>
          <th class="p-3 text-left">Category</th>
          <th class="p-3 text-left">Club</th>
          <!-- <th class="p-3 text-left">Email</th> -->
          <th class="p-3 text-left">Joined At</th>
          <th class="p-3 text-left">Left At</th>
          <th class="p-3 text-left">Duration</th>
          <!-- <th class="p-3 text-left">Meeting</th> -->
          <!-- <th class="p-3 text-left">Instance</th> -->
          <!-- <th class="p-3 text-left">Instance Start Time</th> -->
          <!-- <th class="p-3 text-left">Official Start Time</th>
          <th class="p-3 text-left">Official End Time</th> -->
          <th class="p-3 text-left">Time Credit</th>

         </tr>
        
      </thead>
      <tbody class="flex-1 sm:flex-none">
        <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0"  v-for="participant in participants.data" :key="participant.id">
          <td class="border-grey-light border hover:bg-gray-100 p-3"> {{ participant.name }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3"> {{ participant.category }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3"> {{ participant.club_name }}</td>
          <!-- <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ participant.email }}</td> -->
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ participant.join_time }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ participant.leave_time }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ participant.duration }}</td>
          <!-- <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ participant.official_start_time }}</td>
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ participant.official_end_time }}</td> -->
          <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ participant.time_credit }}</td>
          
           
          <!-- <td class="border-grey-light border hover:bg-gray-100 p-3 truncate">   -->
            <!-- <inertia-link class="text-indigo-400" :href="route('meetings.edit',participant.mid)" tabindex="-1"> -->
              <!-- {{participant.meeting_id}} -->
            <!-- </inertia-link></td> -->
          <!-- <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ participant.start_time }}</td> -->
         
         </tr>
        <tr v-if="participants.data.length === 0">
          <td class="border-t px-2 py-4" colspan="4">No participants found.</td>
        </tr>
      </tbody>
    </table>
    <pagination class="mt-4" :links="participants.links" /></pagination>
  </div>
</div>
</template>

<script>
import AdvancedFilter from '../Participants/AdvancedFilter'
import Pagination from '@/Shared/Pagination'

export default {


  name: 'InstanceParticipants',
  props:{
  	participants:Object,
  },

  components:{
  	AdvancedFilter,
  	Pagination,
 
   filters:Object,
    advdata:Object,
   },

 
  data () {
    return {
     
  }

},
 // watch: {
 //    form: {
 //      deep: true,
 //      handler: throttle(function() {
 //        this.$inertia.get(this.route('participants'), pickBy(this.form), { preserveState: true })
 //      }, 150),
 //    },
 //  },
  methods: {
    reset() {
      // this.form = mapValues(this.form, () => null)
    },

    setFilters(data)
    {
        this.advdata=data;
        alert(this.advdata._to);
    }
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
</script>

<style lang="css" scoped>
</style>