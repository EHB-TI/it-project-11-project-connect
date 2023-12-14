{{-- @extends('components.head')
@section('title', 'Home') --}}

<div class="app-container">
    @include('components.nav-bar')
    <div class="app-content ml-[max(250px,_20%)] p-5">

        <h1>All projects</h1>
        @if($projects->isEmpty())
    <p>Nothing here yet, come back later or start your own project.</p>
    <hr>
@else
<a href="{{ route('', $project->id) }}">
    @foreach ($projects as $project)
        <img src="{{$project->filepath}}" alt="project image">
        <p>{{$project->name}}</p>
        @if ($project->owner)
            <p>Created By: {{ $project->owner->name }}</p>
        @else
            <p>Created By: nobody</p>
        @endif
        <p>{{$project->description}}</p>
    @endforeach
</a>
@endif

        <h1>That's it <br>Found nothing that appeals to you? <br>Becpme a Product Owner.</h1>
        <p>Do you have a brilliant idea waiting to come to life?
            This is your chance to become the leader you've always wanted to be.
            Apply as a Product Owner and lead your project to success with a dedicated
            team assembled by us. Let your idea change the world!
        </p>

        <button onclick="window.location = '{{route('approvedProject')}}'">Transform my idea into reality</button>


        {{-- @extends('components.footer')
        @section('title', 'Home') --}}