<template>
<form form @submit.prevent>
    <div class="w-[300px] mx-auto mt-10 h-[400px] rounded-xl shadow-xl p-10" x-data="{ login: '', password: '', errorMessage: '' }">
        <div>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-[90px]">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
        </svg>

        </div>
        <input @input="login = $event.target.value" type="text" placeholder="login" id="login" class="mt-2 border border-green-500 focus:border-blue-500 focus:outline-none h-[40px] p-2" x-model="login"><br>
        <input @input="password = $event.target.value" type="password" placeholder="password" id="password" class="mt-3 border border-green-500 focus:border-blue-500 focus:outline-none h-[40px] p-2" x-model="password"><br>
        <button @click="logIn" id="submit" class="mt-10 ml-[55px] bg-blue-300 rounded-sm w-[100px] h-[40px] hover:bg-blue-500" >submit</button>
        <div id="answer" class="mt-5" x-text="errorMessage">{{errorMessage}}</div>
    </div>
</form>
</template>


<script>
import axios from 'axios';

export default {
  data(){
    return {
        login: '',
        password: '',
        errorMessage: ''
    }
  },

  methods:{
    logIn() {
        axios.post('http://localhost/Book_inventory/public/adminPanel/auth', {
            login: this.login,
            password: this.password
        })
        .then(response => {
            if (response.data.message === 'success') {
               // router.push({ path: '/Book_inventory/public/adminPanel' })
               this.$router.push('/Book_inventory/public/adminPanel')
            }
        })
        .catch(error => {
            if (error.response && error.response.status === 422) {
                this.errorMessage = error.response.data.message;
            } //else {
              //  this.errorMessage = 'Unknown Error';
           // }
        });
    }
  }
}
</script>