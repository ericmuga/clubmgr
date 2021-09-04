<template>


  

  <div class="grid gap-4 mb-8 md:grid-cols-2 xl:grid-cols-4">
  <div
    class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800"
  >
    <div class="p-4 flex items-center">
      <div
        class="p-3 rounded-full text-orange-500 dark:text-orange-100 bg-orange-100 dark:bg-orange-500 mr-4"
      >
        <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
          <path
            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
          ></path>
        </svg>
      </div>
      <div>
        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
          Rotarians
        </p>
        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
          {{rotarians}}
        </p>
      </div>
    </div>
  </div>
  <div
    class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800"
  >
    <div class="p-4 flex items-center">
      <div
        class="p-3 rounded-full text-green-500 dark:text-green-100 bg-green-100 dark:bg-green-500 mr-4"
      >
        <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
          <path
            fill-rule="evenodd"
            d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
            clip-rule="evenodd"
          ></path>
        </svg>
      </div>
      <div>
        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
          Rotaractors
        </p>
        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
          {{rotaractors}}
        </p>
      </div>
    </div>
  </div>
  <div
    class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800"
  >
    <div class="p-4 flex items-center">
      <div
        class="p-3 rounded-full text-blue-500 dark:text-blue-100 bg-blue-100 dark:bg-blue-500 mr-4"
      >

        <img src="/assets/images.png" alt="" fill="currentColor" viewBox="0 0 20 20" class="w-8 h-8">
        <!-- <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
          <path
            d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"
          ></path>
        </svg> -->
      </div>
      <div>
        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
          Guests
        </p>
        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
          {{guests}}
        </p>
      </div>
    </div>
  </div>

  <div
    class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800"
  >
    <div class="p-4 flex items-center">
      <div
        class="p-3 rounded-full text-blue-500 dark:text-blue-100 bg-blue-100 dark:bg-blue-500 mr-4"
      >
        <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
          <path d="M3.661 2.67105C3.71317 2.39988 3.97931 2.18005 4.25546 2.18005H6.25546C6.5316 2.18005 6.71317 2.39988 6.661 2.67105L5.33853 9.54499C5.28636 9.81616 5.02021 10.036 4.74406 10.036H2.74406C2.46792 10.036 2.28636 9.81616 2.33853 9.54499L3.661 2.67105Z" fill="black"/>
<path d="M8.661 2.67105C8.71317 2.39988 8.97931 2.18005 9.25546 2.18005H11.2555C11.5316 2.18005 11.7132 2.39988 11.661 2.67105L8.07144 21.3289C8.01927 21.6001 7.75312 21.8199 7.47698 21.8199H5.47698C5.20083 21.8199 5.01927 21.6001 5.07144 21.3289L8.661 2.67105Z" fill="black"/>
<path d="M13.661 2.67105C13.7132 2.39988 13.9793 2.18005 14.2555 2.18005H16.2555C16.5316 2.18005 16.7132 2.39988 16.661 2.67105L13.0714 21.3289C13.0193 21.6001 12.7531 21.8199 12.477 21.8199H10.477C10.2008 21.8199 10.0193 21.6001 10.0714 21.3289L13.661 2.67105Z" fill="black"/>
<path d="M18.661 2.67105C18.7132 2.39988 18.9793 2.18005 19.2555 2.18005H21.2555C21.5316 2.18005 21.7132 2.39988 21.661 2.67105L20.3385 9.54499C20.2864 9.81616 20.0202 10.036 19.7441 10.036H17.7441C17.4679 10.036 17.2864 9.81616 17.3385 9.54499L18.661 2.67105Z" fill="black"/>

        </svg>
      </div>
      <div>
        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
          Total
        </p>
        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
          {{total}}
        </p>
      </div>
    </div>
  </div>
  
</div>
</template>

<script>
export default {

  name: 'RegistrantStats',
  props:{
    rotarians:0,
    rotaractors:0,
    guests:0,
    total:0,
  },

  data () {
    return {
      
    }
  }
}
</script>

<style lang="css" scoped>
</style>