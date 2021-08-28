<template>
  <div>
    <h1 class="mb-4 font-bold text-1xl">Dashboard</h1>
    <p class="mb-1 leading-normal">Dashboard Content will come here</p>
    <div class="flex-1 m-4">
       <a href="https://zoom.us/oauth/authorize?response_type=code&client_id=88qbzpueTkGI66J9dKWd1g&redirect_uri=https://localhost/show&state={userState}">Check Meetings</a>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout';
import axios from 'axios';

export default {
   mounted(){
     
     // axios.get('https://zoom.us/oauth/authorize?response_type=code&client_id=88qbzpueTkGI66J9dKWd1g&redirect_uri=https://localhost/show&state={userState}')

   },
  
  metaInfo: { title: 'Dashboard' },
  layout: Layout,
  props: {
          response:Array
  }

}
</script>
