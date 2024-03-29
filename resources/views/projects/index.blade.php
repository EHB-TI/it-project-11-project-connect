@extends('components.head')
@section('title', 'Projects')
@section('content')

@php
use App\Http\Middleware\StoreRoute;
@endphp
@include('components.breadcrumb', ['breadcrumbName' => StoreRoute::getCurrentRouteName(), 'id' => null])

    @if (Auth::user()->role == 'student')
        <h2 class="subtitle mb-4 text-xl font-bold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl">
            Projects</h2>
        @if ($projects->isEmpty())
            <p class="mb-4">Nothing here yet, come back later or start your own project.</p>
        @else
            <div class="project-card__container grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                @foreach ($projects as $project)
                    <div class="project-card rounded-xl overflow-hidden hover:cursor-pointer"
                        onclick="window.location.href='{{ route('projects.show', $project->id) }}'">
                        <div class="project-card__image bg-cover bg-center w-full md:h-[200px] bg-amber-500"
                            style="background-image: url( {{ Storage::url($project->file_path) }} )"></div>
                        <div class="project-card__content rounded-b-xl border-2 border-t-0 p-4 flex flex-col gap-2">
                            <h2 class="project-card__title text-2xl font-bold">{{ $project->name }}</h2>
                            <p class="project-card__owner">Created By: {{ $project->owner->name }}</p>
                            <div class="project-card__members flex items-center gap-4">
                                <div class="icon_placeholder w-8 h-8 bg-indigo-950 rounded-full"></div>
                                <p>{{ $project->users->count() }} / {{ $project->space->defaultTeamSize }}</p>
                            </div>
                            <p class="project-card__description">{{ $project->brief }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="project-page__end border-t-2 pt-8">
            <h2 class="text-2xl leading-none tracking-tight text-gray-900 md:text-3xl lg:text-4xl mb-4">That's it!</h2>
            <h1 class="text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl">Found nothing
                that appeals to you?</h1>
            <h1 class="text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl mb-4">Become a
                Product Owner.</h1>
            <p class="mb-4">Do you have a brilliant idea waiting to come to life?
                This is your chance to become the leader you've always wanted to be.
                Apply as a Product Owner and lead your project to success with a dedicated
                team assembled by us. Let your idea change the world!
            </p>

            <button onclick="window.location.href='{{ route('projects.create') }}'"
                    class="project-detail__applyButton rounded-full px-4 py-2 border-2">Transform my idea into reality
            </button>
        </div>
    @endif
    <!--publish projects table-->
    @if (Auth::user()->role == 'teacher')
    <!-- Publish All Button -->
    <form action="{{ route('projects.publishAll') }}" method="POST" class="mb-4">
        @csrf
        <button type="submit" class="bg-blue-500 text-white rounded-lg py-2 px-4">
            Publish All Projects
        </button>
        <p class="text-gray-600 mt-2">Clicking this button will publish all approved projects.</p>
    </form>

    <!-- Projects Table -->
    <table class="table-auto w-full text-left">
        <thead>
            <h2 class="subtitle mb-4 text-xl font-bold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl">
                Projects
            </h2>
            <tr>
                <th>Project Name</th>
                <th>Product-Owner</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr class="border-b-2 transition duration-200 hover:bg-gray-100 cursor-pointer"
                    onclick="window.location.href='{{ route('projects.show', $project->id) }}'">
                    <td class="p-2">
                        <a href="{{ route('projects.show', ['id' => $project->id]) }}">
                            {{ $project->name }}
                        </a>
                    </td>
                    <td class="p-2">{{ $project->owner->name }}</td>
                    <td class="p-2">
                        <div class="rounded-lg w-fit py-1 px-2
                            {{ $project->status == 'denied' || $project->status == 'closed' ? 'bg-red-300 text-red-800' : ($project->status == 'approved' || $project->status == 'published' ? 'bg-green-200 text-green-800' : 'bg-gray-200 text-gray-800') }}">
                            {{ $project->status }}
                        </div>
                    </td>
                    <!-- combined publish/unpublish button -->
                    <td class="p-2">
                        @if ($project->status == 'approved')
                            <form action="{{ route('projects.publish') }}" method="POST">
                                @csrf
                                <input type="hidden" name="project_id" value="{{ $project->id }}">
                                <button type="submit" class="bg-gray-400 rounded-lg w-fit py-1 px-2">Publish</button>
                            </form>
                        @elseif ($project->status == 'published')
                            <form action="{{ route('projects.unpublish', ['project' => $project->id]) }}"
                                method="POST">
                                @csrf
                                <button type="submit" class="bg-gray-400 rounded-lg w-fit py-1 px-2">Unpublish</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif


    @endsection
