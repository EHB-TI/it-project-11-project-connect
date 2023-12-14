{{-- @extends('components.head')
@section('title', 'Home') --}}
{{-- <script src="{{mix('/js/markdown.js')}}"></script> --}}
{{-- <script src="/js/markdown.js"></script> --}}

<div class="app-container">
    @include('components.nav-bar')
    <div class="app-content ml-[max(250px,_20%)] p-5">
        <H1>Step 1: Project Information</H1>
        <p>Describe why your idea will help fulfill an existing need. Make sure and explain where there is room for
            new technologies to experiment with (not seen during your previous study). Tell us the reason why you
            want to pitch your own idea.
        </p>
        
        <div id="postModal" title="Create Project">
            <form action="{{ route('storeProjects') }}" method="POST" enctype="multipart/form-data" id="post-form"
                data-route="{{ route('storeProjects') }}">
                @csrf
                <label for="Title">Project Title:</label><br>
                <input type="text" id="Title" name="Title"><br><br>

                <div class="flex flex-col space-y-2">
                    <label for="editor" class="text-gray-600 font-semibold">Description:</label>
                    <div id="editor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"><div>
                </div>
                <input type="hidden" name="content" id="content">
                <input type="number" name="user" id="user_id" style="display: none;" value="{{Auth::id()}}">
                <input type="submit" value="Create Project">
            </form>
        </div>
    </div>

</div>
<script src="{{ asset('resources/js/markdown.js')}}"></script>
{{-- <script src="/js/markdown.js"></script> --}}


{{-- @extends('components.footer')
@section('title', 'Home') --}}

