@extends('')

@section('')

<H1>Step 1: Project Information</H1>
<p>Describe why your idea will help fulfill an existing need. Make sure and explain where there is room for
   new technologies to experiment with (not seen during your previous study). Tell us the reason why you  
   want to pitch your own idea.
</p>


<button id="preview">Preview</button> 


<div id="postModal" title="Create Post">

    <form action="{{ route('') }}" method="POST" enctype="multipart/form-data" id="post-form"
        data-route="{{ route('') }}">
        @csrf
        <label for="Title">Project Title:</label><br>
        <input type="text" id="Title" name="Title"><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50"></textarea><br><br>

        <label for="meia">Upload an image:</label><br>
        <input type="file" id="media" name="media"><br><br>
        <input type="number" name="user" id="user_id" style="display: none;" value="{{Auth::id()}}">

        <input type="submit" value="Create Project">
    </form>
</div>
<
@endsection

