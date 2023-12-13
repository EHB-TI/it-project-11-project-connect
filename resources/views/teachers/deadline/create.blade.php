@extends('components.head')
@section('title', 'Deadlines')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="font-bold text-2xl mb-4">Create Deadline</h1>

        <form class="grid grid-cols-2 gap-4">
            <div class="col-span-2 border p-4 rounded">
                <div class="mb-4">
                    <label for="title" class="block text-sm font-semibold mb-1">Title</label>
                    <input id="title" class="w-full p-2 bg-gray-200">
                </div>

                <div class="mb-4">
                    <label for="who" class="block text-sm font-semibold mb-1">Who?</label>
                    <select id="who" class="w-full p-2 bg-gray-200"></select>
                </div>

                <div class="mb-4">
                    <label for="what" class="block text-sm font-semibold mb-1">What?</label>
                    <select id="what" class="w-full p-2 bg-gray-200"></select>
                </div>

                <div class="mb-4">
                    <label for="when_date" class="block text-sm font-semibold mb-1">Date</label>
                    <input type="date" id="when_date" class="w-full p-2 bg-gray-200">
                </div>

                <div>
                    <label for="when_time" class="block text-sm font-semibold mb-1">Time</label>
                    <input type="time" id="when_time" class="w-full p-2 bg-gray-200">
                </div>
            </div>
        </form>

        <hr class="my-4">

        <div class="flex justify-end">
            <button class="border py-2 px-4 rounded hover:bg-gray-200">Create Deadline</button>
        </div>
    </div>
@endsection
