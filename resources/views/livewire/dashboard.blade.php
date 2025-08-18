<div class="px-4 sm:px-6 lg:px-8 py-8 bg-gradient-to-b from-gray-50 to-gray-100 min-h-screen">
    {{-- Header --}}
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-extrabold text-gray-800">🔥 Updates from Creators You Follow</h2>
        <p class="text-gray-500 mt-1">Enjoy fresh content from your chosen creators..</p>
    </div>

    {{-- No Subscriptions --}}
    @if(!$channels->count())
        <div class="bg-white p-6 rounded-2xl shadow text-center">
            <p class="text-lg text-gray-600">You are not following any creator</p>
            <a href="/" class="inline-block mt-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-5 py-2 rounded-full hover:opacity-90 transition">
                🚀 Explore Creators
            </a>
        </div>
    @endif

    {{-- Videos Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($channels as $channelVideos)
            @foreach ($channelVideos as $video)
                <a href="{{ route('video.watch', $video) }}" class="block group">
                    <div class="bg-white/70 backdrop-blur-md rounded-2xl overflow-hidden shadow hover:shadow-xl transition duration-300 border border-gray-100">
                        {{-- Thumbnail --}}
                        <div class="aspect-video relative overflow-hidden">
                            <img
                                src="{{ asset($video->image_thumbnail) }}"
                                alt="{{ $video->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                            >

                            {{-- Gradient Overlay --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>

                            {{-- Always-visible Play Icon on Mobile --}}
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="bg-white/90 group-hover:bg-white p-4 rounded-full shadow-lg transition">
                                    <i class="ri-play-fill text-black text-3xl sm:text-2xl"></i>
                                </div>
                            </div>
                        </div>

                        {{-- Info --}}
                        <div class="flex items-start gap-3 p-4">
                            <img
                                src="{{ asset('channel_images/' . $video->channel->image) }}"
                                alt="Channel Logo"
                                class="w-12 h-12 rounded-full object-cover ring-2 ring-indigo-500"
                            >

                            <div class="flex-1">
                                <h4 class="text-base font-semibold text-gray-900 leading-snug line-clamp-2 group-hover:text-indigo-600">
                                    {{ $video->title }}
                                </h4>
                                <p class="text-sm text-gray-600 mt-1">{{ $video->channel->name }}</p>
                                <p class="text-xs text-gray-400">{{ $video->views }} views • {{ $video->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        @endforeach
    </div>
</div>
