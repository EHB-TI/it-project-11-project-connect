<div class="application-box rounded-xl border-2 overflow-hidden mb-8 p-4">
    <h1 class="mb-4 text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-4xl">{{ $title }}</h1>
    <p class="mb-1">{{ $message }}</p>
    @if($route)
        <a href="{{ route($route, $projectId) }}" class="project-detail__applyButton rounded-full px-4 py-2 border-2">{{ $buttonText }}</a>
    @elseif($status)
        <div class="bg-gray-300 rounded-lg w-fit py-1 px-2">
            {{ $status }}
        </div>
    @endif
</div>
