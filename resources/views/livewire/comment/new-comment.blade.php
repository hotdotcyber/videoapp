<div>
  <div class="w-full">
    {{-- User avatar and comment input --}}
    <div class="flex items-start gap-3">
        <img
            src="{{ asset('channel_images/' . auth()->user()->channel->image) }}"
            class="rounded-full object-cover"
            style="height: 40px; width: 40px;"
            alt="User Avatar"
        >

        <input
            type="text"
            wire:model.live="body"
            placeholder="Add a public comment..."
            class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
    </div>



    {{-- Cancel and Comment buttons --}}
    @if($body)
    <div class="flex justify-end gap-2 mt-2">
        <a href="#" wire:click.prevent="resetForm" class="text-gray-600 hover:underline">Cancel</a>
        <a
            href="#"
            wire:click.prevent="addComment"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition"
        >
            Comment
        </a>
    </div>
    @endif
</div>

</div>
