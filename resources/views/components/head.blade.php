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
</head>
<body>
    {{--DEVELOPMENT TOOL--}}
    {{--only show in development environment--}}
    @if (app()->environment('local'))
        <div class="test-auth fixed bottom-4 right-4 p-4 border-2 rounded-lg bg-indigo-950 text-white">
            <h1 class="text-2xl">Test authentication</h1>
            <p>login a user with the corresponding role</p>
            <div class="grid grid-cols-2 gap-2 mt-2">
                <button onclick="window.location.href='/login/student'" class="p-1 bg-white text-indigo-950 rounded-lg">Login as student</button>
                <button onclick="window.location.href='/login/teacher'" class="p-1 bg-white text-indigo-950 rounded-lg">Login as teacher</button>
            </div>
        </div>
    @endif

    <div class="app-container">
        @include('components.nav-bar')
        <div class="app-content ml-[max(250px,_20%)] p-10">
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
