<div>
    <div class="flex space-x-8 text-gray-600">
        <!-- Like -->
        <div class="flex items-center space-x-2">
            <i 
                class="ri-thumb-up-line text-2xl cursor-pointer transition-colors duration-200 
                @if($likeActive) text-blue-500 @else text-gray-500 hover:text-blue-400 @endif" 
                wire:click.prevent="like"
            ></i>
            <span class="text-sm font-medium">{{ $likes }}</span>
        </div>

        <!-- Dislike -->
        <div class="flex items-center space-x-2">
            <i 
                class="ri-thumb-down-line text-2xl cursor-pointer transition-colors duration-200 
                @if($dislikeActive) text-red-500 @else text-gray-500 hover:text-red-400 @endif" 
                wire:click.prevent="dislike"
            ></i>
            <span class="text-sm font-medium">{{ $dislikes }}</span>
        </div>
    </div>
</div>
