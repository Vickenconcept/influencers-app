<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0  "
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white ">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('home') }}" class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100 group">
                    <svg class="w-5 h-5 text-gray-500 transition duration-75  group-hover:text-gray-900 "
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>
            {{-- <li>
            <a href="{{ route('plaform.search', 'plaform') }}"
                class="flex items-center px-2 py-1  transition duration-75 rounded-lg  group hover:bg-orange-500 hover:bg-opacity-25 ">
                <i
                    class='bx bx-image text-xl mr-2 '></i>
                <span class="text-sm ">Social Media Share</span>
            </a>
        </li> --}}

            @php
                $platforms = \App\Models\Platform::all();
            @endphp
            @foreach ($platforms as $platform)
                <li>
                    <a href="{{ route('platform.search', ['platform' => strtolower($platform->name)]) }}"
                        class="flex items-center px-2 py-1 transition duration-75 rounded-lg group hover:bg-orange-500 hover:bg-opacity-25">
                        <i class='bx bx-image text-xl mr-2'></i>
                        <span class="text-sm">{{ ucfirst($platform->name) }}</span>
                    </a>
                </li>
            @endforeach

            <li>
                <a href="{{ route('groups.index') }}"
                    class="flex items-center px-2 py-1 transition duration-75 rounded-lg group hover:bg-orange-500 hover:bg-opacity-25">
                    <i class='bx bx-image text-xl mr-2'></i>
                    <span class="text-sm">Groups</span>
                </a>
            </li>
            <li>
                <a href="{{ route('campaigns.index') }}"
                    class="flex items-center px-2 py-1 transition duration-75 rounded-lg group hover:bg-orange-500 hover:bg-opacity-25">
                    <i class='bx bx-image text-xl mr-2'></i>
                    <span class="text-sm">campaign</span>
                </a>
            </li>
            <li>
                <a href="{{ route('campaigns.response') }}"
                    class="flex items-center px-2 py-1 transition duration-75 rounded-lg group hover:bg-orange-500 hover:bg-opacity-25">
                    <i class='bx bx-image text-xl mr-2'></i>
                    <span class="text-sm">Responses</span>
                </a>
            </li>
            <li>
                <a href="{{ route('reseller.index') }}"
                    class="flex items-center px-2 py-1 transition duration-75 rounded-lg group hover:bg-orange-500 hover:bg-opacity-25">
                    <i class='bx bx-image text-xl mr-2'></i>
                    <span class="text-sm">Reseller</span>
                </a>
            </li>
            <li>
                <a href="{{ route('auth.logout') }}"
                    class="flex items-center px-2 py-1 transition duration-75 rounded-lg group hover:bg-orange-500 hover:bg-opacity-25">
                    <i class='bx bx-exit text-xl mr-2'></i>
                    <span class="text-sm capitalize">Log out</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
