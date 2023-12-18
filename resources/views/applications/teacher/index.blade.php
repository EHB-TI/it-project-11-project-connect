@extends('components.head')
@section('title', 'Incoming Applications')

@section('content')
    @if ($applications->isEmpty())
        <h1>There are no applications yet.</h1>
    @else
        <h2 class="subtitle mb-4 text-xl font-bold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl">Applications</h2>
        <table class="table-auto w-full text-left">
            <thead>
                <tr>
                    <th class="p-2 min-w-1/3">Name</th>
                    <th class="p-2">project</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($applications as $application)
                    <tr class="border-b-2 transition duration-200 hover:bg-gray-100 cursor-pointer">
                        <td class="p-2">{{ $application->user->name }}</td>
                        <td class="p-2">
                            <a href="{{ route('projects.show', $application->project->id) }}" class="text-blue-500 hover:text-blue-700 hover:underline">
                                {{ $application->project->name }}
                            </a>
                        </td>
                        <td class="p-2">
                            <div class="bg-gray-300 rounded-lg w-fit py-1 px-2">
                                {{ $application->status }}
                            </div>
                        </td>
                        <td class="p-2">{{ $application->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
