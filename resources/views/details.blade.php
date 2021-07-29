<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Reading List Assessment | booj</title>
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    </head>
    <body class="bg-gray-200">
        <div class="flex justify-center">
            <div class="w-3/6 rounded-lg p-10">
                <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">{{ $book->title }}</div>
                        <p class="text-gray-700 text-base"><label class="text-gray-700 font-bold">Author:</label> {{ $book->author }}</p>
                        <p class="text-gray-700 text-base"><label class="text-gray-700 font-bold">Pages:</label> {{ $book->pages }}</p>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script src="https://kit.fontawesome.com/e9a5865a71.js" crossorigin="anonymous"></script>
    </body>
</html>