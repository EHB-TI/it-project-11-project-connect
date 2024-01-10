<div x-data="{ open: false }">
    <nav id="navbar" class="fixed bg-gray-800 text-white flex flex-col h-screen min-w-[250px] w-1/5 hidden md:flex">
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


            <div class="bg-gray-900 p-4 flex flex-col">
                @php
                    $currentSpace = session('current_space_id') ? \App\Models\Space::find(session('current_space_id')) : null;
                    $userSpaces = Auth::user()->spaces;
                @endphp

                <!-- Dropdown menu for spaces -->
                <div class="relative inline-block text-left mb-10">
                    <button type="button" onclick="toggleDropdown()"
                            class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
                            id="options-menu" aria-haspopup="true" aria-expanded="true">
                        {{ $currentSpace ? $currentSpace->name : 'Select a space' }}
                        <!-- Heroicon name: chevron-down -->
                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </button>
                    <div id="dropdown-menu"
                         class="origin-bottom-left top-[-20px] transform translate-y-[-100%] absolute right-0 mt-2 w-[max(200px,_100%)]  rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden">
                        <div class="py-1 flex flex-col-reverse">
                            @foreach ($userSpaces->reverse() as $space)
                                <form action="{{ route('spaces.select') }}" method="POST">
                                    @csrf
                                    <input name="space_id" value="{{ $space->id }}" class="hidden"/>
                                    <button type="submit"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                            role="menuitem">{{ $space->name }}</button>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endunless
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

    <button onclick="toggleNavbar()" class="md:hidden fixed top-0 right-0 m-4 mr-10 p-2 bg-gray-800 text-white rounded">
        <svg id="hamburger-icon" class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
        <svg id="close-icon" class="h-6 w-6 fill-current hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>
