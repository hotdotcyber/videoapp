<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h2 class="text-3xl sm:text-4xl font-extrabold text-red-900 dark:text-white text-center mb-10">
        {{ $channel->name }} Videos
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @forelse($videos as $video)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden transform hover:scale-105 hover:shadow-2xl transition-all duration-300">
                <a href="{{ route('video.watch', $video) }}" class="block relative group">
                    <img src="{{ asset($video->image_thumbnail) }}" alt="{{ $video->title }}"
                        class="w-full h-48 sm:h-56 object-cover rounded-t-xl group-hover:opacity-80 transition-opacity duration-300" />
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="text-white text-lg font-semibold">Watch Now</span>
                    </div>
                </a>
                <div class="p-5">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2 truncate">
                        <a href="{{ route('video.watch', $video) }}" class="hover:text-red-600 dark:hover:text-red-400 transition-colors duration-300">
                            {{ $video->title }}
                        </a>
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-2 mb-3">{{ $video->description }}</p>
                    <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                        <span>
                            <i class="fas fa-calendar-alt mr-1"></i>
                            {{ $video->created_at->format('M d, Y') }}
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <div class="py-20 text-center col-span-full">
                <p class="text-gray-500 dark:text-gray-400 text-xl font-medium">
                    <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                    No videos available yet.
                </p>
            </div>
        @endforelse
    </div>

    @if($videos->hasPages())
    <div class="mt-12 flex justify-center">
        {{ $videos->links() }}
    </div>
    @endif
</div>