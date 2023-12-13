<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>hello world</title>
   @vite('resources/css/app.css')
</head>
<body>
    @include('components.nav-bar')

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>