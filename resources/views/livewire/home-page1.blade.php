<div class="w-full px-4 sm:px-6 lg:px-8 py-6 bg-gray-50 min-h-screen relative">
    {{-- Header Navigation --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <a href="/" class="text-blue-600 hover:underline flex items-center gap-1">
                <i class="ri-home-9-fill text-xl"></i> BoltTube
            </a>
        </div>

    <form wire:submit.prevent="search" class="w-full px-4 sm:px-0">
        <div class="flex flex-col sm:flex-row items-stretch gap-3">
            <input
            type="text"
            wire:model="query"
            id="query"
            class="flex-1 border border-gray-300 rounded-xl px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder:text-gray-400"
            placeholder="Search"
            />
            <button
            type="submit"
            class="bg-blue-600 text-white px-5 py-3 rounded-xl hover:bg-blue-700 flex items-center justify-center text-base font-medium"
            >
            <i class="material-icons text-white text-lg">search</i>
            </button>
        </div>
        </form>


        <div class="hidden md:block">
            <a href="/login" class="bg-blue-600 text-white rounded-lg p-4  hover:underline">Login</a>
        </div>
    </div>

    {{-- Video Cards Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @if(!$channels->count())
            <p class="text-center col-span-full text-gray-600 text-lg">You are not subscribed to any channel!</p>
        @endif

        @foreach ($channels as $channelVideos)
            @foreach ($channelVideos as $video)
                <a href="{{ route('video.watch', $video) }}" class="block group">
                    <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition duration-200">
                        
                        {{-- Thumbnail --}}
                        <div class="aspect-video bg-gray-200">
                            <img
                                src="{{ asset($video->image_thumbnail) }}"
                                alt="{{ $video->title }}"
                                class="w-full h-full object-cover"
                            >
                        </div>

                        {{-- Info --}}
                        <div class="flex items-start gap-3 p-4">
                            <img
                                src="{{ asset('channel_images/' . $video->channel->image) }}"
                                alt="Channel Logo"
                                class="w-10 h-10 rounded-full object-cover"
                            >

                            <div class="flex flex-col">
                                <h4 class="text-md font-semibold text-gray-900 leading-tight group-hover:text-blue-600">
                                    {{ $video->title }}
                                </h4>
                                <p class="text-sm text-gray-600 mt-1">{{ $video->channel->name }}</p>
                                <p class="text-sm text-gray-500">{{ $video->views }} views • {{ $video->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        @endforeach
    </div>

   @livewire('floating1')


    </div>
</div>
