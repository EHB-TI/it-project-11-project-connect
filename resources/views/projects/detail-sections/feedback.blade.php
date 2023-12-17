<div class="feedback-card rounded-xl border-2 my-8">
    <div class="feedback-card__header flex justify-between border-b-2 p-4">
        <div class="user-info flex items-center gap-2">
            <div class="user-info__avatar w-10 h-10 rounded-full bg-indigo-950"></div>
            <div class="user-info__name h-fit">Ruben dejonckheere</div>
        </div>
        <div class="date-info flex gap-2 items-center">
            <div class="date-info__date h-fit">14/12/2021</div>
            <div class="date-info__time h-fit">12:12</div>
        </div>
    </div>
    <div class="feedback-card__body p-4">
        lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.
        lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.
        lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.
        lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.
    </div>
</div>
<div class="feedback-card rounded-xl border-2 my-8">
    <div class="feedback-card__header flex justify-between border-b-2 p-4">
        <div class="user-info flex items-center gap-2">
            <div class="user-info__avatar w-10 h-10 rounded-full bg-indigo-950"></div>
            <div class="user-info__name h-fit">Ruben dejonckheere</div>
        </div>
        <div class="date-info flex gap-2 items-center">
            <div class="date-info__date h-fit">11/12/2021</div>
            <div class="date-info__time h-fit">16:43</div>
        </div>
    </div>
    <div class="feedback-card__body p-4">
        lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.
        lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.
        lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.
        lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.
        lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.
        lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.
        lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.
        lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.
    </div>
</div>
<div class="feedback-card rounded-xl border-2 my-8">
    <div class="feedback-card__header flex justify-between border-b-2 p-4">
        <div class="user-info flex items-center gap-2">
            <div class="user-info__avatar w-10 h-10 rounded-full bg-indigo-950"></div>
            <div class="user-info__name h-fit">Ruben dejonckheere</div>
        </div>
        <div class="date-info flex gap-2 items-center">
            <div class="date-info__date h-fit">8/12/2021</div>
            <div class="date-info__time h-fit">8:51</div>
        </div>
    </div>
    <div class="feedback-card__body p-4">
        lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.
        lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.
        lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.
        lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.
        lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.
        lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.
    </div>
</div>

@if(Auth::user()->role == 'teacher')
    <form action="/feedback" method="POST">
        @csrf
        <div class="feedback-card rounded-xl border-2 my-8">

            <div class="feedback-card__body p-4">
                <label for="message" class="text-2xl">Write new feedback</label>
                <textarea name="message" id="message" cols="30" rows="10" class="w-full p-2 px-4 mt-4 border-2 rounded-xl"></textarea>
            </div>
            <div class="feedback-card__footer flex justify-end border-t-2 p-4">
                <button type="submit" class="px-4 py-2 bg-indigo-950 text-white rounded-xl">Submit feedback</button>
            </div>
        </div>

    </form>
@endif
