<div>
<div class="my-6">
    <div class="flex items-center justify-between flex-wrap gap-4">

        <!-- Channel Info -->
        <div class="flex items-center space-x-4">
    <img 
        src="{{ $channel->image 
            ? asset('channel_images/' . $channel->image) 
            : asset('channel_images/default-channel.png') }}" 
        alt="Channel Image" 
        class="w-20 h-20 object-cover rounded" 
    />
    <div>
        <a href="{{route('channels.show',$channel)}}" class="text-lg font-semibold text-gray-800">{{ $channel->name }}</a>
        <p class="text-sm text-gray-500">{{ $channel->subscribers() }} subscribers</p>
    </div>
</div>


        <!-- Subscribe Button -->
        <div>
            <button wire:click.prevent="toggle"
                    class="px-5 py-2 text-sm font-medium rounded-full uppercase tracking-wide transition 
                    {{ $userSubscribed ? 'bg-gray-200 text-gray-800 hover:bg-gray-300' : 'bg-red-600 text-white hover:bg-red-700' }}">
                {{ $userSubscribed ? 'Join Me' : 'Un Join' }}
            </button>
        </div>
        
    </div>
</div>
</div>
