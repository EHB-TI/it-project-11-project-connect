<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @vite('resources/js/markdown.js')
</head>
<body>
    {{--DEVELOPMENT TOOL--}}
    {{--only show in development environment--}}
    @if (app()->environment('local'))
        <div id="test-auth" class="test-auth fixed bottom-4 right-4 p-4 border-2 rounded-lg bg-indigo-950 text-white z-50">
            <button id="close-button" onclick="toggleTestAuth()" class="absolute top-0 right-2 p-1 rounded-full text-3xl">x</button>
            <h1 class="text-2xl">Test authentication</h1>
            <p>login a user with the corresponding role</p>
            <button onclick="promptForUserId()" class="p-1 bg-white text-indigo-950 rounded-lg">Login with User ID</button>
        </div>
        <button id="test-auth__button" onclick="toggleTestAuth()" class="hidden fixed bottom-4 right-4 p-4 border-2 rounded-lg bg-indigo-950 text-white z-50">Auth</button>
    @endif

    <div class="app-container">

        @include('components.nav-bar')
        <div class="app-content md:ml-[max(250px,_20%)] p-10 pt-14 md:p-10">
            @if(session('status'))
                <div class="bg-blue-500 text-white px-4 py-3 mb-2 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('status') }}</span>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
    <script>
        function toggleTestAuth() {
            const testAuth = document.getElementById('test-auth');
            const testAuthButton = document.getElementById('test-auth__button');
            testAuth.classList.toggle('hidden');
            testAuthButton.classList.toggle('hidden');
        }

        function promptForUserId() {
            var userId = prompt("Please enter your User ID:");
            if (userId) {
                window.location.href = '/login/' + userId;
            }
        }
    </script>
</body>
</html>
