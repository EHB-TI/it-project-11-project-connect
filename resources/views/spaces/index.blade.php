@extends('components.head')
@section('title', 'Home')
@section('content')
    <h2 class="subtitle mb-4 text-xl font-bold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl">Spaces</h2>
    <p>Select a space:</p>

    @if(Auth::check() && Auth::user()->hasRole('teacher'))
        <a href="{{ route('spaces.create') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold mb-4 py-2 px-4 rounded">
            Create New Space
        </a>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($spaces as $space)
            <form action="{{ route('spaces.select') }}" method="POST">
                @csrf
                <input name="space_id" value="{{ $space->id }}" class="hidden" />
                <button type="submit" class="cursor-pointer text-center bg-white border-2 hover:border-yellow-500 text-black font-bold w-full h-16 rounded-lg">
                    {{ $space->name }}
                </button>
            </form>
        @endforeach
    </div>

@endsection
