<template>
    <div class="flex w-full h-20 bg-deepWater text-white items-center">
        <p class="m-5">Admin Panel</p>
        <router-link :to="{ name: 'addBook'}" class="ml-32 text-creamy">Add a book</router-link>
        <a href="./adminPanel/logout" class="ml-auto mr-8 text-creamy hover:text-red-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hover:w-7 h-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
            </svg>
        </a>
    </div>
</template>


<script>
import axios from 'axios';

export default {


  methods:{
    logout() {
        this.$router.push({ name: 'logout' });
    }
  }
}
</script>