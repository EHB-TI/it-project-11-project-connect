@extends('components.head')
@section('title', 'Home')
@section('content')
    <form action="{{ route('user.store') }}" method="post" class="max-w-xl mx-auto mt-10">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name:</label>
            <input type="text" id="name" name="name" required class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm">
        </div>

        <div class="mb-4">
            <label for="role" class="block text-gray-700">Role:</label>
            <select id="role" name="role" required class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm">
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="available" class="block text-gray-700">Available:</label>
            <input type="checkbox" id="available" name="available" checked class="mt-1 p-2 block rounded-md border-gray-300 shadow-sm">
        </div>

        <div class="mb-4">
            <label for="access_card_id" class="block text-gray-700">Access Card ID:</label>
            <input type="text" id="access_card_id" name="access_card_id" maxlength="9" value="123456789" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm">
        </div>

        <input type="submit" value="Submit" class="mt-6 block w-full rounded-md border border-transparent px-5 py-3 bg-blue-600 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
    </form>
@endsection
