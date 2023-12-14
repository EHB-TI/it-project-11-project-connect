@extends('components.head')
@section('title', 'Home')
@section('content')
<div class="app-container">
    <div class="app-content ml-[max(250px,_20%)] p-5">
        <h1>Projects</h1>
        @if ($projects->isEmpty())
            <hr>
            <p>There are not yet any project proposals. <br></p>
            <br>
            <br>
        @else
            @foreach ($projects as $project)
                @if($project->status = "published")
                    <div>
                        <img src="{{$project->filepath}}" alt="project image">
                        <p>{{$project->name}}</p>
                        <p>Created By: {{ $project->owner->name }}</p>
                    </div>
                @elseif($project->status = "pending")
                    <div>
                        <img src="{{$project->filepath}}" alt="project image">
                        <p>{{$project->name}}</p>
                        <p>Created By: {{ $project->owner->name }}</p>
                    </div>
                @elseif($project->status = "approved")
                    <div>
                        <img src="{{$project->filepath}}" alt="project image">
                        <p>{{$project->name}}</p>
                        <p>Created By: {{ $project->owner->name }}</p>
                    </div>
                    @elseif($project->status = "closed")
                    <div>
                        <img src="{{$project->filepath}}" alt="project image">
                        <p>{{$project->name}}</p>
                        <p>Created By: {{ $project->owner->name }}</p>
                    </div>
                    @elseif($project->status = "denied")
                    <div>
                        <img src="{{$project->filepath}}" alt="project image">
                        <p>{{$project->name}}</p>
                        <p>Created By: {{ $project->owner->name }}</p>
                        
                    </div>
            @endforeach
            <br>
            <br>
        @endif

{{--         
        <h1>Applications</h1>
        @if ($applications->count()===0)
            <hr>
            <p>There are not yet any applications. <br></p>
            <br>
        @else
            @foreach ($applications as $application)
                <div>
                    
                </div>
            @endforeach
            <br>
            <br>
        @endif --}}
    </div>
</div>

@endsection

