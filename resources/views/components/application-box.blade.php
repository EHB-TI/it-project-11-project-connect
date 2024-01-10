<div class="application-box rounded-xl border-2 overflow-hidden mb-8 p-4">
    <h1 class="mb-4 text-2xl font-extrabold leading-none tracking-tight text-gray-900 lg:text-3xl">{{ $title }}</h1>
    <p class="">{{ $message }}</p>
    @if($status)
        <div class="bg-gray-300 rounded-lg w-fit py-1 px-2 mt-2">
            {{ $status }}
        </div>
    @endif
    @if($route)
        <a href="{{ route($route, $projectId) }}" class="project-detail__applyButton mt-2 block w-fit rounded-full px-4 py-2 border-2">{{ $buttonText }}</a>
    @endif


</div>
