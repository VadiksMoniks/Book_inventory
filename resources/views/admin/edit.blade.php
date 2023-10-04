<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script>
    <title>Document</title>
</head>
<body>

    <a href="{{route('adminPanel')}}" class=" ml-[50px] underline text-red-500">Back</a>
    <div class="flex justify-center h-[700px] mt-[120px]">
        <div class="bg-gray-200 p-4  w-[500px] shadow-xl ">
            <p class="ml-[140px] mt-[50px] text-xl text-orange-500">Edit a book information</p>
            <input type="text" placeholder="title" value="{{$bookInfo['title']}}" id="title" class="mt-[50px] ml-[120px] w-[250px] h-[50px] pl-5"></br>
            <input type="text" placeholder="author" value="{{$bookInfo['author']}}" id="author" class="mt-[10px] ml-[120px] w-[250px] h-[50px] pl-5"></br>
            <input type="text" placeholder="publication_year" value="{{$bookInfo['publication_year']}}" id="publication_year" class="mt-[10px] ml-[120px] w-[250px] h-[50px] pl-5"></br>
            <input type="text" placeholder="publisher" value="{{$bookInfo['publisher']}}" id="publisher" class="mt-[10px] ml-[120px] w-[250px] h-[50px] pl-5"></br>
            <input type="text" placeholder="isbn" value="{{$bookInfo['isbn']}}" id="isbn" class="mt-[10px] ml-[120px] w-[250px] h-[50px] pl-5"></br>
            <button id="edit" class="mt-[30px] ml-[140px]  w-[200px] h-[50px]  bg-yellow-400 hover:bg-orange-500 hover:text-white">Edit</button>
            <div id="answer" class="mt-[20px]"></div>
        </div>
    </div>
</body>
</html>
<script>
    $(document).ready(function(){
        $('#edit').on('click', function(event){
            event.preventDefault();
            
            var paths = location.pathname.split('/');

            var title =  $('#title').val();
            var author = $('#author').val();
            var publication_year = $('#publication_year').val();
            var publisher = $('#publisher').val();
            var isbn = $('#isbn').val();
            var current_isbn = paths[paths.length-2];

           $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
            });

            $.ajax({
                type : 'POST',
                url : '{{route("update")}}',
                data:{title:title, author:author, publication_year:publication_year, publisher:publisher, isbn:isbn, current_isbn:current_isbn},
                headers: { 'X-HTTP-Method-Override': 'PUT' },

                success:function(response){
                    if(response.message==="Data was successfully updated"){
                        $('#answer').addClass('bg bg-green-400 text-white p-4 rounded-md ');
                        setTimeout(function() {
                        window.location.href = "{{route('adminPanel')}}";
                        }, 2000);
                    }
                    $('#answer').addClass('bg-red-400 text-white p-4 rounded-md ');
                    $('#answer').text(response.message);  

                },
                error: function(xhr, status, error) {
                    // Обработка ошибки
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = '';
                    $.each(errors, function(field, messages) {
                        errorMessage += field + ': ' + messages.join(', ') + '<br>';
                    });
                    $('#answer').addClass('bg-red-400 text-white p-4 rounded-md ');
                    $('#answer').html(errorMessage);
                }
            });
        });
    });
</script>