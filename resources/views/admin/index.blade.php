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
    @if(!session('admin'))
        <script>window.location.href = "{{ route('logIn') }}";</script>
    @endif
    <div class="flex w-full h-20 bg-deepWater text-white items-center">
        <p class="m-5">Admin Panel</p>
        <a href="{{route('add')}}" class="ml-32 text-creamy">Add a book</a>
        <a href="{{route('logout')}}" class="ml-auto mr-8 text-creamy hover:text-red-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hover:w-7 h-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
            </svg>
        </a>
    </div>

<div  class="m-8 w-7/12 mx-auto">
            <select id="filter">
                <option>Choose a tipe of filter</option>
                <option>title</option>
                <option>author</option>
                <option>publisher</option>
            </select>
    <div id="list">
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
        @foreach($list as $item)
            <tr class="border-b dark:border-neutral-300 bg-neutral-200">
                <td class="p-5">{{$item['title']}}</td>
                <td >{{$item['author']}}</td>
                <td >{{$item['publication_year']}}</td>
                <td >{{$item['publisher']}}</td>
                <td >{{$item['isbn']}}</td>
                <td ><a href="{{route('edit',$item['isbn'])}}" class="text-green-700 underline hover:text-orange-800">Edit</a></td>
                <td ><button class="delete bg-red-400 rounded-sm px-2 py-2 hover:bg-red-600 hover:text-white transition-all ease" data-isbn="{{ $item['isbn'] }}">Delete</button></td>
            </tr>
        @endforeach
        </table>
    </div>
</div>
<div id="answer"></div>
</body>
</html>
<script>
$(document).ready(function() {
    $('#list').on('click', '.delete', function(e){
        e.preventDefault();
        var isbn = $(this).data('isbn');
       
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '{{route("destroy", ":isbn")}}'.replace(':isbn', isbn),
            type: 'DELETE',
            dataType: 'json',
            success: function(response) {
                
                alert(response.message);
                var newList = '<table class="min-w-full bg-white border border-gray-200">';
                newList += '<tr class="bg-neutral-700 text-white">';
                newList += '<td class="pl-8 py-3">Title</td>';
                newList +='<td class="pl-8">Author</td>';
                newList +='<td class="pl-8">Publication Year</td>';
                newList +='<td class="pl-8">Publisher</td>';
                newList +='<td class="pl-8">ISBN</td>';
                newList +='<td class="pl-8"></td>';
                newList +='<td class="pl-8"></td>';
                newList +='</tr>';

                $.each(response.list, function(index, item){
                    var route = "{{ route('edit', ':isbn') }}";
                    route = route.replace(':isbn', item.isbn);
                    newList += '<tr class="border-b dark:border-neutral-300 bg-neutral-200"><td class="p-5">' + item.title + '</td>';
                    newList +='<td>' + item.author + '</td>';
                    newList +='<td>' + item.publication_year + '</td>';
                    newList +='<td>' + item.publisher + '</td>';
                    newList +='<td>' + item.isbn + '</td>';
                    newList +='<td><a href="' + route + '" class="text-green-700 underline hover:text-orange-800">Edit</a></td>';
                    newList +='<td><button class="delete bg-red-400 rounded-sm px-2 py-2 hover:bg-red-600 hover:text-white transition-all ease" data-isbn="' + item.isbn + '">Delete</button></td></tr>';
                });

                newList+='</table>';
                $('#list').html(newList);
            },
            error: function(xhr, status, error) {
                
                $('#answer').text(error);
            }
        });
    });

    $('#filter').on('change', function(){

        if($(this).val()!== 'Choose a tipe of filter'){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{route("filter",":filterType")}}'.replace(':filterType', $(this).val()),
                type:'GET',
                data:{filterType:$(this).val()},

                success:function(response){
                    if('message' in response){
                        $('#answer').text(response.message);
                    }
                    else{
                        var newList = '<table class="min-w-full bg-white border border-gray-200">';
                        newList += '<tr class="bg-neutral-700 text-white">';
                        newList += '<td class="pl-8 py-3">Title</td>';
                        newList +='<td class="pl-8">Author</td>';
                        newList +='<td class="pl-8">Publication Year</td>';
                        newList +='<td class="pl-8">Publisher</td>';
                        newList +='<td class="pl-8">ISBN</td>';
                        newList +='<td class="pl-8"></td>';
                        newList +='<td class="pl-8"></td>';
                        newList +='</tr>';

                        $.each(response.list, function(index, item){
                            var route = "{{ route('edit', ':isbn') }}";
                            route = route.replace(':isbn', item.isbn);
                            newList += '<tr class="border-b dark:border-neutral-300 bg-neutral-200"><td class="p-5">' + item.title + '</td>';
                            newList +='<td>' + item.author + '</td>';
                            newList +='<td>' + item.publication_year + '</td>';
                            newList +='<td>' + item.publisher + '</td>';
                            newList +='<td>' + item.isbn + '</td>';
                            newList +='<td><a href="' + route + '" class="text-green-700 underline hover:text-orange-800">Edit</a></td>';
                            newList +='<td><button class="delete bg-red-400 rounded-sm px-2 py-2 hover:bg-red-600 hover:text-white transition-all ease" data-isbn="' + item.isbn + '">Delete</button></td></tr>';
                        });

                        newList+='</table>';
                        $('#list').html(newList);
                    }
                },

            });
        }
    });
});
</script>