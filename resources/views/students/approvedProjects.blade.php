@extends('components.head')
@section('title', 'Home')
@section('content')

<div class="app-container">
    <div class="app-content ml-[max(250px,_20%)] p-5">

        <h1>All projects</h1>
        {{-- @if($projects->count()) --}}
    <p>Nothing here yet, come back later or start your own project.</p>
    <hr>
{{-- @else --}}
    @foreach ($projects as $project)
    <a href="{{ route('project.details', $project->id) }}">

        <img src="{{$project->filepath}}" alt="project image">
        <p>{{$project->name}}</p>
        @if ($project->owner)
            <p>Created By: {{ $project->owner->name }}</p>
        @else
            <p>Created By: nobody</p>
        @endif
        <p>{{$project->description}}</p>
    </a>

    @endforeach
{{-- @endif --}}

        <h1>That's it <br>Found nothing that appeals to you? <br>Becpme a Product Owner.</h1>
        <p>Do you have a brilliant idea waiting to come to life?
            This is your chance to become the leader you've always wanted to be.
            Apply as a Product Owner and lead your project to success with a dedicated
            team assembled by us. Let your idea change the world!
        </p>

        <button onclick="window.location = '{{route('approvedProject')}}'">Transform my idea into reality</button>


       @endsection