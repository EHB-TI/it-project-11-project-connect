@foreach($projectDiscussions as $discussion)
    <div class="feedback-card rounded-xl border-2 my-8">
        <div class="feedback-card__header flex justify-between border-b-2 p-4">
            <div class="user-info flex items-center gap-2">
                <div class="user-info__avatar w-10 h-10 rounded-full bg-indigo-950"></div>
                <div class="user-info__name h-fit">{{ $discussion->user->name }}</div>
            </div>
            <div class="date-info flex gap-2 items-center">
                <div class="date-info__date h-fit">{{ $discussion->created_at->format('d/m/Y') }}</div>
                <div class="date-info__time h-fit">{{ $discussion->created_at->format('H:i') }}</div>
            </div>
        </div>
        <p class="feedback-card__body p-4 break-words">
            {{ $discussion->message }}
        </p>
    </div>
@endforeach

@if($projectDiscussions->isEmpty())
    <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
        <p class="font-bold">No discussion</p>
        <p>There is no discussion yet. @if(Auth::user()->role == 'teacher') Be the first to give feedback!@endif</p>
    </div>
@endif

@if(Auth::user()->role == 'teacher')
    <form id="discussionForm" action="{{ route('discussions.store', $project->id ) }}" method="POST">
        @csrf
        <div class="feedback-card rounded-xl border-2 my-8">
            <div class="feedback-card__body p-4">
                <label for="message" class="text-2xl">Write a discussion</label>
                <textarea name="message" id="message" cols="30" rows="10" class="w-full p-2 px-4 mt-4 border-2 rounded-xl"></textarea>
            </div>
            <div class="feedback-card__footer flex justify-end border-t-2 p-4">
                <button id="btn" type="submit" class="px-4 py-2 bg-indigo-950 text-white rounded-xl">Submit message</button>
            </div>
        </div>
        <p class="text-red-500">NOTE: Your comment is ONLY visible for fellow teachers!</p>
    </form>
@endif

<script>
    document.getElementById('discussionForm').addEventListener('submit', function(event) {
        event.preventDefault(); 
    });
</script>

