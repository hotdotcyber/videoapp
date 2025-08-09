<div class="max-w-xl mx-auto p-6 bg-white dark:bg-gray-900 shadow-xl rounded-2xl space-y-8"
     x-data="{ progress: 0 }"
     x-on:livewire-upload-start="progress = 0"
     x-on:livewire-upload-finish="progress = 0"
     x-on:livewire-upload-error="progress = 0"
     x-on:livewire-upload-progress="progress = $event.detail.progress"
>
    <form wire:submit.prevent="uploadImage" enctype="multipart/form-data" class="space-y-6">

        {{-- Thumbnail Upload --}}
        <div class="space-y-1">
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                Upload Thumbnail <span class="text-xs text-gray-500">(JPG/PNG, max 2MB)</span>
            </label>
            <input 
                type="file"
                name="image_thumbnail" 
                wire:model="image_thumbnail" 
                accept="image/*"
                class="w-full file:border-0 file:py-2 file:px-4 file:bg-green-50 file:text-green-700 border border-gray-300 dark:border-gray-700 rounded-md text-sm text-gray-700 dark:text-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-green-500"
            />
            @error('image_thumbnail') 
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p> 
            @enderror

            @if ($image_thumbnail)
                <div class="mt-4">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Thumbnail Preview:</p>
                    <img src="{{ $image_thumbnail->temporaryUrl() }}" 
                         class="w-48 h-auto rounded-md shadow border border-gray-200 dark:border-gray-700" 
                         alt="Thumbnail Preview">
                </div>
            @endif
        </div>

        {{-- Video File Upload --}}
        <div class="space-y-1">
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                Select Video <span class="text-xs text-gray-500">(MP4 only)</span>
            </label>
            <input 
                type="file"
                name="videoFile" 
                wire:model="videoFile" 
                accept="video/mp4"
                @if (!$image_thumbnail) disabled @endif
                class="w-full file:border-0 file:py-2 file:px-4 file:bg-blue-50 file:text-blue-700 border border-gray-300 dark:border-gray-700 rounded-md text-sm text-gray-700 dark:text-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed"
            />
            @error('videoFile') 
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p> 
            @enderror
        </div>

        {{-- Upload Progress Bar --}}
        <template x-if="progress > 0">
            <div class="mt-2">
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div 
                        class="bg-blue-600 h-2.5 rounded-full transition-all duration-300 ease-in-out"
                        :style="'width: ' + progress + '%'">
                    </div>
                </div>
                <p class="text-sm mt-1 text-blue-600 dark:text-blue-400">Uploading: <span x-text="progress"></span>%</p>
            </div>
        </template>

        {{-- Upload Button with Spinner --}}
        <div class="relative">
            <button 
                type="submit"
                wire:loading.attr="disabled"
                wire:target="videoFile,image_thumbnail,uploadImage"
                @if (!$image_thumbnail) disabled @endif
                class="w-full flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-4 rounded-lg transition duration-200 ease-in-out disabled:opacity-50 disabled:cursor-not-allowed"
            >
                <svg 
                    wire:loading 
                    wire:target="videoFile,image_thumbnail,uploadImage" 
                    class="animate-spin h-5 w-5 mr-2 text-white" 
                    xmlns="http://www.w3.org/2000/svg" 
                    fill="none" 
                    viewBox="0 0 24 24"
                >
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z" />
                </svg>
                Upload Video
            </button>
        </div>

        {{-- Uploading Text --}}
        <div 
            wire:loading 
            wire:target="videoFile,image_thumbnail,uploadImage" 
            class="text-sm text-blue-500 flex items-center space-x-2 animate-pulse"
        >
            <i class="ri-upload-cloud-line text-lg"></i>
            <span>Uploading your files, please wait...</span>
        </div>

        {{-- Success Feedback --}}
        @if (session()->has('message'))
            <div class="bg-green-50 border border-green-200 text-green-800 p-3 rounded-lg text-sm flex items-center space-x-2">
                <i class="ri-check-double-line text-lg"></i>
                <span>{{ session('message') }}</span>
            </div>
        @endif

    </form>
</div>
