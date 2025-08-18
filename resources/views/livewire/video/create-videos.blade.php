<div class="max-w-xl mx-auto p-6 bg-white dark:bg-gray-900 shadow-xl rounded-2xl space-y-8">

    {{-- Flash message --}}
    @if (session()->has('message'))
        <div class="p-3 text-sm text-green-800 bg-green-100 rounded">
            {{ session('message') }}
        </div>
    @endif

    {{-- Thumbnail Upload --}}
    <div class="space-y-1">
        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
            Upload Thumbnail <span class="text-xs text-gray-500">(JPG/PNG, max 2MB)</span>
        </label>
        <input 
            type="file"
            wire:model="image_thumbnail"
            accept="image/*"
            class="w-full file:border-0 file:py-2 file:px-4 file:bg-green-50 file:text-green-700 border border-gray-300 dark:border-gray-700 rounded-md text-sm text-gray-700 dark:text-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-green-500"
        />
        @error('image_thumbnail') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    {{-- Video File Upload --}}
    <div class="space-y-1">
        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
            Select Video <span class="text-xs text-gray-500">(MP4/AVI/MOV)</span>
        </label>
        <input 
            type="file"
            wire:model="videoFile"
            accept="video/mp4,video/avi,video/mov"
            class="w-full file:border-0 file:py-2 file:px-4 file:bg-blue-50 file:text-blue-700 border border-gray-300 dark:border-gray-700 rounded-md text-sm text-gray-700 dark:text-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
        @error('videoFile') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    {{-- Upload Progress Bar --}}
    <div wire:loading wire:target="videoFile,image_thumbnail" class="mt-2">
        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
            <div class="bg-blue-600 h-2.5 rounded-full animate-pulse" style="width: 100%"></div>
        </div>
        <p class="text-sm mt-1 text-blue-600 dark:text-blue-400">Uploading...</p>
    </div>

    {{-- Upload Button --}}
    <div class="relative">
        <button 
            type="button"
            wire:click="saveVideo"
            wire:loading.attr="disabled"
            class="w-full flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-4 rounded-lg transition duration-200 ease-in-out disabled:opacity-50 disabled:cursor-not-allowed"
        >
            <span wire:loading.remove>Upload Video</span>
            <span wire:loading>Processing...</span>
        </button>
    </div>
</div>
