@extends('components.head')
@section('title', 'Home')

@section('content')
    <h2 class="subtitle mb-4 text-xl font-bold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl">Applications</h2>
    <h1 class="text-3xl font-bold mb-1">{{$application->project->name}}</h1>
    <div>Written by: {{$application->user->first()->name}}</div>
    <!-- PDF Viewer OF motivation -->
    @if ($application ==! null)
        @if ($application->motivation)
            <div class="mt-8">
                <h3 class="text-lg font-bold">Motivation</h3>

                <div class="bg-gray-200 p-4 rounded-lg mb-4">
                    <div class="container mx-auto">
                        <p class="text-gray-600">{{ $application->motivation }}</p>
                    </div>
                </div>

            </div>
        @endif
        @if ($application->file_path)
            <div class="mt-4">
                <h3 class="text-lg font-bold">PDF Application</h3>
                <iframe src="{{ asset('storage/' . $application->file_path) }}" width="100%" height="600px"></iframe>
            </div>
        @endif
    @else
        <div class="mt-12">
            <h3 class="text-lg font-bold">No Application Uploaded</h3>
            <p>The selected student did not yet upload an application.</p>
        </div>
    @endif
@endsection



