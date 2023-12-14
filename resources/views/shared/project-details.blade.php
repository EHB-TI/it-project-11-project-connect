@extends('components.head')
@section('title', 'Home')

@section('content')
    <div class="flex">
        <div class="w-2/3">
            <h1 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl">{{ $project->name }}</h1>
            <div id="details-content">

            </div>
        </div>
        <div class="w-1/3 pl-5">
            <ul class="rounded-xl border-2">
                <li class="border-b-2"><button id="overview" class="projectDetails__button w-full p-2">Overview</button></li>
                <li class="border-b-2"><button id="feedback" class="projectDetails__button w-full p-2">Feedback</button></li>
                <li class="border-b-2"><button id="members" class="projectDetails__button w-full p-2">Members</button></li>
                <li class=""><button id="applications" class="projectDetails__button w-full p-2">Applications</button></li>
            </ul>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let projectId = {{ $project->id }};
            fetch('/project/details/overview/' + projectId)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('details-content').innerHTML = data;
                });
        });

        document.querySelectorAll('button').forEach(button => {
            button.addEventListener('click', function() {
                let section = this.getAttribute('id');
                let projectId = {{ $project->id }}
                fetch('/project/details/' + section + '/' + projectId)
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('details-content').innerHTML = data;
                    });
            });
        });
    </script>
@endsection

