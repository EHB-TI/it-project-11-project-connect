@extends('components.head')
@section('title', 'Create Deadline')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="font-bold text-2xl mb-4">Create Deadline</h1>

        <form action="{{ route('deadlines.store') }}" method="POST" class="grid grid-cols-2 gap-4">
            @csrf
            <div class="col-span-2 border p-4 rounded">
                <div class="mb-4">
                    <label for="title" class="block text-sm font-semibold mb-1">Title</label>
                    <input id="title" name="title" class="w-full p-2 bg-gray-200">
                </div>

                <div class="mb-4">
                    <label for="what" class="block text-sm font-semibold mb-1">What?</label>
                    <select id="what" name="what" class="w-full p-2 bg-gray-200">
                        <option>Create Project</option>
                        <option>Apply For Projects</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="when_date" class="block text-sm font-semibold mb-1">Date</label>
                    <input type="date" id="when_date" name="when_date" value="{{ now()->toDateString() }}"  min="{{ now()->toDateString() }}" max="{{ now()->endOfYear()->toDateString() }}" class="w-full p-2 bg-gray-200">
                </div>

                <div>
                    <label for="when_time" class="block text-sm font-semibold mb-1">Time</label>
                    <input type="time" id="when_time" name="when_time" class="w-full p-2 bg-gray-200">
                </div>
            </div>
            <hr class="my-4">

            <div class="flex justify-end">
                <button type="submit" class="border py-2 px-4 rounded hover:bg-gray-200">Create Deadline</button>
            </div>
        </form>
    </div>
@endsection
