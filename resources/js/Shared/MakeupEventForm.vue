<template>
<div>
    <div>
    <div class="w-full lg:w-6/12 px-4">
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

      />
  </div>
</div>
<div class="w-full lg:w-6/12 px-4">
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

/>
</div>
</div>
</div>

<hr class="mt-6 border-b-1 border-blueGray-300" />


<div class="flex justify-between my-6 ">


    <div class="flex">
       <div class="w-full lg:w-6/12 px-4">
         <div class="relative w-full mb-3">
          <label
          class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
          htmlFor="grid-password"
          >
          Event Type
      </label>
      <t-select
      :options="[ '',
      'Club Visit', 
      'Committee meeting', 
      'Projects',
      'Social',
      'Training',
      'Board Meeting',
      'Joint Fellowship',
      'Mega (District) Fellowship',
      'Other'
      ]"
      variant="demo"
      class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-xl ease-linear transition-all duration-150"
      >
  </t-select>
</div>
</div>
<div class="w-full  px-4">
  <div class="relative w-full mb-3">
    <label
    class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
    htmlFor="grid-password"
    >
    Event Description
</label>
<t-textarea

rows="5" 
col="50" 
class="w-full"


required/>
</div>
</div>

<div class="w-full lg:w-12/12 px-4">
  <div class="relative w-full mb-3">
    <label
    class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
    htmlFor="grid-password"
    >
    Event Date
</label>
<t-datepicker lang="en" 
/>
</div>
</div>

<div class="w-full lg:w-12/12 px-4">
  <div class="relative w-full mb-3">
    <label
    class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
    htmlFor="grid-password"
    >
    Club
</label>
<t-input />
</div>
</div>

</div>



</div>

<hr class="my-3 border-b-1 border-black-300" />



<!-- <t-button class="bg-teal-400 max-w-sm h-10 mt-6" @click="store" >

    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
  </svg>
</t-button>
 -->

</div>
</template>

<script type="">
import {
  TInput,
  TTextarea,
  TSelect,
  TRadio,
  TCheckbox,
  TButton,
  TInputGroup,
  TCard,
  TAlert,
  // TModal,
  TDropdown,
  // TRichSelect,
  TPagination,
  TTag,
  TRadioGroup,
  TCheckboxGroup,
  TTable,
  TDatepicker,
  TToggle,
  TDialog,
} from 'vue-tailwind/dist/components';

export default{
  components:{
    TInput,
    TTextarea,
    TSelect,
    TRadio,
    TCheckbox,
    TButton,
    TInputGroup,
    TCard,
    TAlert,
      // TModal,
      TDropdown,
      // TRichSelect,
      TPagination,
      TTag,
      TRadioGroup,
      TCheckboxGroup,
      TTable,
      TDatepicker,
      TToggle,
      TDialog,
  },



  props: ['itemdata', 'row'],
  data: function () {
    return {
        selected: this.itemdata[0]
    }
},
methods: {
    remove() {
        this.$emit('remove');
    }
}
}
</script>