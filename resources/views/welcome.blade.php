@extends('components.head')
@section('title', 'Home')

@section('content')
    <!-- Hier voeg je de content van de pagina toe -->
    @Auth
        <div class="text-2xl">Welcome, {{ Auth::user()->name }}</div>
    @endauth
    @guest
        <div class="text-2xl">No user is logged in yet, use the dev tools in the bottom right to mock CAS authentication of a student or teacher account</div>
        <div class="text-red-500 text-3xl">Login button in nav does not work and will not have to. Guests will immediatly be sent to the CAS.</div>
    @endguest
@endsection
