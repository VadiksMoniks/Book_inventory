<template>
  <div class="app">
      <AdminHeader></AdminHeader>
      <FormComponent @formSubmitted="addBook" ref="formComponent" :errorMessage="errorMessage" ></FormComponent>
  </div>
</template>

<script>
import AdminHeader from './AdminHeader.vue';
import axios from 'axios';
import FormComponent from './FormComponent.vue';

export default {

  data() {
    return {
      errorMessage: '', 
    };
  },
  components: {
        AdminHeader, FormComponent
   },
  methods:{
    addBook(data){
        axios.post('http://localhost/Book_inventory/public/api/books/store', data)
        .then(response => {
            this.errorMessage = response.data.message;
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
<style scoped>

</style>