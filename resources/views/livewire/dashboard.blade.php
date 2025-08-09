<div class="px-4 sm:px-6 lg:px-8 py-8 bg-gray-50 min-h-screen">
    {{-- Header --}}
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">📺 Subscribed Channel Videos</h2>
        <p class="text-gray-500 mt-1">Enjoy the latest from the channels you follow.</p>
    </div>

    {{-- No Subscriptions --}}
    @if(!$channels->count())
        <div class="bg-white p-6 rounded-xl shadow text-center col-span-full">
            <p class="text-lg text-gray-600">You are not subscribed to any channel!</p>
            <a href="/" class="inline-block mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                Explore Channels
            </a>
        </div>
    @endif

    {{-- Videos Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($channels as $channelVideos)
            @foreach ($channelVideos as $video)
                <a href="{{ route('video.watch', $video) }}" class="block group">
                    <div class="bg-white rounded-2xl overflow-hidden shadow hover:shadow-lg transition duration-300">
                        {{-- Thumbnail --}}
                        <div class="aspect-video bg-gray-200 relative overflow-hidden">
                            <img
                                src="{{ asset($video->image_thumbnail) }}"
                                alt="{{ $video->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                            >
                            {{-- Optional Play Icon Overlay --}}
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                <div class="bg-black/60 p-2 rounded-full">
                                    <i class="ri-play-fill text-white text-2xl"></i>
                                </div>
                            </div>
                        </div>

                        {{-- Info --}}
                        <div class="flex items-start gap-4 p-4">
                            <img
                                src="{{ asset('channel_images/' . $video->channel->image) }}"
                                alt="Channel Logo"
                                class="w-12 h-12 rounded-full object-cover ring-2 ring-blue-500"
                            >

                            <div class="flex-1">
                                <h4 class="text-base font-semibold text-gray-900 group-hover:text-blue-600 leading-snug">
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
