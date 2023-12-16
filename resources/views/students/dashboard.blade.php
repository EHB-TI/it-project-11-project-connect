@extends('components.head')
@section('title', 'Home')
@section('content')
<div class="flex gap-8">
    <div class="w-3/4">

        <div class="w-1/4">
            <div class="rounded-xl border-2 overflow-hidden mb-8 p-4">
                <h1 class="mb-4 text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-4xl">Next Deadline</h1>
                <p class="mb-4">Potential product owner: Pitch your creative concept</p>
                <p class="mb-4"> <strong>Who?</strong> </p>
                <p class="mb-4"><strong>When?</strong></p>
                {{-- <p class="mb-4">hier komt deadline</p> --}}

            </div>
            
        </div>

        <h1 class="mb-8 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl">My Projects</h1>
        @if ($projects->isEmpty())
            <hr>
            <p>You have not yet submitted any proposals. <br>
                Click here to submit a proposal.</p>
            <br>
            <br>
        @else
            @foreach ($projects as $project)
                <div class="rounded-xl border-2 overflow-hidden mb-8 p-4">
                    <img src="{{$project->filepath}}" alt="project image">
                    <p class="mb-4">{{$project->name}}</p>
                    <p class="mb-4">Created By: {{ $project->owner->name }}</p>
                    <p class="mb-4">Status:{{$project->status}}</p>
                </div>
            @endforeach
            <br>
            <br>
        @endif

        
        <h1 class="mb-8 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl">My applications</h1>
        @if ($applications->count()===0)
            <hr>
            <p class="mb-4">You have not yet submitted any proposals. <br>
                Click here to submit a proposal.</p>
            <br>
        @else
            @foreach ($applications as $application)
                <div class="rounded-xl border-2 overflow-hidden mb-8 p-4">
                    <p class="mb-4">{{$application->motivationContent}}</p>
                    {{-- <p>Created By: {{ $application->owner->name }}</p> --}}
                    <p class="mb-4">Created By: {{ $application->created_at }}</p>
                    <p class="mb-4">Status:{{$application->status}}</p>
                    <p class="mb-4">Reason:{{$application->reason}}</p>
                </div>
            @endforeach
            <br>
            <br>
        @endif
    </div>
</div>

@endsection

