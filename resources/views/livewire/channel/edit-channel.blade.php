<div class="max-w-xl mx-auto p-4">
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="update" enctype="multipart/form-data" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" wire:model.defer="name" class="mt-1 block w-full border rounded p-2" />
            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Slug</label>
            <input type="text" wire:model.defer="slug" class="mt-1 block w-full border rounded p-2" />
            @error('slug') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <textarea wire:model.defer="description" class="mt-1 block w-full border rounded p-2"></textarea>
            @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Channel Image</label>
            <input type="file" wire:model="image" class="mt-1 block w-full border rounded p-2" />
            @error('image') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        @if ($channel->image)
            <div class="mt-2">
                <p class="text-sm text-gray-600">Current Image:</p>
                <img src="{{ asset(asset('channel_images/' . $channel->image) ) }}" class="w-20 h-20 object-cover rounded" />
            </div>
        @endif

        <button type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Update Channel
        </button>
    </form>
</div>

