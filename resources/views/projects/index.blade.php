@extends('components.head')
@section('title', 'Home')
@section('content')

<div class="breadcrumbs">
    {!! Breadcrumbs::render('projects') !!}
</div>
<h2 class="subtitle mb-4 text-xl font-bold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl">Projects</h2>
@if($projects->isEmpty())
    <p class="mb-4">Nothing here yet, come back later or start your own project.</p>
@else
    <div class="project-card__container grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        @foreach ($projects as $project)
            <div class="project-card rounded-xl overflow-hidden hover:cursor-pointer"
                onclick="window.location.href='{{ route('projects.show', $project->id) }}'">
                <div class="project-card__image bg-cover bg-center w-full h-[200px] bg-amber-500"
                    style="background-image: url( {{ Storage::url($project->file_path) }} )"></div>
                <div class="project-card__content rounded-b-xl border-2 border-t-0 p-4 flex flex-col gap-2">
                    <h2 class="project-card__title text-2xl font-bold">{{ $project->name }}</h2>
                    <p class="project-card__owner">Created By: {{ $project->owner->name }}</p>
                    <div class="project-card__members flex items-center gap-4">
                        <div class="icon_placeholder w-8 h-8 bg-indigo-950 rounded-full"></div>
                        <p>{{ $project->users->count() }} / 5</p>
                    </div>
                    <p class="project-card__description">{{ $project->brief }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endif

<!--publish projects table-->
@if (Auth::user()->role == 'teacher')
    <table class="table-auto w-full text-left">
        <thead>
            <h2 class="subtitle mb-4 text-xl font-bold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl">
            <!-- Rest of your code -->
@endif
@endsection