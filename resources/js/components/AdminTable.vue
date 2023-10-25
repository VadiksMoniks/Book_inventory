<template>
    <div id="list" class="m-8 w-7/12 mx-auto">

                <select id="filter">
                    <option>Choose a tipe of filter</option>
                    <option>title</option>
                    <option>author</option>
                    <option>publisher</option>
                </select>
                
        <table class="min-w-full bg-white border border-gray-200">
            <tr class="bg-neutral-700 text-white">
                <td class="pl-8 py-3">Title</td>
                <td class="pl-8">Author</td>
                <td class="pl-8">Publication Year</td>
                <td class="pl-8">Publisher</td>
                <td class="pl-8">ISBN</td>
                <td class="pl-8"></td>
                <td class="pl-8"></td>
            </tr>
            <tr v-for="book in booksData" :key="book.id"  class="border-b dark:border-neutral-300 bg-neutral-200">
                <td class="p-5">{{book.title}}</td>
                <td class="p-5">{{book.author}}</td>
                <td class="p-5">{{book.publication_year}}</td>
                <td class="p-5">{{book.publisher}}</td>
                <td class="p-5">{{book.isbn}}</td>
                <td ><router-link :to="{ name: 'editBook', params: { isbn: book.isbn } }" class="text-green-700 underline hover:text-orange-800">Edit</router-link></td>
                <td class="pr-[5px]"><button @click="deleteBook(book.isbn)" class="delete bg-red-400 rounded-sm px-2 py-2 hover:bg-red-600 hover:text-white transition-all ease" data-isbn="{{ $item['isbn'] }}">Delete</button></td>
            </tr>
        </table>
    </div>
</template>


<script>
import axios from 'axios';

export default {
  data() {
    return {
      booksData: [], // Ваши данные о книгах
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
            console.log('Error: ', error);
        });
    },

    deleteBook(isbn){
        axios.delete('http://localhost/Book_inventory/public/api/books/'+isbn+'/delete')
        .then(response => {
          alert(response.data.message);
          this.getBooks();
        })
            .catch(error => {
            alert('Error: ', error);
            });
    },
    
  },
};
</script>