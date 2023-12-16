@extends('components.head')
@section('title', 'Home')
@section('content')

        <h1 class="mb-8 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl">All
            projects</h1>
        @if($projects->isEmpty())
        <p class="mb-4">Nothing here yet, come back later or start your own project.</p>
        @else
        <div class="project-card__container grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            @foreach ($projects as $project)
                <div class="project-card rounded-xl overflow-hidden hover:cursor-pointer"
                     onclick="window.location.href='{{ route('project.details', $project->id) }}'">
                    <div class="project-card__image bg-cover bg-center w-full h-[200px] bg-amber-500"
                         style="background-image: url( {{$project->name}} )"></div>
                    <div class="project-card__content border-2 p-4 flex flex-col gap-2 rounded-xl>
                        <h2 class="project-card__title text-2xl font-bold">{{$project->name}}</h2>
                        <p class="project-card__owner">Created By: {{ $project->owner->name }}</p>
                        <div class="project-card__members flex items-center gap-4">
                            <div class="icon_placeholder w-8 h-8 bg-indigo-950 rounded-full"></div>
                            <p>3 / 5 Members</p>
                        </div>
                        <p class="project-card__description">{{$project->description}}</p>
                    </div>
                </div>
            @endforeach
        </div>

        @endif
        <div class="project-page__end border-t-2 pt-8">
            <h2 class="text-2xl leading-none tracking-tight text-gray-900 md:text-3xl lg:text-4xl mb-4">That's it!</h2>
            <h1 class="text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl">Found nothing that appeals to you?</h1>
            <h1 class="text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl mb-4">Become a Product Owner.</h1>
            <p class="mb-4">Do you have a brilliant idea waiting to come to life?
                This is your chance to become the leader you've always wanted to be.
                Apply as a Product Owner and lead your project to success with a dedicated
                team assembled by us. Let your idea change the world!
            </p>

            <button onclick="window.location.href='{{route('projects.create')}}'" class="project-detail__applyButton rounded-full px-4 py-2 border-2">Transform my idea into reality
            </button>
        </div>
@endsection
