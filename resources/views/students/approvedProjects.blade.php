@extends('components.head')
@section('title', 'Home')
@section('content')

<div class="flex gap-8">
    <div class="w-3/4">

        <h1 class="mb-8 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl">All projects</h1>
        {{-- @if($projects->count()) --}}
    <p class="mb-4">Nothing here yet, come back later or start your own project.</p>
    <hr>
{{-- @else --}}
    @foreach ($projects as $project)
    <a href="{{ route('project.details', $project->id) }}">
        <div class="rounded-xl border-2 overflow-hidden mb-8 p-4">
        <img src="{{$project->filepath}}" alt="project image">
        <p class="mb-4">{{$project->name}}</p>
        @if ($project->owner)
            <p>Created By: {{ $project->owner->name }}</p>
        @else
            <p class="mb-4">Created By: nobody</p>
        @endif
        <p class="mb-4">{{$project->description}}</p>
        </div>
    </a>

    @endforeach
{{-- @endif --}}

        <h1 class="mb-8 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl">That's it <br>Found nothing that appeals to you? <br>Becpme a Product Owner.</h1>
        <p class="mb-4">Do you have a brilliant idea waiting to come to life?
            This is your chance to become the leader you've always wanted to be.
            Apply as a Product Owner and lead your project to success with a dedicated
            team assembled by us. Let your idea change the world!
        </p>

        <button onclick="window.location = '{{route('projects.create')}}'" class="project-detail__applyButton rounded-full px-4 py-2 border-2">Transform my idea into reality</button>


       @endsection