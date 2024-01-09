@extends('components.head')
@section('title', 'Home')

@section('content')
    <form action="{{ route('spaces.store') }}" method="POST" class="max-w-md mx-auto mt-10 p-6 bg-white rounded-md shadow-md">
        @csrf
        <h1 class="text-2xl font-bold mb-4">Create Space</h1>

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Space title:</label>
            <input type="text" id="name" name="name" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div class="mb-4">
            <label for="canvasCourseId" class="block text-sm font-medium text-gray-700">Course:</label>
            <select id="canvasCourseId" name="canvasCourseId" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                <option value="1">IT Project</option>
                <option value="2">Java Advanced</option>
                <option value="3">Integration</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="defaultTeamSize" class="block text-sm font-medium text-gray-700">Default team members:</label>
            <input class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                type="number" name="defaultTeamSize">
        </div>

        <div>
            <button type="submit" class="w-full bg-gray-700 text-white px-4 py-2 rounded-md">Create Space</button>
        </div>
    </form>
@endsection
