<template>
  <div class="app">
      <router-view></router-view>
  </div>
</template>

<script>

import MainPage from './MainPage.vue';
import AdminComponent from './AdminComponent.vue';
import AuthorizationForm from './AuthorizationForm.vue';
import BookAddPage from './BookAddPage.vue';
import BookEditPage from './BookEditPage.vue';

export default {

  components: {
        MainPage, AdminComponent, AuthorizationForm, BookAddPage, BookEditPage
   },
  methods:{
    
  }
}
</script>
<style scoped>

</style>