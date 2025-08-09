<div class="max-w-2xl mx-auto px-4 py-10">
    <div class="bg-white dark:bg-gray-900 shadow-lg rounded-xl p-6 space-y-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Edit Video</h2>

        @if ($video->image_thumbnail)
                <div class="mt-3">
                    <img src="{{ asset($video->image_thumbnail) }}" class="w-40 rounded-md shadow border border-gray-200 dark:border-gray-700" alt="image_thumbnail Preview">
                </div>
            @endif

        <form wire:submit.prevent="updateVideo" class="space-y-5">
            {{-- Title --}}
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Title
                </label>
                <input
                    id="title"
                    type="text"
                    wire:model="title"
                    class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                />
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Description
                </label>
                <textarea
                    id="description"
                    rows="4"
                    wire:model="description"
                    class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                ></textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Visibility --}}
            <div>
                <label for="visibility" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Visibility
                </label>
                <select
                    id="visibility"
                    wire:model="visibility"
                    class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                >
                    <option value="private">Private</option>
                    <option value="public">Public</option>
                    <option value="unlisted">Unlisted</option>
                </select>
                @error('visibility')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div class="pt-2">
                <button
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300"
                >
                    Update
                </button>
            </div>

            {{-- Success Message --}}
            @if(session()->has('message'))
                <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-md text-sm flex items-center space-x-2">
                    <i class="ri-check-line text-lg"></i>
                    <span>{{ session('message') }}</span>
                </div>
            @endif
        </form>
    </div>
</div>
