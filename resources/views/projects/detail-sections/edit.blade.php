@extends('components.head')
@section('title', 'Create Project')
@section('content')
<div class="breadcrumbs">
    {!! Breadcrumbs::render('projects_create') !!}
</div>

<h2 class="subtitle mb-4 text-xl font-bold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl">Create project</h2>
<div class="flex flex-col gap-2">
    
    <div class="w-1/2">
        <h1 class="mb-4 text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-4xl">Project Information</h1>
        <p class="mb-4">Describe why your idea will help fulfill an existing need. Make sure and explain where there is room for
            new technologies to experiment with (not seen during your previous study). Tell us the reason why you
            want to pitch your own idea.
        </p>
    </div>
    <div>
        <form id="form_apply_markdown" action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
            @csrf
            <fieldset>
                <label for="name" class="block font-semibold">Name your project</label>
                <input type="text" id="name" name="name" class="w-1/2 border border-gray-300 rounded-md px-3 py-2 mt-2 focus:outline-none focus:border-blue-500">
            </fieldset>
            <fieldset>
                <label for="brief" class="block font-semibold">Brief description:</label>
                <textarea id="brief" name="brief" rows="7" class="w-1/2 resize-none border border-gray-300 rounded-md px-3 py-2 mt-2 focus:outline-none focus:border-blue-500"> </textarea>
            </fieldset>
            <div class="flex flex-col space-y-2">
                <input type="hidden" id="content" name="description" class="hidden">
                <label for="editor" class="text-gray-600 font-semibold">Write a detailed description down below</label>
                <div id="editor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
            </div>

            <input type="submit" value="Create Project" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 cursor-pointer w-fit">
        </form>
    </div>
</div>
@endsection