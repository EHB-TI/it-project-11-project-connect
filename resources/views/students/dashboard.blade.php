@extends('components.head')
@section('title', 'Home')
@section('content')
<div class="app-container">
    <div class="app-content ml-[max(250px,_20%)] p-5">
        <h1>My Projects</h1>
        @if ($projects->isEmpty())
            <hr>
            <p>You have not yet submitted any proposals. <br>
                Click here to submit a proposal.</p>
            <br>
            <br>
        @else
            @foreach ($projects as $project)
                <div>
                    <img src="{{$project->filepath}}" alt="project image">
                    <p>{{$project->name}}</p>
                    <p>Created By: {{ $project->owner->name }}</p>
                    <p>Status:{{$project->status}}</p>
                </div>
            @endforeach
            <br>
            <br>
        @endif

        
        <h1>My applications</h1>
        @if ($applications->count()===0)
            <hr>
            <p>You have not yet submitted any proposals. <br>
                Click here to submit a proposal.</p>
            <br>
        @else
            @foreach ($applications as $application)
                <div>
                    <p>{{$application->motivationContent}}</p>
                    {{-- <p>Created By: {{ $application->owner->name }}</p> --}}
                    <p>Created By: {{ $application->created_at }}</p>
                    <p>Status:{{$application->status}}</p>
                    <p>Reason:{{$application->reason}}</p>
                </div>
            @endforeach
            <br>
            <br>
        @endif
    </div>
</div>

@endsection

