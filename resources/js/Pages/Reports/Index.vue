<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl bg-white-100">Reports</h1>
    <div class="flex">
      <div class="grid grid-cols-3 gap-7 p2">
        <div class="flex-1 box-border h-70 w-70 p-4 border-4 ">Attendance Reports
          <div class="mt-10">

           <participants-per-year :categories="[{'id':1,'name':'Guest'},{'id':2,'name':'Rotarian'},{'id':3,'name':'Rotaractor'}]"></participants-per-year> 
       
          </div>
          <div class="mt-10">

       
          <prospective-inductees></prospective-inductees>
          </div>
        </div>
        <div>2</div>
        <div>3</div>
      </div>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import ParticipantsPerYear from './ParticipantsPerYear.vue'
import ProspectiveInductees from './ProspectiveInductees.vue'

export default {
  components: { ParticipantsPerYear,ProspectiveInductees },
  metaInfo: { title: 'Reports' },
  layout: Layout,
}
</script>
