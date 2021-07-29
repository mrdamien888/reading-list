<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Reading List | Anthony</title>

        @yield('framework-styles')

        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    </head>
    <body class="bg-gray-200">
        <nav class="p-6 bg-white flex justify-between mb-6">
            <ul class="flex items-center">
                <li>
                    <a href="/" class="p-3 font-bold text-xl">Anthony Lee</a>
                </li>
                @auth
                <li>
                    <a href="{{ route('books') }}" class="p-3 text-xl">Books</a>
                </li>
                @endauth
            </ul>

            <ul class="flex items-center">
                @auth
                    <li>
                        <a href="#" class="p-3 text-xl">{{ auth()->user()->username }}</a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="post" class="p-3 inline">
                            @csrf
                            <button type="submit" class="text-xl">Logout</button>
                        </form>
                    </li>
                @endauth

                @guest
                    <li>
                        <a href="{{ route('login') }}" class="p-3 text-xl">Login</a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="p-3 text-xl">Register</a>
                    </li>
                @endguest
            </ul>
        </nav>

        @yield('content')

        @yield('framework-scripts')

        @yield('scripts')

    </body>
</html>