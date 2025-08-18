<div class="w-full px-4 sm:px-6 lg:px-8 py-6 bg-gray-50 min-h-screen">

    {{-- Header + Search --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <a wire:navigate href="{{ route('home') }}" 
           class="text-violet-600 font-extrabold hover:text-violet-800 flex items-center gap-2 text-2xl">
            <i class="ri-flashlight-line text-3xl"></i> BOTTTUBE
        </a>

        <form wire:submit.prevent="search" class="relative w-full max-w-md">
            <input
                type="text"
                wire:model.lazy="query"
                placeholder="Search videos..."
                class="w-full border border-gray-300 rounded-full pl-4 pr-10 py-2 shadow-md focus:outline-none focus:ring-2 focus:ring-violet-500"
            >
            <button
                type="submit"
                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-violet-600 hover:text-violet-800"
            >
                <i class="ri-search-line text-lg"></i>
            </button>
        </form>

        @guest
            <div class="hidden md:block">
                <a wire:navigate href="{{ route('auth.login') }}" 
                   class="bg-violet-500 text-white rounded-full px-5 py-2 hover:bg-violet-600 transition font-semibold shadow">
                    Login
                </a>
            </div>
        @endguest
    </div>

    {{-- Filter Tabs --}}
    <div class="flex flex-wrap gap-3 mb-6">
        @foreach(['latest','most_liked','trending','most_viewed'] as $f)
            <button 
                wire:click="setFilter('{{ $f }}')" 
                class="px-5 py-2 rounded-full font-medium text-sm transition 
                {{ $filter === $f ? 'bg-violet-600 text-white shadow-md' : 'bg-gray-200 text-gray-600 hover:bg-violet-100 hover:text-violet-700' }}">
                {{ ucwords(str_replace('_',' ',$f)) }}
            </button>
        @endforeach
    </div>

    {{-- Skeleton Loading --}}
    <div wire:loading.flex class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @for ($i = 0; $i < 6; $i++)
            <div class="rounded-xl overflow-hidden shadow-md bg-white animate-pulse">
                <div class="w-full h-56 bg-gray-300"></div>
                <div class="flex items-start gap-3 p-3">
                    <div class="w-10 h-10 rounded-full bg-gray-300"></div>
                    <div class="flex flex-col gap-2 w-full">
                        <div class="h-4 bg-gray-300 rounded w-3/4"></div>
                        <div class="h-3 bg-gray-200 rounded w-1/2"></div>
                        <div class="h-3 bg-gray-200 rounded w-1/3"></div>
                    </div>
                </div>
            </div>
        @endfor
    </div>

    {{-- Video Results --}}
    <div wire:loading.remove>
        @if($this->videos->isEmpty())
            <p class="text-center text-gray-500 mt-10">No videos found.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($this->videos as $video)
                    <a href="{{ route('video.watch', $video) }}" 
                       class="block group rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                        
                        {{-- Video Thumbnail with Play Button --}}
                        <div class="relative w-full h-56 bg-gray-200">
                            <img 
                                src="{{ asset($video->image_thumbnail) }}" 
                                alt="{{ $video->title }}" 
                                class="absolute inset-0 w-full h-full object-cover">
                            
                            {{-- Play Button Overlay --}}
                            <div class="absolute inset-0 flex items-center justify-center bg-black/30 
                                        opacity-100 sm:opacity-0 sm:group-hover:opacity-100 transition">
                                <div class="bg-white/90 text-violet-600 p-4 sm:p-3 rounded-full shadow-lg">
                                    <i class="ri-play-fill text-3xl sm:text-2xl"></i>
                                </div>
                            </div>

                            {{-- Duration Badge --}}
                            <span class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">HD</span>
                        </div>

                        {{-- Video Info --}}
                        <div class="flex items-start gap-3 p-3 bg-white">
                            @php
                                $channelImage = $video->channel->image ?: 'default-channel.png';
                            @endphp
                            <img
                                src="{{ asset('channel_images/' . $channelImage) }}"
                                alt="Channel Logo"
                                onerror="this.onerror=null; this.src='{{ asset('images/default-channel.png') }}';"
                                class="w-10 h-10 rounded-full object-cover shadow"
                            >
                            <div class="flex flex-col">
                                <h4 class="text-md font-semibold text-gray-900 group-hover:text-violet-600 line-clamp-2">
                                    {{ $video->title }}
                                </h4>
                                <p class="text-sm text-gray-500">{{ $video->channel->name }}</p>
                                <p class="text-xs text-gray-400">{{ $video->views }} views • {{ $video->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Bottom Navigation Bar (Mobile) --}}
    <div class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 shadow-inner flex justify-around py-2 sm:hidden">
        <a href="{{ route('home') }}" class="flex flex-col items-center text-gray-600 hover:text-violet-600">
            <i class="ri-home-5-line text-xl"></i>
            <span class="text-xs">Home</span>
        </a>
        <a href="#" class="flex flex-col items-center text-gray-600 hover:text-violet-600">
            <i class="ri-search-line text-xl"></i>
            <span class="text-xs">Search</span>
        </a>
        <a href="#" class="flex flex-col items-center text-gray-600 hover:text-violet-600">
            <i class="ri-video-add-line text-xl"></i>
            <span class="text-xs">Upload</span>
        </a>
        <a href="#" class="flex flex-col items-center text-gray-600 hover:text-violet-600">
            <i class="ri-user-line text-xl"></i>
            <span class="text-xs">Profile</span>
        </a>
    </div>

</div>
