@extends('components.head')
@section('title', 'Home')
@section('content')

    <div class="flex gap-8">

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

</div>

    </div>


@endsection

