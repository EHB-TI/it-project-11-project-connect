<div>
    <nav class="fixed bg-gray-800 text-white flex flex-col h-screen min-w-[250px] w-1/5">
        <!-- Logo -->
        <div class="flex top-0 left-0 items-center justify-center h-16 bg-gray-900">
            <img src="{{ asset('LogoPC.png') }}" alt="Logo" class="w-8 h-8">
        </div>

        <!-- Navigatiemenu van student -->
        <ul class="flex flex-col flex-grow">
            <li class="px-4 py-2 mb-2 hover:bg-gray-700">
                <a href="{{ route('dashboard') }}" class="block">
                </a>
            </li>
            <li class="px-4 py-2 mb-2 hover:bg-gray-700">
                <a href="{{ route('approvedProject') }}" class="block">
                    Projects
                </a>
            </li>

            <!-- HIERONDER IS DE NAV VOOR DOCENTEN, AUTHENTICATIE -->

            <!--auth('')-->
            <li class="px-4 py-2 mb-2 hover:bg-gray-700">
                <a href="#" class="block">
                    Applicaties
                </a>
            </li>
            <li class="px-4 py-2 mb-2 hover:bg-gray-700">
                <a href="{{ route('deadlines.index') }}" class="block">
                    Deadlines
                </a>
            </li>
            <li class="px-4 py-2 mb-2 hover:bg-gray-700">
                <a href="#" class="block">
                    Students
                </a>
            </li>
            <!--endauth-->

            <!-- Navigatiemenu van student -->
            <li class="px-4 py-2 mb-2 hover:bg-gray-700">
                <a href="#" class="block">
                    Make your project
                </a>
            </li>
            <!-- Voeg hier meer menu-items toe -->

        </ul>
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
