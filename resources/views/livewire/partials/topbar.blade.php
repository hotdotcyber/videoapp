<div>
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 p-2">
        <a wire:navigate href="{{ route('home') }}" class="text-blue-600 hover:underline flex items-center gap-1">
            <i class="ri-home-9-fill text-xl"></i> BOTTUBE
        </a>

        @guest
            <div class="hidden md:block">
                <a wire:navigate href="{{ route('auth.login') }}" class="bg-blue-600 text-white rounded-lg px-4 py-2 hover:underline">
                    Login
                </a>
            </div>
        @endguest
    </div>
</div>
