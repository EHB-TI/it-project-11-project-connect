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


@if($previousRoute === "applications.index")
    <div class="breadcrumbs">
        {!! Breadcrumbs::render('project_details_routeA', $project->id) !!}
    </div>

@else
    <div class="breadcrumbs">
        {!! Breadcrumbs::render('project_details_routeB', $project->id) !!}
    </div>
@endif


    <div class="flex gap-8">
        <div class="w-3/4">
            <h1 class="mb-8 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl">{{ $project->name }}</h1>
            <h2 class="subtitle mb-4 text-xl font-bold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl">Overview</h2>
            <div id="details-content">
                @include('projects.detail-sections.overview', ['project' => $project])
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
                <x-application-box title="You are the owner of this project!" message="status of project:" status="{{ $project->status }}"  route="projects.edit"  projectId="{{$project->id }}" buttonText="Edit project"  />
                    
            @endif
            @if($project->isMember(Auth::user()))
                <x-application-box title="You are a member of this project!" message="Good luck, make something awesome!" />
            @elseif(Auth::user()->isMemberofAnyProject() && !$project->isMember(Auth::user()))
                <x-application-box title="You are already a member of another project!" message="Here it is:" route="projects.show" projectId="{{ Auth::user()->projects()->first()->id }}" buttonText="To your project" />
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

        let projectDetailsNavButtons = document.querySelectorAll('.projectDetails__navButton');
        let subtitle = document.querySelector('.subtitle');

        projectDetailsNavButtons.forEach(button => {
            button.addEventListener('click', function() {
                let section = this.getAttribute('id');
                let project_id = {{ $project->id }};

                // Remove active classes from all buttons
                projectDetailsNavButtons.forEach(button => {
                    button.parentNode.classList.remove(activeBgColor, activeTextColor);
                });

                // Add active classes to the clicked button
                button.parentNode.classList.add(activeBgColor, activeTextColor);

                // Update the subtitle
                subtitle.textContent = button.textContent;

                // Fetch the new content
                fetch('/projects/details/' + section + '/' + project_id)
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('details-content').innerHTML = data;
                    });
            });
        });
    </script>
@endsection

