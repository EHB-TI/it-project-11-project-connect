@extends('components.head')
@section('title', 'Home')
@section('content')

@if(Auth::check() && Auth::user()->hasRole('teacher'))
    <a href="{{ route('spaces.create') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
        Create New Space
    </a>
@endif


<div class="grid grid-cols-3 gap-4">
    @foreach($spaces as $space)
        <div class="cursor-pointer bg-white border-2 hover:border-yellow-500 text-black font-bold py-4 px-4 mt-2 rounded">
            <a href="{{ route('dashboard', $space->id)}}">{{ $space->name }}</a>
        </div>
    @endforeach
</div>

@endsection
