@extends('components.head')
@section('title', 'Home')
@section('content')
<div class="app-container">
    <div class="app-content ml-[max(250px,_20%)] p-5">
        @if ($pendingProjects->count()===0 && $publishedProjects->count()===0 && $approvedProjects->count()===0 && $closedProjects->count()===0 && $deniedProjects->count()===0 )
        <h1>Projects</h1>
            <hr>
            <p>There are not yet any project proposals. <br></p>
            <br>
            <br>
        @else
            <h1>Pending Projects</h1>
            @foreach ($pendingProjects as $project)
                        <div>
                            <img src="{{$project->filepath}}" alt="project image">
                            <p>{{$project->name}}</p>
                            <p>Created By: {{ $project->owner->name }}</p>
                        </div>
            @endforeach
            <br>
            <h1>Published Projects</h1>
            @foreach ($publishedProjects as $project)
                        <div>
                            <img src="{{$project->filepath}}" alt="project image">
                            <p>{{$project->name}}</p>
                            <p>Created By: {{ $project->owner->name }}</p>
                        </div>
            @endforeach
            <br>
            <h1>Approved Projects</h1>
            @foreach ($approvedProjects as $project)
                        <div>
                            <img src="{{$project->filepath}}" alt="project image">
                            <p>{{$project->name}}</p>
                            <p>Created By: {{ $project->owner->name }}</p>
                        </div>
            @endforeach
            <br>
            <h1>Closed Projects</h1>
            @foreach ($closedProjects as $project)
                        <div>
                            <img src="{{$project->filepath}}" alt="project image">
                            <p>{{$project->name}}</p>
                            <p>Created By: {{ $project->owner->name }}</p>
                        </div>
            @endforeach
            <br>
            <h1>Denied Projects</h1>
            @foreach ($deniedProjects as $project)
                    
                        <div>
                            <img src="{{$project->filepath}}" alt="project image">
                            <p>{{$project->name}}</p>
                            <p>Created By: {{ $project->owner->name }}</p>
                        </div>
            @endforeach
            <br>
            <br>
        @endif


    </div>
</div>

@endsection

