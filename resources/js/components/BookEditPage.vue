<template>
  <div class="app">
      <AdminHeader></AdminHeader>
      <FormComponent @formSubmitted="editBook" ref="formComponent" :errorMessage="errorMessage"></FormComponent>
  </div>
  <div>we4hoerhmaejrhmneajrhjerhet</div>
</template>

<script>
import AdminHeader from './AdminHeader.vue';
import axios from 'axios';
import FormComponent from './FormComponent.vue';

export default {

  data() {
    return {
      errorMessage: '', // Инициализация errorMessage
    };
  },
  components: {
        AdminHeader, FormComponent
   },
 
  methods:{

    editBook(data){

        data.oldIsbn = this.$route.params.isbn;

        axios.put('http://localhost/Book_inventory/public/api/books/update', data)
        .then(response => {
            this.errorMessage = response.data.message;
        })
        .catch(error => {
            if (error.response && error.response.status === 422) {
                this.errorMessage = error.response.data.message;
            } //else {
              //  this.errorMessage = 'Неизвестная ошибка';
           // }
        });
    }
  }
}
</script>
<style scoped>

</style>