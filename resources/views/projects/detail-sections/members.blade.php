@if($projectMembers->isEmpty())
    <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
        <p class="font-bold">No Members</p>
        <p>There are no members yet for this project.</p>
    </div>
@else
    <div class="member-card-container grid grid-cols-2 gap-4">
        @foreach($projectMembers as $member)
            <div class="member-card p-4 flex justify-between items-center border-2 rounded-xl">
                <div class="flex gap-4 items-center">
                    <div class="member-card__avatar w-10 h-10 rounded-full bg-indigo-950"></div>
                    <div class="member-card__name h-fit ">{{ $member->name }}</div>
                </div>
                <div class="member-card__since text-sm text-gray-500 justify-self-end text-right">
                    <div>Member Since</div>
                    <div>{{ $member->created_at->format('m/d/Y') }}</div>
                </div>
            </div>
        @endforeach
    </div>
@endif
