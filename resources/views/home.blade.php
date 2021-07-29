@extends('layouts.app')

@section('framework-styles')
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

<style>
    html, body {
        height: 89vh;
        margin: 0;
    }

    .full-height {
        height: 89vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
    }

    .m-b-md {
        margin-bottom: 30px;
    }

    #api_link:hover {
        font-weight: bold;
    }
    </style>
@endsection

@section('content')
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            Reading List   
        </div>
        <div class="text-gray-700 px-4 py-3 mb-3 rounded relative" role="alert">
            <p><strong class="font-bold">NOTE 1:</strong></p>
            <p><span class="block sm:inline">The Postman Collection is located in storage/</span></p>
        </div>
        <div class="text-gray-700 px-4 py-3 mb-3 rounded relative" role="alert">
            <p><strong class="font-bold">NOTE 2:</strong></p>
            <p><span class="block sm:inline">Access <a id="api_link" href="{{ route('api.books') }}"><u>API HERE</u></a></span></p>
        </div>
        <div class="text-gray-700 px-4 py-3 rounded relative" role="alert">
            <p><span class="block sm:inline">I managed to create a web app, similar to the API Assessment but with a little twist.</p>
            <p>If you would like to check it out, please register and log in. :)</span></p>
            <p class="mt-8">Thank you for viewing my work.</p>
            <p class="italic mt-2">- Anthony Lee</p>
        </div>
    </div>
</div>

@endsection