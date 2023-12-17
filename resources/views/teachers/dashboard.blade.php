@extends('components.head')
@section('title', 'Home')
@section('content')

    <div class="flex gap-8">
        @if (session('status'))
        <div class="bg-blue-500 text-white px-4 py-3 mb-2 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('status') }}</span>
        </div>
        @endif
        <div class="w-1/4">
            <div class="rounded-xl border-2 overflow-hidden mb-8 p-4">
                <h1 class="mb-4 text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-4xl">Next Deadline</h1>
                <p class="mb-4">Potential product owner: Pitch your creative concept</p>
                <p class="mb-4"> <strong>Who?</strong> </p>
                <p class="mb-4"><strong>When?</strong></p>
                {{-- <p class="mb-4">hier komt deadline</p> --}}

            </div>
            
        </div>
    <div class="w-3/4">
        @if ($pendingProjects->count()===0 && $publishedProjects->count()===0 && $approvedProjects->count()===0 && $closedProjects->count()===0 && $deniedProjects->count()===0 )
        <h1 class="mb-8 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl">Projects</h1>
            <hr>
            <p class="mb-4">There are not yet any project proposals. <br></p>
            <br>
            <br>
        @else
        <h1 class="mb-8 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl">Pending Projects</h1>
            @foreach ($pendingProjects as $project)
                        <div class="rounded-xl border-2 overflow-hidden mb-8 p-4">
                            <img src="{{$project->filepath}}" alt="project image">
                            <p class="mb-4">{{$project->name}}</p>
                            <p class="mb-4">Created By: {{ $project->owner->name }}</p>
                        </div>
            @endforeach
            <br>
            <h1 class="mb-8 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl">Published Projects</h1>
            @foreach ($publishedProjects as $project)
                        <div class="rounded-xl border-2 overflow-hidden mb-8 p-4">
                            <img src="{{$project->filepath}}" alt="project image">
                            <p class="mb-4">{{$project->name}}</p>
                            <p class="mb-4">Created By: {{ $project->owner->name }}</p>
                        </div>
            @endforeach
            <br>
            <h1 class="mb-8 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl">Approved Projects</h1>
            @foreach ($approvedProjects as $project)
                        <div class="rounded-xl border-2 overflow-hidden mb-8 p-4">
                            <img src="{{$project->filepath}}" alt="project image">
                            <p class="mb-4">{{$project->name}}</p>
                            <p class="mb-4">Created By: {{ $project->owner->name }}</p>
                        </div>
            @endforeach
            <br>
            <h1 class="mb-8 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl">Closed Projects</h1>
            @foreach ($closedProjects as $project)
                        <div class="rounded-xl border-2 overflow-hidden mb-8 p-4">
                            <img src="{{$project->filepath}}" alt="project image">
                            <p class="mb-4">{{$project->name}}</p>
                            <p class="mb-4">Created By: {{ $project->owner->name }}</p>
                        </div>
            @endforeach
            <br>
            <h1 class="mb-8 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl">Denied Projects</h1>
            @foreach ($deniedProjects as $project)
                    
                        <div class="rounded-xl border-2 overflow-hidden mb-8 p-4">
                            <img src="{{$project->filepath}}" alt="project image">
                            <p class="mb-4">{{$project->name}}</p>
                            <p class="mb-4">Created By: {{ $project->owner->name }}</p>
                        </div>
            @endforeach
            <br>
            <br>
        @endif

    </div>
    <div id="postModal" title="Create Project" class="p-5">
    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" id="post-form"
        data-route="{{ route('projects.store') }}" class="space-y-4">

        @csrf

        <label for="Title" class="block font-semibold">Project Title:</label>
        <input type="text" id="Title" name="Title" class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:border-blue-500">

        <label for="description" class="block font-semibold">Project Description:</label>
        <textarea id="description" name="description" rows="4" cols="50" class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:border-blue-500"></textarea>

        {{-- This part is for Markdown --}}
        <!--
        <div class="flex flex-col space-y-2">
            <label for="editor" class="block font-semibold">Description:</label>
            <div id="editor" class="block w-full rounded-md border border-gray-300 shadow-sm"></div>
        </div>
        <input type="hidden" name="content" id="content">
        -->

        <input type="number" name="user" id="user_id" style="display: none;" value="{{Auth::id()}}">

        <input type="submit" value="Create Project" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 cursor-pointer">
    </form>
</div>

    </div>


@endsection

