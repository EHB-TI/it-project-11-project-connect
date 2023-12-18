@extends('components.head')
@section('title', 'Project Details - ' . $project->name)

@section('content')
@php
use Illuminate\Support\Facades\Auth;
use \App\Constants\ProjectDetailsItems as ProjectDetailsItemsAlias;
$projectDetailItems = [];
if (Auth::user()->role == 'teacher') {
$projectDetailItems = ProjectDetailsItemsAlias::TEACHER;
} elseif (Auth::user()->role == 'student' && Auth::user()->id == $project->user_id) {
$projectDetailItems = ProjectDetailsItemsAlias::PRODUCT_OWNER;
} elseif (Auth::user()->role == 'student') {
$projectDetailItems = ProjectDetailsItemsAlias::STUDENT;
}
@endphp
    <div class="flex gap-8">
        <div class="w-3/4">
            <h1 class="mb-8 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl">{{ $project->name }}</h1>
            <div id="details-content">

            </div>
        </div>
        <div class="w-1/4">
            @if($project->canApply(Auth::user()))
                <x-application-box title="Apply for this project" message="Want to be part of this project?" route="applications.create" projectId="{{ $project->id }}" buttonText="Apply now" />
            @endif
            @if($project->hasApplied(Auth::user()))
                <x-application-box title="You have applied for this project!" message="status of application:" status="{{ $project->applicationStatus(Auth::user()) }}" />
            @endif
            @if($project->isOwner(Auth::user()))
                <x-application-box title="You are the owner of this project!" message="status of project:" status="{{ $project->status }}" />
            @endif
            @if($project->isMember(Auth::user()))
                <x-application-box title="You are a member of this project!" message="status of project:" status="{{ $project->status }}" />
            @elseif(Auth::user()->isMemberofAnyProject() && !$project->isMember(Auth::user()))
                <x-application-box title="You are already a member of another project!" message="Here it is" route="projects.show" projectId="{{ Auth::user()->$project->id }}" status="{{ Auth::user()->$project->id }}" />
            @endif
            <ul class="rounded-xl border-2 overflow-hidden">
                @foreach($projectDetailItems as $projectDetailItem => $route)
                    <li class="border-b-2">
                        <button id="{{$route}}" class="projectDetails__navButton w-full p-2">{{$projectDetailItem}}</button>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <script>
        let activeBgColor = 'bg-gray-700';
        let activeTextColor = 'text-white';
        document.addEventListener('DOMContentLoaded', function() {
            let projectId = {{ $project->id }};
            fetch('/projects/details/overview/' + projectId)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('details-content').innerHTML = data;
                    document.getElementById('overview').parentNode.classList.add(activeBgColor, activeTextColor);
                });
        });

        document.querySelectorAll('.projectDetails__navButton').forEach(button => {
            button.addEventListener('click', function() {
                let section = this.getAttribute('id');
                let projectId = {{ $project->id }};
                fetch('/projects/details/' + section + '/' + projectId)
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('details-content').innerHTML = data;
                        document.querySelectorAll('li').forEach(li => {
                            li.classList.remove(activeBgColor, activeTextColor);
                        });
                        this.parentNode.classList.add(activeBgColor, activeTextColor);
                    });
            });
        });
    </script>
@endsection

