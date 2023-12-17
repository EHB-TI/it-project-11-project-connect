@extends('components.head')
@section('title', 'Home')
@section('content')
{{-- <script src="{{mix('/js/markdown.js')}}"></script> --}}
{{-- <script src="/js/markdown.js"></script> --}}

<div class="flex gap-8">
    <div class="w-1/4">
        <h1 class="mb-4 text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-4xl">Step 1: Project Information</h1>
        <p class="mb-4">Describe why your idea will help fulfill an existing need. Make sure and explain where there is room for
            new technologies to experiment with (not seen during your previous study). Tell us the reason why you
            want to pitch your own idea.
        </p>
    </div>
        <br><br><br>
        <div id="postModal" title="Create Project" class="p-5">
            <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" id="post-form"
                data-route="{{ route('projects.store') }}" class="space-y-4">
        
                @csrf
        
                <label for="Title" class="block font-semibold">Project Title:</label>
                <input type="text" id="Title" name="Title" class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:border-blue-500">
        
                <label for="description" class="block font-semibold">Project Description:</label>
                <textarea id="description" name="description" rows="4" cols="50" class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:border-blue-500"></textarea>
        
                {{-- This part is for Markdown --}}
                <!--
                <div class="flex flex-col space-y-2">
                    <label for="editor" class="block font-semibold">Description:</label>
                    <div id="editor" class="block w-full rounded-md border border-gray-300 shadow-sm"></div>
                </div>
                <input type="hidden" name="content" id="content">
                -->
        
                <input type="number" name="user" id="user_id" style="display: none;" value="{{Auth::id()}}">
        
                <input type="submit" value="Create Project" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 cursor-pointer">
            </form>
        </div>
        
    

</div>
<script src="{{ asset('resources/js/markdown.js')}}"></script>
{{-- <script src="/js/markdown.js"></script> --}}


{{-- @extends('components.footer')
@section('title', 'Home') --}}
@endsection
