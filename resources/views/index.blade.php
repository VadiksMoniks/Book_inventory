<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script>
    @vite('resources/css/app.css')
</head>
<body>
    <p class="text-3xl font-bold text-orange-500 m-8 text-center">Book List</p>
    <div class="m-8 w-7/12 mx-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <tr class="bg-neutral-700 text-white">
                <td class="pl-8 py-3">Title</td>
                <td class="pl-8">Author</td>
                <td class="pl-8">Publication Year</td>
                <td class="pl-8">Publisher</td>
                <td class="pl-8">ISBN</td>
            </tr>
        @foreach($book_list as $item)
            <tr class="border-b dark:border-neutral-300">
                <td class="p-5">{{$item['title']}}</td>
                <td class="p-5">{{$item['author']}}</td>
                <td class="p-5">{{$item['publication_year']}}</td>
                <td class="p-5">{{$item['publisher']}}</td>
                <td class="p-5">{{$item['isbn']}}</td>
            </tr>
        @endforeach
        </table>
    </div>
</body>
</html>