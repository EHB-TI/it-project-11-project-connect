@extends('components.head')
@section('title', 'Home')

@section('content')
    @php
        use App\Http\Middleware\StoreRoute;
        $previousRoute = StoreRoute::getPreviousRouteName();
        if($previousRoute === 'projects.index'){
            $previousRoute = 'applications.show2';
        }
        else{
            $previousRoute = StoreRoute::getCurrentRouteName();
        }

    @endphp
    {{-- @include('components.breadcrumb', ['breadcrumbName' => StoreRoute::getCurrentRouteName(), 'id' => $application->id]) --}}
    @include('components.breadcrumb', ['breadcrumbName' => $previousRoute, 'id' => $application->id])

    <div class="flex gap-8">
        <div class="w-3/4">

            <h2 class="subtitle mb-4 text-xl font-bold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl">
                Applications</h2>
            <h1 class="text-3xl font-bold mb-1">{{$application->project->name}}</h1>

            <div>Written by: {{$application->user->name}}</div>
            <!-- PDF Viewer OF motivation -->
            @if ($application ==! null)
                @if ($application->motivation)
                    <div class="mt-8">
                        <div class="mt-6">
                            <h2 class="text-2xl font-semibold mb-2">Motivation</h2>

                            <div class="bg-gray-200 p-4 rounded-lg mb-4">
                                <div class="container markdown-content">
                                    @php
                                        $parsedown = new Parsedown();
                                        $parseString = $application->motivation;
                                        echo $parsedown->text($parseString)
                                    @endphp
                                </div>
                            </div>
                        </div>


                    </div>
                @endif
                @if ($application->file_path)
                    <div class="mt-4">
                        <h3 class="text-lg font-bold">PDF Application</h3>
                        <iframe src="{{ Storage::url($application->file_path) }}" width="100%" height="600px"></iframe>
                    </div>
                @endif
            @else
                <div class="mt-12">
                    <h3 class="text-lg font-bold">No Application Uploaded</h3>
                    <p>The selected student did not yet upload an application.</p>
                </div>
            @endif
        </div>
        <div class="w-1/4">


            @if(Auth::user()->id == $application->project->owner->id && $application->status == 'pending')
                <div class="rounded-xl border-2 overflow-hidden mb-8 p-4 flex flex-col">
                    <h1 class="mb-4 text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-4xl">
                        Application Status
                    </h1>
                    <p class="mb-1">Approve or reject this application</p>

                    <div class="flex space-x-4">
                        <form action="{{ route('applications.approve', ['id' => $application->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="block w-fit rounded-full px-4 py-2 border-2">Approve</button>
                        </form>
                        <form action="{{ route('applications.reject', ['id' => $application->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="block w-fit rounded-full px-4 py-2 border-2">Reject</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
