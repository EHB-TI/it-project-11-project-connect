@extends('components.head')
@section('title', 'Project Details - ' . $project->name)

@section('content')
    <div class="flex gap-8">
        <div class="w-3/4">
            <h1 class="mb-8 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl">{{ $project->name }}</h1>
            <div id="details-content">

            </div>
        </div>
        <div class="w-1/4">
            <div class="rounded-xl border-2 overflow-hidden mb-8 p-4">
                <h1 class="mb-4 text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-4xl">Apply for this project</h1>
                <p class="mb-4">Want to be part of this project?</p>
                <button class="project-detail__applyButton rounded-full px-4 py-2 border-2">Apply now</button>
            </div>
            <ul class="rounded-xl border-2 overflow-hidden">
                <li class="border-b-2"><button id="overview" class="projectDetails__navButton w-full p-2">Overview</button></li>
                <li class="border-b-2"><button id="feedback" class="projectDetails__navButton w-full p-2">Feedback</button></li>
                <li class="border-b-2"><button id="members" class="projectDetails__navButton w-full p-2">Members</button></li>
                <li class=""><button id="applications" class="projectDetails__navButton w-full p-2">Applications</button></li>
            </ul>
        </div>
    </div>

    <script>
        let activeBgColor = 'bg-gray-700';
        let activeTextColor = 'text-white';
        document.addEventListener('DOMContentLoaded', function() {
            let projectId = {{ $project->id }};
            fetch('/project/details/overview/' + projectId)
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
                fetch('/project/details/' + section + '/' + projectId)
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

