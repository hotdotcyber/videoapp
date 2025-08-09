<div class="w-full px-4 sm:px-6 lg:px-8 py-6 bg-gray-50 min-h-screen">
    {{-- Header + Search --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <a wire:navigate href="{{ route('home') }}" class="text-blue-600 hover:underline flex items-center gap-1">
            <i class="ri-home-9-fill text-xl"></i> BOTTUBE
        </a>

        <form wire:submit.prevent="search" class="relative w-full max-w-md">
            <input
                type="text"
                wire:model.lazy="query"
                placeholder="Search..."
                class="w-full border border-gray-300 rounded-full pl-4 pr-10 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            <button
                type="submit"
                class="absolute right-2 top-1/2 transform -translate-y-1/2 text-blue-600 hover:text-blue-800"
            >
                <i class="ri-search-line text-lg"></i>
            </button>
        </form>

        <div class="hidden md:block">
            <a wire:navigate href="{{ route('auth.login') }}" class="bg-blue-600 text-white rounded-lg px-4 py-2 hover:underline">Login</a>
        </div>
    </div>

    {{-- Video Results --}}
    @if($videos->isEmpty())
        <p class="text-center text-gray-500">No videos found.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($videos as $video)
                <a href="{{ route('video.watch', $video) }}" class="block group">
                    <div
                        class="relative w-full h-[60vh] sm:h-[50vh] md:h-[45vh] lg:h-[40vh] bg-black rounded-xl overflow-hidden shadow hover:shadow-md transition"
                        x-data="{ playing: false }"
                        x-init="$watch('playing', val => {
                            const vid = $el.querySelector('video');
                            if (val) {
                                document.querySelectorAll('video').forEach(v => {
                                    if (v !== vid) {
                                        v.pause();
                                        v.currentTime = 0;
                                        const comp = v.closest('[x-data]');
                                        if (comp && comp.__x) {
                                            comp.__x.$data.playing = false;
                                        }
                                    }
                                });
                                vid.currentTime = 0;
                                vid.play().catch(e => {
                                    console.warn('Video play was interrupted:', e);
                                });
                            } else {
                                vid.pause();
                                vid.currentTime = 0;
                            }
                        })"
                        @mouseenter="playing = true"
                        @mouseleave="playing = false"
                    >

                        {{-- Static Thumbnail --}}
                        <img
                            x-show="!playing"
                            x-transition.opacity
                            src="{{ asset($video->image_thumbnail) }}"
                            alt="{{ $video->title }}"
                            class="absolute inset-0 w-full h-full object-cover"
                        >

                        {{-- Video Preview --}}
                        <video
                            x-show="playing"
                            x-transition.opacity
                            muted
                            playsinline
                            preload="metadata"
                            poster="{{ asset($video->image_thumbnail) }}"
                            class="absolute inset-0 w-full h-full object-cover"
                        >
                            <source src="{{ asset($video->path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>

                    {{-- Video Info --}}
                    <div class="flex items-start gap-3 p-4">
                        @php
                            $channelImage = $video->channel->image ?: 'default-channel.png';
                        @endphp
                        <img
                            src="{{ asset('channel_images/' . $channelImage) }}"
                            alt="Channel Logo"
                            onerror="this.onerror=null; this.src='{{ asset('images/default-channel.png') }}';"
                            class="w-10 h-10 rounded-full object-cover"
                        >
                        <div>
                            <h4 class="text-md font-semibold text-gray-900 group-hover:text-blue-600">
                                {{ $video->title }}
                            </h4>
                            <p class="text-sm text-gray-600 mt-1">{{ $video->channel->name }}</p>
                            <p class="text-sm text-gray-500">{{ $video->views }} views • {{ $video->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>
