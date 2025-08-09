<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    @foreach($videos as $video)
    <div class="bg-white shadow-md rounded-lg p-4 my-4">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            <!-- Thumbnail -->
            <div class="md:col-span-2">
                <a href="{{route('video.watch',$video)}}"><img src="{{ asset($video->image_thumbnail) }}" alt="" class="rounded-md w-full h-auto object-cover"></a>
            </div>

            <!-- Title & Description -->
            <div class="md:col-span-3">
                <h5 class="text-lg font-semibold text-gray-800">{{ $video->title }}</h5>
                <p class="text-gray-600 truncate">{{ $video->description }}</p>
            </div>

            <!-- Visibility -->
            <div class="md:col-span-2 text-gray-700">
                {{ $video->visibility }}
            </div>

            <!-- Date -->
            <div class="md:col-span-2 text-gray-500">
                {{ $video->created_at->format('d/m/Y') }}
            </div>

            <!-- Actions -->
            <div class="md:col-span-3 flex space-x-2">
                <a href="{{ route('video.edit', ['channel' => auth()->user()->channel, 'video' => $video->uid]) }}"
                   class="text-sm px-4 py-2 bg-gray-100 text-gray-800 rounded hover:bg-gray-200">
                    Edit
                </a>
                <a wire:click.prevent= "delete('{{$video->uid}}')" class="text-sm px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 cursor-pointer">
                    Delete
                </a>
            </div>
        </div>
    </div>
    @endforeach

    {{$videos->links()}}
</div>
