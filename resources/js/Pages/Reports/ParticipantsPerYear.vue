
<template>
      <div class="flex flex-1">
         <div class="shadow-md">
           
            <div class="tab w-full overflow-hidden border-t">
               <input class="absolute opacity-0" id="tab-multi-two" type="checkbox" name="tabs">
               <label class="block p-5 text-sm bg-indigo-100 leading-normal cursor-pointer" for="tab-multi-two">Attendance Per Year</label>
               <div class="tab-content overflow-hidden border-l-2 bg-gray-100 border-indigo-500 leading-normal">
                  <div class="flex flex-1 p-4 shadow-md">
                  <form class="w-full max-w-lg" @submit.prevent="setFilters">
                    <div class="flex flex-wrap -mx-3 mb-6">
                      
                      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-ID">
                          Year
                        </label>
                        <input 
                               type="year"
                               class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" 
                               id="grid-first-id" placeholder="From" v-model="data.year"
                        >
                      </div>

                      <select-input v-model="data.category" class="pr-6 pb-8 w-full lg:w-1/2 block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" label="Category">
                        <option v-for="item in categories" :key="item.id" :value="categories.id">{{item.name}}</option>
                      </select-input>
                      <!-- <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-phone">
                         Category
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-phone" type="text" placeholder="Guest" v-model="data.category">
                      </div> -->

                      
                      
                          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                          </div>

                       
                        <div class="py-2">
                          <loading-button  class="btn-indigo" type="submit">Generate Report!</loading-button> 
                        </div>
                     
                    </div>
                  </form>
                  </div>
               </div>
            </div>
           
         </div>
      </div>
      
     
    
   <!-- </div> -->
   </template>
 <script>
     import LoadingButton from '@/Shared/LoadingButton'
     import SelectInput from '@/Shared/SelectInput'
     export default{

      name: 'Accordion',

         mounted(){
           
         },

         components:{
            LoadingButton,SelectInput
         },
     
        props:{
         categories:Array,
         years:Array
         }, 
        data () {
          return {
            data:{
              year:"",
              category:"",
               
              }  
          }
        },

        methods:{
          setFilters(){
            
             
             this.$emit('set-advanced-filters',this.data);
          },
          reset()
          {
               return {
               data:{
                 _to:null,
                 _from:null,
              category:"",
              gradingrule_id:"",
                 }  
             }
          }

        }
     }





      /*var myRadios = document.getElementsByName('tabs2');
      var setCheck;
      var x = 0;
      for(x = 0; x < myRadios.length; x++){
          myRadios[x].onclick = function(){
              if(setCheck != this){
                   setCheck = this;
              }else{
                  this.checked = false;
                  setCheck = null;
          }
          };
      }*/
   </script>
   <style type="css" scoped>
         /* Tab content - closed */
         .tab-content {
         max-height: 0;
         -webkit-transition: max-height .35s;
         -o-transition: max-height .35s;
         transition: max-height .35s;
         }
         /* :checked - resize to full height */
         .tab input:checked ~ .tab-content {
         max-height: 100vh;
         }
         /* Label formatting when open */
         .tab input:checked + label{
         /*@apply text-xl p-5 border-l-2 border-indigo-500 bg-gray-100 text-indigo*/
         font-size: 1.25rem; /*.text-xl*/
         padding: 1.25rem; /*.p-5*/
         border-left-width: 2px; /*.border-l-2*/
         border-color: #6574cd; /*.border-indigo*/
         background-color: #f8fafc; /*.bg-gray-100 */
         color: #6574cd; /*.text-indigo*/
         }
         /* Icon */
         .tab label::after {
         float:right;
         right: 0;
         top: 0;
         display: block;
         width: 1.5em;
         height: 1.5em;
         line-height: 1.5;
         font-size: 1.25rem;
         text-align: center;
         -webkit-transition: all .35s;
         -o-transition: all .35s;
         transition: all .35s;
         }
         /* Icon formatting - closed */
         .tab input[type=checkbox] + label::after {
         content: "+";
         font-weight:bold; /*.font-bold*/
         border-width: 1px; /*.border*/
         border-radius: 9999px; /*.rounded-full */
         border-color: #b8c2cc; /*.border-grey*/
         }
         .tab input[type=radio] + label::after {
         content: "\25BE";
         font-weight:bold; /*.font-bold*/
         border-width: 1px; /*.border*/
         border-radius: 9999px; /*.rounded-full */
         border-color: #b8c2cc; /*.border-grey*/
         }
         /* Icon formatting - open */
         .tab input[type=checkbox]:checked + label::after {
         transform: rotate(315deg);
         background-color: #6574cd; /*.bg-indigo*/
         color: #f8fafc; /*.text-grey-lightest*/
         }
         .tab input[type=radio]:checked + label::after {
         transform: rotateX(180deg);
         background-color: #6574cd; /*.bg-indigo*/
         color: #f8fafc; /*.text-grey-lightest*/
         }

   </style>
     
  
