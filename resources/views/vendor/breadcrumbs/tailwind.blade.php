@unless ($breadcrumbs->isEmpty())
    <nav class="w-full mb-8">
        <ol class="p-4  w-full flex flex-wrap border-b-2 text-sm text-gray-800 justify-between">
            <div class="flex">
            @foreach ($breadcrumbs as $breadcrumb)

                @if ($breadcrumb->url && !$loop->last)
                    <li>
                        <a href="{{ $breadcrumb->url }}" class="text-blue-600 hover:text-blue-900 hover:underline focus:text-blue-900 focus:underline">
                            {{ $breadcrumb->title }}
                        </a>
                    </li>
                @else
                    <li>
                        {{ $breadcrumb->title }}
                    </li>
                @endif

                @unless($loop->last)
                    <li class="text-gray-500 px-2">
                        /
                    </li>
                @endif

            @endforeach
                </div>
            <div>
                <x-notification-bell :notifications="$notifications" />
            </div>
        </ol>
        
    </nav>
@endunless
