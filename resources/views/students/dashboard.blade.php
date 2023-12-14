{{-- @extends('components.head')
@section('title', 'Home') --}}


<div class="app-container">
    @include('components.nav-bar')
    <div class="app-content ml-[max(250px,_20%)] p-5">
        <H1>My Projects </H1>
        @if (isEmpty($projects))
            <hr>
            <p>You have not yet submitted any proposals. <br>
                Click here to submit a proposal.</p>
            <br>
            <br>
        @else

            @foreach ($projects as $project)
                
                <div>
                <img src="{{$project->filepath}}" alt="project image">
                <p>{{$project->name}}</p>
                <p>Created By: {{ $project->owner->name }}</p>
                <p>Status:{{$project->status}}</p>
            </div>
            @endforeach
            <br>
            <br>
        @endif
        
        {{-- here gewoon the var veranderen voor applications --}}
        <H1>My applications </H1>
        @if (isEmpty($projects))
        <hr>
        <p>You have not yet submitted any proposals. <br>
            Click here to submit a proposal.</p>
        <br>
    @else

        @foreach ($projects as $project)
            
            <div>
                <img src="{{$project->filepath}}" alt="project image">
                <p>{{$project->name}}</p>
                <p>Created By: {{ $project->owner->name }}</p>
                <p>Status:{{$project->status}}</p>
            </div>
        @endforeach
        <br>
        <br>
    @endif
       
    </div>

</div>



{{-- @extends('components.footer')
@section('title', 'Home') --}}

