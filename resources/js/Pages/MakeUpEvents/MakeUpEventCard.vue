<template>

  <div class=" container mx-auto p-8 m-6  relative flex flex-col min-w-0 break-words w-3/4 mb-6 shadow-lg rounded-lg bg-gray-300 border-0">
   <Link
       :href="route('makeups')"
       class="bg-teal-500 text-white rounded-md m-6 p-3 max-w-sm text-center"
   >
     Back
   </Link>

    <div class="relative pt-16 pb-32 flex content-center items-center justify-center min-h-screen-75">
      <div
      class="absolute top-0 w-full h-full bg-center bg-cover"
      style="
      background-image: url('https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1267&q=80');
      "
      >
      <span
      id="blackOverlay"
      class="w-full h-full absolute opacity-75 bg-black"
      ></span>

    </div>

    <div class="w-full flex bg-white"><p>
      Some text
    </p></div>
  </div>
  <div class="rounded-t bg-white mb-0 px-6 py-6 ">
    <div class="text-center flex justify-center">
      <h6 class="text-blueGray-700 text-xl font-bold">Make-up Card</h6>
        <!-- <button
          class="bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
          type="button"
        >
          Settings
        </button> -->
      </div>

      <div >
      <div class="bg-gray-100 flex justify-between">
       <div class="w-full  px-4">
        <div class="relative w-full mb-3">
          <label
           class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
           htmlFor="grid-password"
          >
          Name
         </label>
         <input
          type="text"
          class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
         required
         v-model="form.name"
         :error="form.errors.name"
         />

      </div>
      <div v-if="$page.props.errors.name" class="text-xs text-red-500 ">
         {{$page.props.errors.name}}

      </div>
     </div>
<div class="w-full px-4">
  <div class="relative w-full mb-3">
    <label
    class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
    htmlFor="grid-password"
   
    >
    Email
</label>
<input
  type="email"
  class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
  required
  v-model="form.email"
  :error="form.errors.email"

/>
</div>
<div v-if="$page.props.errors.email" class="text-xs text-red-500 ">
         {{$page.props.errors.email}}

      </div>
</div>
</div>

<hr class="mt-6 border-b-1 border-blueGray-300" />
      </div>
    </div>
    <div class="flex-auto px-4 lg:px-10  pt-0">
      <form  @submit.prevent="store">
        <div class="">

         <!-- the form lines will be added here -->
         <EventCard v-for="(row, index) in form.rows"
           :row="row"
         :key=index                     
         v-on:remove="removeRow(index)"
         > </EventCard>
         <!-- {{rows}} -->
         <div class="flex-auto text-center text-bold">
          <button @click="addRow" class="rounded-full p-3 bg-teal-400 "> 
              Add Event
      <!--       <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
        </svg> 
 -->
      </button>
        </div>
        <!-- end of form lines -->
      </div>
        <div class="flex flex-auto text-center justify-center m-3 p-3">
          <!-- <button @click="store" class="rounded-full p-3 bg-blue-400  "> 
            Submit Request
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
        </svg> 
     
    </button> -->
          <div v-if="form.rows.length >0 && !Empty()">
            <loading-button :loading="form.processing" class="btn-indigo" type="submit">Submit Request</loading-button>
          </div> 
          
        </div>
       
    </form>
  </div>
</div>

</template>

<script>

import EventCard from '@/Shared/EventCard'
import LoadingButton from '@/Shared/LoadingButton'
import pickBy from 'lodash/pickBy'
import isEmpty from 'lodash/isEmpty'
import { Link } from '@inertiajs/inertia-vue'
export default{

  components:{
    // MakeUpEventForm,
    EventCard,
    LoadingButton,
    Link
  },
remember: 'form',
  data() {
    return {
     
     
    form:this.$inertia.form({ 
           name:'',
           email:'',
           rows:[]
         })
 };

},
methods:{
  
  addRow(){
           this.form.rows.push({type:'',description: '', date: '' , club: ''}); // what to push unto the rows array?
         },
 removeRow(index){
       this.form.rows.splice(index,1); // why is this removing only the last row?
     },

     store() {
      // console.log(this.form);
      this.form.post(this.route('makeups.store', pickBy(this.form), { preserveState: true }))
    },
    
    Empty()
    {
      isEmpty(this.form.rows)
    }

  }



}
</script> 
