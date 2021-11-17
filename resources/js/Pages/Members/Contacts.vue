<template>
<div class="flex justify-betwee w-md br-gray-100 text-bold">
	
	<div class="p-8 rounded">
			

		<table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
		               <inertia-link 
		                      class="text-indigo-400 hover:text-indigo-600" 
		                      :href="route('members.edit',member.id)"
		               >{{member.name}} / CONTACTS
		           </inertia-link>  
              </th>
            </tr>
          </thead>
          <div>
          	<div class="p-4">
          		<div v-if="$page.props.errors.contact" class="text-sm text-bold text-red-600 mt-1">{{$page.props.errors.contact}}</div>
          	</div>
         	  <div class="flex items-center border-b border-teal-500 py-2">
			          <select-input 

			              v-model="form.contact_type" 
			              :error="form.errors.contact_type" 
			              class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" 
			             required 	
			            >
				            <option value="email">Email</option>
				            <option value="phone">Phone</option>
			           </select-input>

			    <input v-model="form.contact" :error="form.errors.contact"
			          class="appearance-none  border-none w-full  h-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" 
			          type="text" 
			          placeholder="Email/Phone" 
			          aria-label="Full name"
			          required 
				 />

				  
			    <Link href="/members/contact/store" 
                        as="button"
			            method="post" 
			            :data="{ 
			            	      member_id: member.id, 
			            	      contact_type:form.contact_type, 
			            	      contact:form.contact 
			            	  }"
			            class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded" 
			            preserve-state
			       >
			 	 <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
					  <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
					</svg>
			     		
			    </Link>
			   
			  </div>
			
		</div>
          
            <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                TYPE
              </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                CONTACT
              </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
               ACTION
              </th>
             </tr>
          </thead>
         	<tbody class="bg-white divide-y divide-gray-200">

                        <tr v-for="contact in member.contacts.data" :key="contact.id">
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <div v-if="contact.contact_type==='email'" class="flex-shrink-0  w-10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                              </svg>
                            </div>
                             <div v-else class="flex-shrink-0  w-10">
                               <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                              </svg>
                              </svg>
                            </div>

                              <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                  {{contact.type}}
                                </div>
                                <div class="text-sm text-gray-500">
                                  
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{contact.contact}}</div>
                            <!-- <div class="text-sm text-gray-500">Optimization</div> -->
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                         <button 
					           class="text-red-600 hover:underline" 
					           tabindex="-1" 
					           type="button" 
					           @click="destroy(`${contact.id}`)"
					           preserve-state
				           >
							<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
							  <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
							</svg>
					      </button>
                           
                          </td>
                        </tr>

                        <!-- More people... -->
                      </tbody>
                    </table>
         		

	</div>
</div>
</template>

<script>
import TextInput from '@/Shared/TextInput'
import Layout from '@/Shared/Layout'
import SelectInput from '@/Shared/SelectInput'
import { Link } from '@inertiajs/inertia-vue'
export default {

name: 'Contacts',
 components:{
 	SelectInput,
 	Link,
 },

 layout:Layout,
  props: {
    member : Object, // String, Number, Boolean, Function, Object, Array
     
    },
  data() {
    return {
      form: this.$inertia.form({
							        contact: null,
							        contact_type: null,
							        member_id: null,
							      }),
      
    }
  },
  methods: {
    store() {
      this.form.post(this.route('member.savecontact'))
    },

    destroy(c) {
     
      if (confirm('Are you sure you want to delete this contact?'+c)) {
        this.$inertia.delete(this.route('member.deletecontact',c))
      }
    }
  }
}
</script>


<style lang="css" scoped>
</style>