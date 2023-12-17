@extends('components.head')
@section('title', 'Home')
@section('content')
{{-- <script src="{{mix('/js/markdown.js')}}"></script> --}}
{{-- <script src="/js/markdown.js"></script> --}}

<div class="flex flex-col gap-2">
    <div class="w-1/2">
        <h1 class="mb-4 text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-4xl">Step 1: Project Information</h1>
        <p class="mb-4">Describe why your idea will help fulfill an existing need. Make sure and explain where there is room for
            new technologies to experiment with (not seen during your previous study). Tell us the reason why you
            want to pitch your own idea.
        </p>
    </div>
    <div>
        <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
            @csrf
            <fieldset>
                <label for="name" class="block font-semibold">Name your project</label>
                <input type="text" id="name" name="name" class="w-1/2 border border-gray-300 rounded-md px-3 py-2 mt-2 focus:outline-none focus:border-blue-500">
            </fieldset>
            <fieldset>
                <label for="brief" class="block font-semibold">Brief description:</label>
                <textarea id="brief" name="brief" rows="7" class="w-1/2 resize-none border border-gray-300 rounded-md px-3 py-2 mt-2 focus:outline-none focus:border-blue-500"> </textarea>
            </fieldset>
            <fieldset>
                <label for="description" class="block font-semibold">Project Description:</label>
                <p class="mt-0 text-gray-500">Write down a detailed description of your project. Write this using markdown, use the editor to insert headings, links, text format and more.</p>
                <textarea id="description" name="description" rows="10" cols="100" class="w-3/4 border border-gray-300 rounded-md px-3 py-2 mt-2 focus:outline-none focus:border-blue-500"></textarea>
            </fieldset>
            {{-- This part is for Markdown --}}
            <!--
            <div class="flex flex-col space-y-2">
                <label for="editor" class="block font-semibold">Description:</label>
                <div id="editor" class="block w-full rounded-md border border-gray-300 shadow-sm"></div>
            </div>
            <input type="hidden" name="content" id="content">
            -->

            <input type="submit" value="Create Project" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 cursor-pointer w-fit">
        </form>
    </div>

</div>
<script src="{{ asset('resources/js/markdown.js')}}"></script>
{{-- <script src="/js/markdown.js"></script> --}}
@endsection
