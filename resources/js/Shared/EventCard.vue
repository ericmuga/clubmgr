<template>

	<div class="flex justify-between mt-2">

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
							v-model="row.type"
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
             v-model="row.description"
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
		<t-datepicker lang="en" v-model="row.date" 
		required/>
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
	<t-input required  v-model="row.club"/>
</div>
</div>

</div>



</div>


<!-- <select v-model="row.code">
	<option v-for="item in itemdata"  :value="item"> {{ item.code }} </option>
</select> -->


<!-- <input type="text" placeholder="Text" v-model="row.description">
<input type="text" placeholder="value" v-model="row.unitprice"> -->
<button v-on:click= "remove"> 
	<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
		<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
	</svg>
</button>
</div>


</template>

<script>

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

export default {
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

  name: 'EventCard',
  props: ['row'],

  data: function () {
  	return {
  		
  	}
  },
  methods: {
  	remove() {
  		this.$emit('remove');
  	}
  }
}
</script>

<style lang="css" scoped>
</style>