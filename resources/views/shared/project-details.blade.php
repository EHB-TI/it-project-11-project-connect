@extends('components.head')
@section('title', 'Home')

@section('content')
    <div class="flex">
        <div class="w-2/3">
            <h1 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl">{{ $project->name }}</h1>
        </div>
        <div class="w-1/3 pl-5">
            @php
                $parsedown = new Parsedown();
            @endphp
            <div id="details-content">
                {!! $parsedown->text($project->description) !!}
            </div>
        </div>
    </div>
@endsection
