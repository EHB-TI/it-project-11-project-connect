@extends('components.head')
@section('title', 'Project Details - ' . $project->name)

@section('content')
    @php
        use Illuminate\Support\Facades\Auth;
        use \App\Constants\ProjectDetailsItems as ProjectDetailsItemsAlias;
        use App\Http\Middleware\StoreRoute;

        $projectDetailItems = [];
        if (Auth::user()->role == 'teacher') {
        $projectDetailItems = ProjectDetailsItemsAlias::TEACHER;
        } elseif (Auth::user()->role == 'student' && Auth::user()->id == $project->user_id) {
        $projectDetailItems = ProjectDetailsItemsAlias::PRODUCT_OWNER;
        } elseif (Auth::user()->role == 'student') {
        $projectDetailItems = ProjectDetailsItemsAlias::STUDENT;
        }

        $previousRoute = session('previousRoute', StoreRoute::getPreviousRouteName());
        session(['previousRoute' => $previousRoute]);
        //dd($previousRoute);
        $reviews = $project->reviews;
    
    @endphp


    @include('components.breadcrumb', ['breadcrumbName' => $previousRoute, 'id' => $project->id])

    <div class="flex gap-8">
        <div class="w-3/4">
            <h1 class="mb-8 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl">{{
            $project->name }}</h1>
            <h2 id="subtitle"
                class="subtitle mb-4 text-xl font-bold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl">
            </h2>
            <div id="details-content">
                @include('projects.detail-sections.overview', ['project' => $project])
            </div>
        </div>
        <div class="w-1/4">
            @if(Auth::user()->role == 'teacher')
                <div class="flex flex-col gap-4 mb-8">
                    <h2>Reviews</h2>
                    @foreach($reviews as $review)
                        <div class="flex justify-between">
                            <h3>{{ $review->user->name }}</h3>
                            <p>{{ $review->status ? 'Approved' : 'Disapproved' }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="rounded-xl border-2 overflow-hidden mb-8 p-4">
                    <h2 class="mb-4 text-2xl">Review this project</h2>
                    <div class="flex">
                        <form action="{{ route('projects.review', ['id' => $project->id, 'status' => 'approve']) }}"
                              method="POST">
                            @csrf
                            <button type="submit" class="block w-fit rounded-full px-4 py-2 border-2 text-white bg-green-800">Looks good</button>
                        </form>
                        <form action="{{ route('projects.review', ['id' => $project->id, 'status' => 'disapprove']) }}"
                              method="POST">
                            @csrf
                            <button type="submit" class="block w-fit rounded-full px-4 py-2 border-2 text-white bg-red-800">Needs work</button>
                        </form>
                    </div>
                </div>
            @endif
            @if($project->canApply(Auth::user()))
                <x-application-box title="Apply for this project" message="Want to be part of this project?"
                                   route="applications.create" projectId="{{ $project->id }}" buttonText="Apply now"/>
            @endif
            @if($project->hasApplied(Auth::user()))
                <x-application-box title="You have applied for this project!" message="status of application:"
                                   status="{{ $project->applicationStatus(Auth::user()) }}"/>
            @endif
            @if($project->isOwner(Auth::user()))
                <x-application-box title="You are the owner of this project!" message="status of project:"
                                   status="{{ $project->status }}" route="projects.edit" projectId="{{$project->id }}"
                                   buttonText="Edit project"/>

            @endif
            @if($project->isMember(Auth::user()))
                <x-application-box title="You are a member of this project!"
                                   message="Good luck, make something awesome!"/>
            @elseif(Auth::user()->isMemberofAnyProject() && !$project->isMember(Auth::user()))
                <x-application-box title="You are already a member of another project!" message="Here it is:"
                                   route="projects.show" projectId="{{ Auth::user()->projects()->first()->id }}"
                                   buttonText="To your project"/>
            @endif
            <ul class="rounded-xl border-2 overflow-hidden">
                @foreach($projectDetailItems as $projectDetailItem => $route)
                    <li class="border-b-2">
                        <button id="{{$route}}"
                                class="projectDetails__navButton w-full p-2">{{$projectDetailItem}}</button>
                    </li>
                @endforeach
            </ul>

            @if(Auth::user()->role == 'teacher' && $project->status != 'published')
            <div class="rounded-xl border-2 overflow-hidden mb-8 p-4 mt-4">
                <h2 class="mb-4 text-2xl">Adjust status: {{$project->status}}</h2>
                <div class="flex">
                    <form action="{{ route('projects.approve', ['project' => $project->id]) }}"
                          method="POST">
                        @csrf
                        <button type="submit" class="block w-fit rounded-full px-4 py-2 border-2 text-white bg-green-800">approve</button>
                    </form>
                    <form action="{{ route('projects.reject', ['project' => $project->id]) }}"
                          method="POST">
                        @csrf
                        <button type="submit" class="block w-fit rounded-full px-4 py-2 border-2 text-white bg-red-800">reject</button>
                    </form>
                </div>
            </div>
            @endif

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let activeBgColor = 'bg-gray-700';
            let activeTextColor = 'text-white';
            let projectId = {{ $project->id }};
            let section;

            const updateContentAndClasses = (content, button) => {
                document.getElementById('details-content').innerHTML = content;
                const parentNode = button.parentNode;
                parentNode.classList.add(activeBgColor, activeTextColor);

                // Remove active classes from other buttons
                document.querySelectorAll('.projectDetails__navButton').forEach(btn => {
                    if (btn !== button) {
                        btn.parentNode.classList.remove(activeBgColor, activeTextColor);
                    }
                });
            };

            console.log(`section before if that should redirect after submit ${section}`);
            let storedSection = localStorage.getItem('section');
            console.log(`here is the stored value: ${storedSection}`);
            if (storedSection === "feedback") {
                console.log(`section in if that should redirect after submit ${section}`);

                fetch('/projects/details/feedback/' + projectId)
                    .then(response => response.text())
                    .then(data => {
                        let subtitle = document.getElementById('subtitle');
                        subtitle.textContent = storedSection;
                        updateContentAndClasses(data, document.getElementById('feedback'));
                    });

            } else {
                console.log(`section in else that should redirect when not submit ${section}`);

                fetch('/projects/details/overview/' + projectId)
                    .then(response => response.text())
                    .then(data => {
                        if (storedSection === null) {
                            let subtitle = document.getElementById('subtitle');
                            subtitle.textContent = "overview";
                            updateContentAndClasses(data, document.getElementById('overview'));
                        } else {
                            let subtitle = document.getElementById('subtitle');
                            subtitle.textContent = storedSection;
                            updateContentAndClasses(data, document.getElementById('overview'));

                        }
                    });
            }
            let projectDetailsNavButtons = document.querySelectorAll('.projectDetails__navButton');
            let subtitle = document.querySelector('.subtitle');

            projectDetailsNavButtons.forEach(button => {
                button.addEventListener('click', function () {
                    section = this.getAttribute('id');
                    let project_id = {{ $project->id }};

                    subtitle.textContent = button.textContent;

                    // Remove active classes from other buttons
                    document.querySelectorAll('.projectDetails__navButton').forEach(btn => {
                        if (btn !== button) {
                            btn.parentNode.classList.remove(activeBgColor, activeTextColor);
                        }
                    });
                    console.log(`section in on click event ${section}`);
                    localStorage.setItem('section', section);

                    // Fetch the new content
                    if (section === "feedback" && status === "Feedback successfully send") {
                        fetch('/projects/details/feedback/' + project_id)
                            .then(response => response.text())
                            .then(data => {
                                updateContentAndClasses(data, button);
                            });
                    } else {
                        fetch('/projects/details/' + section + '/' + project_id)
                            .then(response => response.text())
                            .then(data => {
                                updateContentAndClasses(data, button);
                            });
                    }
                });
            });

        });

    </script>
@endsection
