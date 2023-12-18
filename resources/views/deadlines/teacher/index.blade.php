@extends('components.head')
@section('title', 'Deadlines')

@section('content')
        <h2 class="subtitle mb-4 text-xl font-bold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl">Deadlines</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($deadlines as $deadline)
                <div class="bg-white border-2 p-4 rounded">
                    <h1 class="text-lg font-semibold mb-2">{{ $deadline->title }}</h1>

                    <div class="mb-2">
                        <strong class="text-gray-700">Who?</strong>
                        <p>{{ $deadline->who }}</p>
                    </div>

                    <div class="mb-2">
                        <strong class="text-gray-700">What?</strong>
                        <p>{{ $deadline->what }}</p>
                    </div>

                    <div>
                        <strong class="text-gray-700">When?</strong>
                        <p>{{ $deadline->end_date }}</p>
                    </div>
                </div>
            @endforeach


            <div class="flex items-center justify-center border-2 p-4 rounded cursor-pointer hover:bg-gray-200" onclick="window.location.href='{{ route('deadlines.create') }}'">
                <p class="text-2xl">+</p>
            </div>
        </div>
@endsection
