@extends('components.head')
@section('title', 'Application - ' . $application->user->name)

@section('content')

<div class="breadcrumbs">
    {!! Breadcrumbs::render('applications', $application->id) !!}
</div>
<div class="flex justify-between items-start mt-8">
    <div>
        <h1 class="text-3xl font-extrabold mt-4">{{$application->user->name}}</h1>
        <h2 class="text-xl font-semibold mt-2">Project: {{$application->project->name}}</h2>

        <div class="mt-6">
            <h2 class="text-2xl font-semibold mb-2">Motivation</h2>
            <a href=""
               class="inline-block border border-black rounded-xl py-2 px-4 mb-4">
                Download File
            </a>
            <p class="text-gray-700">{{$application->motivation}}</p>
        </div>
    </div>

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

@endsection
