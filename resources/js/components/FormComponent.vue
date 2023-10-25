<template>
    <div>
        <a href="/Book_inventory/public/adminPanel" class=" ml-[50px] underline text-red-500">Back</a>
        <div class="flex justify-center h-[700px] mt-[120px]">
            <div class="bg-gray-200 p-4  w-[500px] shadow-xl ">
                <p class="ml-[120px] mt-[50px] text-xl text-orange-500">Add a book to the book list</p>
                <input @input="title = $event.target.value" type="text" placeholder="title" id="title" class="mt-[50px] ml-[120px] w-[250px] h-[50px] pl-5"><br>
                <input @input="author = $event.target.value" type="text" placeholder="author" id="author" class="mt-[10px] ml-[120px] w-[250px] h-[50px] pl-5"><br>
                <input @input="publication_year = $event.target.value" type="text" placeholder="publication year" id="publication_year" class="mt-[10px] ml-[120px] w-[250px] h-[50px] pl-5"><br>
                <input @input="publisher = $event.target.value" type="text" placeholder="publisher" id="publisher" class="mt-[10px] ml-[120px] w-[250px] h-[50px] pl-5"><br>
                <input @input="isbn = $event.target.value" type="text" placeholder="isbn" id="isbn" class="mt-[10px] ml-[120px] w-[250px] h-[50px] pl-5"><br>
                <button @click="submitForm" id="add" class="mt-[30px] ml-[140px]  w-[200px] h-[50px]  bg-yellow-400 hover:bg-orange-500 hover:text-white">Send data</button>
                <div id="answer" class="mt-5" x-text="errorMessage">{{errorMessage}}</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

  data() {
    return {
        title: '',
        author: '',
        publication_year: '',
        publisher: '',
        isbn: '',
        oldIsbn: '',
    }
  },

   props: {
        errorMessage: String,
   },

   methods: {
        submitForm() {
            this.$emit('formSubmitted', {
            title: this.title,
            author: this.author,
            publication_year: this.publication_year,
            publisher: this.publisher,
            isbn: this.isbn,
            oldIsbn: this.oldIsbn,
        });
    },
  },
}
</script>