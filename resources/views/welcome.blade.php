@extends('components.head')
@section('title', 'Home')

@section('content')
    <!-- Hier voeg je de content van de pagina toe -->
    <div>Welcome</div>
    @if(Auth::check() )
        <div class="text-2xl">Welcome, {{ Auth::user()->name }}</div>
    @else
        <div class="text-2xl">No user is logged in yet, use the dev tools in the bottom right to mock CAS authentication of a student or teacher account</div>
    @endif
@endsection
