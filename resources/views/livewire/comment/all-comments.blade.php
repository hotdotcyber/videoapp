<div>
    @foreach ($video->comments as $comment)
        <div class="media my-3">

            {{-- User Avatar with fallback --}}
            <img class="mr-3 rounded-circle w-10 h-10 object-cover"
                src="{{ $comment->user->channel->image && file_exists(public_path('images/' . $comment->user->channel->image)) 
                        ? asset('images/' . $comment->user->channel->image) 
                        : asset('images/default-channel.png') }}"
                alt="User image">

            <div class="media-body">
                <h5 class="mt-0 font-bold">
                    {{ $comment->user->name }}
                    <small class="text-muted text-sm">{{ $comment->created_at->diffForHumans() }}</small>
                </h5>

                <p>{{ $comment->body }}</p>

                {{-- Reply Toggle --}}
                <p class="mt-3">
                    <a href="#" class="text-blue-500 text-sm" wire:click.prevent="toggleReplies({{ $comment->id }})">
                        REPLY
                    </a>
                </p>

                {{-- Reply Form --}}
                @auth
                    @if (in_array($comment->id, $expandedComments))
                        <div class="my-2">
                            <livewire:comment.new-comment
                                :video="$video"
                                :col="$comment->id"
                                :key="'reply-form-' . $comment->id . '-' . uniqid()" />
                        </div>
                    @endif
                @endauth

                {{-- Replies --}}
                @if ($comment->replies->count())
                    <div class="ml-8 mt-2">
                        <a href="#"
                           wire:click.prevent="toggleReplies({{ $comment->id }})"
                           class="text-sm text-gray-600 hover:underline">
                            {{ in_array($comment->id, $expandedComments) ? 'Hide' : 'View' }} {{ $comment->replies->count() }} replies
                        </a>

                        @if (in_array($comment->id, $expandedComments))
                            <div class="mt-2 space-y-3">
                                @foreach ($comment->replies as $reply)
                                    <div class="flex gap-3">
                                        {{-- Reply Avatar with fallback --}}
                                        <img src="{{ $reply->user->channel->image && file_exists(public_path('images/' . $reply->user->channel->image)) 
                                                ? asset('images/' . $reply->user->channel->image) 
                                                : asset('images/default-channel.png') }}"
                                             class="w-8 h-8 rounded-full object-cover" />
                                        <div>
                                            <h6 class="font-semibold text-sm">
                                                {{ $reply->user->name }}
                                                <small class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</small>
                                            </h6>
                                            <p class="text-sm text-gray-700">{{ $reply->body }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</div>
