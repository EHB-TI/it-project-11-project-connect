@extends('components.head')
@section('title', 'Home')

@section('content')
    <!-- Overzicht student -->
    <div class="container mx-auto">
        <h2 class="subtitle mb-4 text-xl font-bold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl">Student
            Information</h2>
    </div>
    <div class="bg-gray-200 p-4 rounded-lg mb-4 max-w-md">
        <h3 class="text-lg font-bold"> Naam: {{ $user->name }}</h3>
        <p class="text-gray-600">Rol: {{ $user->role }}</p>
    </div>

    <!-- Overzicht applicatie verzonden naar projecten -->
    <table class="table-auto w-full text-left">
        <thead>
            <tr>
                <th class="p-2 min-w-1/3">Application sent to </th>
                <th class="p-2">Date</th>
                <th class="p-1">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user->applications as $application)
                <tr class="border-b-2 transition duration-200 hover:bg-gray-100 cursor-pointer">
                    <td class="p-2">{{ $application->project->name }}</td>
                    <td class="p-2">{{ $application->created_at }}</td>
                    <td
                        class="rounded-lg w-fit py-1 text-center
                {{ $application->status == 'denied' ? 'bg-red-300 text-red-800 ' : ($application->status == 'approved' ? 'bg-green-200 text-green-800' : 'bg-gray-200 text-gray-800') }} px-1">
                        {{ $application->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Button om terug te gaan naar index.blade.php -->
    <div class="mt-10">
        <a href="{{ route('students.index') }}" class="bg-gray-500 hover:bg-gray-400 d-700 text-white font-bold py-2 px-4 rounded mt-4">
            Back
        </a>
    </div>

    
@endsection
   
    


