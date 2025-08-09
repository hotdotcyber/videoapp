<div x-data="{ mobileMenuOpen: false }">
    <nav class="bg-white border-b border-gray-200 px-4 py-3 shadow-sm">
        <div class="flex items-center justify-between">
            <!-- Left: Logo + Title -->
            <div class="flex items-center space-x-3">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-gray-600 text-2xl focus:outline-none">
                    <i class="ri-menu-line"></i>
                </button>
                <a wire:navigate href="{{ route('dashboard') }}" class="text-xl font-bold text-blue-600 flex items-center space-x-1">
                    <i class="ri-dashboard-2-line text-2xl"></i>
                    <span class="hidden sm:inline">Dashboard</span>
                </a>
            </div>

            <!-- Center: Action buttons -->
            <div class="hidden md:flex items-center space-x-4">
                <!-- Upload Video Wrapped -->
                <div class="relative group">
                    <a href="{{ route('video.create', Auth::user()->channel->slug) }}"
                       title="Upload Video"
                       class="text-yellow-600 text-xl hover:text-yellow-700 transition">
                        <i class="ri-upload-cloud-line"></i>
                    </a>
                    <div class="absolute left-1/2 -translate-x-1/2 mt-1 text-xs text-white bg-black px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">
                        Upload Video
                    </div>
                </div>

                <a wire:navigate href="{{route('home')}}"
                   class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition">
                    <i class="ri-compass-3-line mr-1"></i> Explore Channels
                </a>

                <a wire:navigate href="{{ route('video.all') }}"
                   class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                    <i class="ri-video-line mr-1"></i> My Videos
                </a>
            </div>

            <!-- Right: User Dropdown (Scoped independently) -->
            <div class="relative" x-data="{ userMenuOpen: false }">
                <button @click="userMenuOpen = !userMenuOpen"
                        class="flex items-center space-x-2 focus:outline-none">
                    <i class="ri-user-3-line text-gray-700 text-lg"></i>
                    <span class="hidden sm:inline text-sm text-gray-800 font-medium">{{ Auth::user()->name }}</span>
                    <i class="ri-arrow-down-s-line text-sm text-gray-500"></i>
                </button>

                <!-- Dropdown -->
                <div x-show="userMenuOpen" @click.outside="userMenuOpen = false" x-transition
                     class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-md z-50">
                    <a wire:navigate href="{{ route('dashboard') }}"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                    <a wire:navigate href="{{ route('edit.channel', Auth::user()->channel->slug) }}"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Channel Settings</a>
                    <a wire:navigate href="#"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile Settings</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-transition class="md:hidden mt-4 space-y-2">
            <a wire:navigate href="{{ route('video.create', Auth::user()->channel->slug) }}"
               class="flex items-center text-yellow-600 px-4 py-2 hover:bg-yellow-50 rounded transition">
                <i class="ri-upload-cloud-line mr-2 text-xl"></i> Upload Video
            </a>

            <a wire:navigate "href={{route('home')}}"
               class="flex items-center text-green-600 px-4 py-2 hover:bg-green-50 rounded transition">
                <i class="ri-compass-3-line mr-2 text-xl"></i> Explore Channels
            </a>

            <a wire:navigate href="{{ route('video.all') }}"
               class="flex items-center text-blue-600 px-4 py-2 hover:bg-blue-50 rounded transition">
                <i class="ri-video-line mr-2 text-xl"></i> My Videos
            </a>
        </div>
    </nav>
</div>
