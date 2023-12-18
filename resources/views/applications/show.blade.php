@extends('components.head')
@section('title', 'Home')

@section('content')
    <div>{{dd($application->user()->get())}}</div>
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

    

