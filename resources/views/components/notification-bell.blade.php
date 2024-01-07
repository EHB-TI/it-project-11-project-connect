<div class="relative">
    <button type="button" id="NotificationButton" onclick="toggleNotifications()" class="flex items-center focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="mr-2">
            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 0 0-1.99 0l.035.3a5.002 5.002 0 0 0-4.465 4.696L3 7l-.072.329a1.99 1.99 0 0 0-1.684 1.99l.072.701v.004l.008.056a2 2 0 0 0 1.98 1.68h.7a3.99 3.99 0 0 0 7.924 0h.7a2 2 0 0 0 1.98-1.68l.008-.056v-.004l.072-.701a1.99 1.99 0 0 0-1.684-1.99L13 7l.035-.304a5.002 5.002 0 0 0-4.464-4.696l.035-.3z"/>
        </svg>
        <p>{{ Auth::user()->unseenCount() }}</p>
    </button>
    <div class="absolute w-96 right-0 mt-2 bg-white border rounded shadow-lg py-2 z-50 hidden flex flex-col" id="notifications">
        @foreach($notifications as $notification)
        <form method="POST" action="{{ route('space.change') }}">
            @csrf
            <input type="hidden" name="space_id" value="{{ $notification->space_id }}">
            <input type="hidden" name="route" value="{{ $notification->route }}">
            <input type="hidden" name="notification_id" value="{{ $notification->id }}">
            <button type="submit" class="{{ $notification->seen(Auth::id()) ? '' : 'font-bold' }} block w-full text-left px-4 py-2 border-b last:border-0 hover:bg-gray-100 transition-colors duration-200">
                {{ $notification->content }}
            </button>
        </form>
    @endforeach
    </div>
    <script>
        function toggleNotifications() {
            const notifications = document.getElementById('notifications');
            notifications.classList.toggle('hidden');
        }
    </script>
</div>
