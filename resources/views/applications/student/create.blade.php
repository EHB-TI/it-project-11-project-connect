@extends('components.head')
@section('title', 'Home')

@section('content')

    <div class="flex gap-8">
        <div class="w-3/4">
            <form id="form_apply_markdown" method="post" action="{{ route('applications.store', $project->id) }}" enctype="multipart/form-data">
                @csrf
                <legend class="text-3xl font-bold mb-1">Application Form</legend>
                <legend class="text3 font-bold mb-4">{{$project->name}}</legend>
                <p>Welcome to the developer application form. If you're passionate about contributing to innovative projects, please fill out this form to apply. We're excited to learn more about your skills and why you're intrested in joining our project.</p>

                <fieldset class="my-4">
                    <legend class="text-2xl font-bold">Motivation letter</legend>
                    <p>Provide any additional details or upload supporting documents.</p>
                    <div class="mt-4">
                        <label for="file" class="block text-sm font-medium text-gray$-700">Upload File:</label>
                        <input type="file" id="file" name="file" class="mt-1 py-2 px-4 border rounded-full border-gray-300">
                    </div>
                    <h2 class="font-bold my-2">OR</h2>
                    <div class="flex flex-col space-y-2">
                        <input type="hidden" id="content" name="motivation" class="hidden">
                        <label for="editor" class="text-gray-600 font-semibold">Write your motivation down below</label>
                        <div id="editor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
                    </div>
                </fieldset>
                <input id="form_apply_markdown" type="submit" value="Submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 cursor-pointer w-fit">
            </form>
        </div>
        <div class="w-1/4">

        </div>
    </div>
@endsection
