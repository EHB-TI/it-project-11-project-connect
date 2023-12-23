<div>
    <nav class="fixed bg-gray-800 text-white flex flex-col h-screen min-w-[250px] w-1/5">
        <!-- Logo -->
        <div class="flex top-0 left-0 items-center justify-center h-16 bg-gray-900">
            <img src="{{ asset('LogoPC.png') }}" alt="Logo" class="w-8 h-8">
        </div>

        @unless (Route::currentRouteName() === 'spaces.index' ||
                Route::currentRouteName() === 'spaces.create' ||
                Route::currentRouteNamed('welcome'))
            <ul class="flex flex-col flex-grow">
                @Auth
                    @php
                        $navItems = [];
                        if (Auth::user()->role == 'teacher') {
                            $navItems = \App\Constants\NavItems::TEACHER;
                        } elseif (Auth::user()->role == 'student') {
                            $navItems = \App\Constants\NavItems::STUDENT;
                        }
                    @endphp
                    @foreach ($navItems as $name => $route)
                        <li class="px-4 py-2 mb-2 hover:bg-gray-700">
                            <a href="{{ route($route) }}" class="block">
                                {{ $name }}
                            </a>
                        </li>
                    @endforeach
                @endauth
            </ul>
        @endunless
        <div class="bg-gray-900 p-4">
            @Auth
            <div class="flex items-center ">
                <div class="user-image w-10 h-10 rounded-full bg-white"></div>
                <span class="ml-2">{{ Auth::user()->name }}</span>
            </div>

                <div>
                    <a href="{{ route('logout') }}" class="block mt-2 hover:underline">Logout</a>
                </div>
            @endauth
            @guest
                <div>
                    <a href="{{ route('login') }}" class="block mt-2 hover:underline">Login</a>
                </div>
            @endguest
        </div>

    </nav>
</div>
