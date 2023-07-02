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
    @if(session('admin'))
        <script>window.location.href = "{{ route('adminPanel') }}";</script>
    @endif
    <div class="w-[300px] mx-auto mt-10 h-[400px] rounded-xl shadow-xl p-10" x-data="{ login: '', password: '', errorMessage: '' }">
        <div>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-[90px]">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
        </svg>

        </div>
        <input type="text" placeholder="login" id="login" class="mt-2 border border-green-500 focus:border-blue-500 focus:outline-none h-[40px] p-2" x-model="login"></br>
        <input type="password" placeholder="password" id="password" class="mt-3 border border-green-500 focus:border-blue-500 focus:outline-none h-[40px] p-2" x-model="password"></br>
        <button id="submit" class="mt-10 ml-[55px] bg-blue-300 rounded-sm w-[100px] h-[40px] hover:bg-blue-500" >submit</button>
        <div id="answer" class="mt-5" x-text="errorMessage"></div>
    </div>
</body>
</html>
<script>
    $(document).ready(function(){
        $('#submit').on('click', function(event){
            event.preventDefault();
            var login = $('#login').val();
            var password = $('#password').val();

            $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
            });

            $.ajax({
                type:'POST',
                url:"{{route('auth')}}",
                data:{login:login, password:password},

                success:function(response){
                    //response = JSON.parse(response);
                    if(response.message == "success"){
                        window.location.href = '{{route("adminPanel")}}';
                    }
                    else{
                        $('#answer').addClass('bg-red-400 text-white p-4 rounded-md');
                        $('#answer').text(response.message);  
                    }
                   
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