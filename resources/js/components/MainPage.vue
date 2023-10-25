<template>
  <div class="m-8 w-7/12 mx-auto">
    <table class="min-w-full bg-white border border-gray-200">
            <tr class="bg-neutral-700 text-white">
                <td class="pl-8 py-3">Title</td>
                <td class="pl-8">Author</td>
                <td class="pl-8">Publication Year</td>
                <td class="pl-8">Publisher</td>
                <td class="pl-8">ISBN</td>
            </tr>
       
            <tr v-for="book in booksData" :key="book.id" class="border-b dark:border-neutral-300">
                <td class="p-5">{{book.title}}</td>
                <td class="p-5">{{book.author}}</td>
                <td class="p-5">{{book.publication_year}}</td>
                <td class="p-5">{{book.publisher}}</td>
                <td class="p-5">{{book.isbn}}</td>
            </tr>
    </table>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      booksData: [],
    };
  },
  mounted() {
    this.getBooks();
  },

  methods: {
    getBooks(){
        axios
            .get('http://localhost/Book_inventory/public/api/books')
            .then(response => {this.booksData = response.data.books})
            .catch(error => {
            console.log('Error:', error);
        });
    }
    
  },
};
</script>