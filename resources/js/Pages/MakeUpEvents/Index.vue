<template>
  <div>
   <!-- This example requires Tailwind CSS v2.0+ -->
<nav class="bg-gray-800">
  <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
    <div class="relative flex items-center justify-between h-16">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <!-- Mobile menu button-->
        <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <!--
            Icon when menu is closed.

            Heroicon name: outline/menu

            Menu open: "hidden", Menu closed: "block"
          -->
          <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <!--
            Icon when menu is open.

            Heroicon name: outline/x

            Menu open: "block", Menu closed: "hidden"
          -->
          <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
        <div class="flex-shrink-0 flex items-center">
          <img class="block lg:hidden h-10 w-full " src="/assets/Jlogo.png" alt="Workflow">
          <img class="hidden lg:block h-10 w-full " src="/assets/Jlogo.png" alt="Workflow">
        </div>
        <!-- <div class="hidden sm:block sm:ml-6">
          <div class="flex space-x-4">
            <a href="#" class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium" aria-current="page">Dashboard</a>

            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Team</a>

            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Projects</a>

            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Calendar</a>
          </div>
        </div> -->
      </div>
      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
        <!-- <button type="button" class="bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
          <span class="sr-only">View notifications</span>
         <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
          </svg>
        </button> -->

        <!-- Profile dropdown -->
    <div class="ml-3 relative">
        <div v-if="$page.props.auth.user===null">
          <Link href="/login" method="get" as="button" type="button">
          <button class="flex items-center bg-teal-500 text-white rounded-md px-4 py-2 mx-auto">
            Login
          </button>
        </Link>
        </div>
        <div v-else>
           <Link href="/" method="get" as="button" type="button">
            <button class="flex items-center bg-teal-500 text-white rounded-md px-4 py-2 mx-auto">
              Dashboard
            </button>
        </Link>

        <Link href="/logout" method="delete" as="button" type="button" class="text-white">
             Logout
           
        </Link>
        </div>
        
        </div>
      </div>
    </div>
  </div>

  <!-- Mobile menu, show/hide based on menu state. -->
  <!-- <div class="sm:hidden" id="mobile-menu">
    <div class="px-2 pt-2 pb-3 space-y-1">
      <a href="#" class="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium" aria-current="page">Dashboard</a>

      <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Team</a>

      <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Projects</a>

      <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Calendar</a>
    </div>
  </div> -->
</nav>

    <main>
      <div
      class="relative pt-16 pb-32 flex content-center items-center justify-center min-h-screen-75"
      >
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
    <div class="container relative mx-auto">
      <div class="items-center flex flex-wrap">
        <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
          <div class="pr-12">
            <h1 class="text-white font-semibold text-5xl">
              It's fine, we know you served elsewhere.
            </h1>
            <p class="mt-4 text-lg text-white">
             Please register your make up, leave or exemption details here.
           </p>
         </div>
       </div>
     </div>
   </div>
   <div
   class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden h-70-px"
   style="transform: translateZ(0);"
   >
   <svg
   class="absolute bottom-0 overflow-hidden"
   xmlns="http://www.w3.org/2000/svg"
   preserveAspectRatio="none"
   version="1.1"
   viewBox="0 0 2560 100"
   x="0"
   y="0"
   >
   <polygon
   class="text-blueGray-200 fill-current"
   points="2560 0 2560 100 0 100"
   ></polygon>
 </svg>

</div>

</div>

<section class="pb-20 bg-blueGray-200 -mt-24">


  <div class="container mx-auto px-4">
    <div class="flex flex-wrap">
      <div class="lg:pt-12 pt-6 w-full md:w-4/12 px-4 text-center">
        <div
        class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg"
        >
        <div class="px-4 py-5 flex-auto">

          <div
          class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-red-400"
          >
          <i class="fas fa-award"></i>
        </div>



        <h6 class="text-xl font-semibold">Register Make-up Events</h6>
        <div class="m-4">
          <p class="mt-2 mb-4 text-blueGray-500">
          Be sure to describe your event!
        </p>
        <Link :href="route('makeups.register')" method="get" as="button" type="button">
          <button class="flex items-center bg-teal-500 text-white rounded-md px-4 py-2 mx-auto">
            Make Request
          </button>
        </Link>
        </div>
        

      </div>

    </div>
</div>

<div class="w-full md:w-4/12 px-4 text-center">
  <div
  class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg"
  >
  <div class="px-4 py-5 flex-auto">
    <div
    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-green-400"
    >
    <i class="fas fa-retweet"></i>
  </div>
  <h6 class="text-xl font-semibold">Request Leave</h6>
  <p class="mt-2 mb-4 text-blueGrayo-500">
    We wish you well in you leave. Make it count.
  </p>
   <Link href="#" method="get" as="button" type="button">
          <button class="flex items-center bg-teal-500 text-white rounded-md px-4 py-2 mx-auto">
            Make Request
          </button>
        </Link>
</div>
</div>
</div>

<div class="pt-6 w-full md:w-4/12 px-4 text-center">
  <div
  class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg"
  >
  <div class="px-4 py-5 flex-auto">
    <div
    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-teal-400"
    >
    <i class="fas fa-fingerprint"></i>
  </div>
  <h6 class="text-xl font-semibold">Request Exemptions</h6>
  <p class="mt-2 mb-4 text-blueGray-500">
   It's fine we know you will be back in a bit.
  </p>
  <Link href="#" method="get" as="button" type="button">
          <button class="flex items-center bg-teal-500 text-white rounded-md px-4 py-2 mx-auto">
            Make Request
          </button>
        </Link>
</div>
</div>
</div>
</div>


</div>
</section>

 <div class="ml-8  flex-1 flex-auto text-center px-10 m" scroll-region>
            <flash-messages />
           
          </div>


</main>
<!-- <footer-component /> -->
</div>
</template>
<script>
// import Navbar from "@/components/Navbars/AuthNavbar.vue";
import FooterComponent from "@/Shared/Footer.vue";
import { Link } from '@inertiajs/inertia-vue';
import FlashMessages from '@/Shared/FlashMessages';

import team1 from "@/Shared/team-1-800x800.jpg";
import team2 from "@/Shared/team-2-800x800.jpg";
import team3 from "@/Shared/team-3-800x800.jpg";
import team4 from "@/Shared/team-4-470x470.png";

export default {
  
  data() {
    return {
      team1,
      team2,
      team3,
      team4,
    };
  },
  components: {
    // Navbar,
    FooterComponent,
    Link,
    FlashMessages,
  },
};
</script>
